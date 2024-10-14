<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use App\Notifications\JobApplicationStatusNotification;
use App\Notifications\AdminJobApplicationNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        // Restrict job creation to non-alumni users
        if (auth()->user()->role == 'alumni') {
            return redirect()->route('jobs.index')->with('status', 'Unauthorized action.');
        }

        return view('jobs.create'); // Return the view for creating a job
    }

    public function store(Request $request)
    {
        // Restrict job creation to non-alumni users
        if (auth()->user()->role == 'alumni') {
            abort(403, 'Unauthorized action.');
        }

        // Validate incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Image validation
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Store the image and get the path
            $imagePath = $request->file('image')->store('job_images', 'public');
        }

        // Create a new job using the validated data
        Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'company' => $request->company,
            'location' => $request->location,
            'image' => $imagePath,
        ]);

        return redirect()->route('jobs.index')->with('status', 'Job Created Successfully');
    }

    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Image validation
        ]);

        $imagePath = $job->image;

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($job->image) {
                Storage::disk('public')->delete($job->image);
            }
            // Store the new image
            $imagePath = $request->file('image')->store('job_images', 'public');
        }

        // Update the job with the validated data
        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'company' => $request->company,
            'location' => $request->location,
            'image' => $imagePath,
        ]);

        return redirect()->route('jobs.index')->with('status', 'Job Updated Successfully');
    }

    public function destroy(Job $job)
    {
        // Delete the image if it exists
        if ($job->image) {
            Storage::disk('public')->delete($job->image);
        }

        // Delete the job record
        $job->delete();
        return redirect()->route('jobs.index')->with('status', 'Job Deleted Successfully');
    }

    public function apply(Request $request, Job $job)
    {
        // Validate the application form data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:1000',
            'cover_letter' => 'required|file|mimes:pdf|max:2048',
            'resume' => 'required|file|mimes:pdf|max:5120',
        ]);

        // Handle cover letter upload
        $coverLetterPath = $request->file('cover_letter')->store('applications/cover_letters', 'public');

        // Handle resume upload
        $resumePath = $request->file('resume')->store('applications/resumes', 'public');

        // Create job application record
        $jobApplication = JobApplication::create([
            'job_id' => $job->id,
            'user_id' => auth()->id(),
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'cover_letter' => $coverLetterPath,
            'resume' => $resumePath,
        ]);

        // Notify the user about the application status
        $user = auth()->user();
        $user->notify(new JobApplicationStatusNotification($jobApplication));

        // Notify the admin about the new application
        Notification::route('mail', env('ADMIN_NOTIFICATION_EMAIL'))
            ->notify(new AdminJobApplicationNotification($jobApplication));

        return redirect()->route('jobs.show', $job->id)->with('status', 'Application Submitted Successfully');
    }
}

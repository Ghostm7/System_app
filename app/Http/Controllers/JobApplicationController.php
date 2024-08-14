<?php

// app/Http/Controllers/JobApplicationController.php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request; // Correct import for Request
use App\Notifications\JobApplicationStatusNotification;


class JobApplicationController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('alumni')) {
            abort(403, 'User does not have the right roles');
        }
    
        $applications = JobApplication::with('job', 'user')->get();
        return view('admin.job-applications', compact('applications'));
    }
    public function show($id)
    {
        // Retrieve the job application by ID
        $jobApplication = JobApplication::findOrFail($id);

        // Return a view with the job application data
        return view('admin.job_applications.show', compact('jobApplication'));
    }
    public function destroy($id)
{
    $jobApplication = JobApplication::findOrFail($id);
    $jobApplication->delete();

    return redirect()->route('job-applications.index')->with('status', 'Job application deleted successfully.');
}
public function update(Request $request, $id)
{
    $jobApplication = JobApplication::findOrFail($id);
    
    // Update status based on the action taken
    $jobApplication->status = $request->input('status');
    $jobApplication->save();

    // Trigger notification
    $user = $jobApplication->user; // Assuming you have a relationship between JobApplication and User
    $user->notify(new JobApplicationStatusNotification($jobApplication));

    return redirect()->route('job-applications.index')->with('status', 'Job application status updated successfully.');
}



}




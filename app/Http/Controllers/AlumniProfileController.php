<?php

namespace App\Http\Controllers;

use App\Models\AlumniProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AlumniProfileController extends Controller
{
    public function index()
    {
        $profile = AlumniProfile::where('user_id', Auth::id())->first();
    
        if (!$profile) {
            // Redirect to create profile if none exists
            return redirect()->route('alumni_profiles.create')->with('status', 'Please create your profile.');
        }
    
        return view('alumni_profiles.index', compact('profile'));
    }

    public function create()
    {
        return view('alumni_profiles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'biography' => 'nullable',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profileImage = null;

        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image')->store('profile_images', 'public');
        }

        AlumniProfile::create([
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'biography' => $request->biography,
            'profile_image' => $profileImage,
        ]);

        return redirect()->route('alumni_profiles.index')->with('status', 'Profile created successfully');
    }

    public function edit(AlumniProfile $alumniProfile)
    {
        $this->authorize('update', $alumniProfile);
        return view('alumni_profiles.edit', compact('alumniProfile'));
    }

    public function update(Request $request, AlumniProfile $alumniProfile)
    {
        $this->authorize('update', $alumniProfile);

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'biography' => 'nullable',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profileImage = $alumniProfile->profile_image;

        if ($request->hasFile('profile_image')) {
            if ($profileImage) {
                Storage::delete('public/' . $profileImage);
            }
            $profileImage = $request->file('profile_image')->store('profile_images', 'public');
        }

        $alumniProfile->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'biography' => $request->biography,
            'profile_image' => $profileImage,
        ]);

        return redirect()->route('alumni_profiles.index')->with('status', 'Profile updated successfully');
    }

    public function show(AlumniProfile $alumniProfile)
    {
        $this->authorize('view', $alumniProfile);
        return view('alumni_profiles.show', compact('alumniProfile'));
    }
}

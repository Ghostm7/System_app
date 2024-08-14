<?php

// app/Policies/JobApplicationPolicy.php

namespace App\Policies;

use App\Models\User;
use App\Models\JobApplication;

class JobApplicationPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, JobApplication $jobApplication)
    {
        return $user->hasRole('admin') || $user->id === $jobApplication->user_id;
    }

    public function create(User $user)
    {
        return $user->hasRole('alumni');
    }

    public function update(User $user, JobApplication $jobApplication)
    {
        return $user->id === $jobApplication->user_id || $user->hasRole('admin');
    }

    public function delete(User $user, JobApplication $jobApplication)
    {
        return $user->id === $jobApplication->user_id || $user->hasRole('admin');
    }
}

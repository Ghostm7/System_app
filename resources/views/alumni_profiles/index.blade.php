@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Profile</h1>

    <a href="{{ route('alumni_profiles.edit', $profile->id) }}">Edit Profile</a>

    <div>
        <h3>{{ $profile->first_name }} {{ $profile->last_name }}</h3>
        <p><strong>Email:</strong> {{ $profile->email }}</p>
        <p><strong>Biography:</strong> {{ $profile->biography }}</p>

        @if($profile->profile_image)
            <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Profile Image" width="150">
        @endif
    </div>
</div>
@endsection

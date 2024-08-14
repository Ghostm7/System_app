@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ $job->title }}</h1>
    <p><strong>Company:</strong> {{ $job->company }}</p>
    <p><strong>Location:</strong> {{ $job->location }}</p>
    <p><strong>Description:</strong> {{ $job->description }}</p>
    @if ($job->image)
    <img src="{{ asset('storage/' . $job->image) }}" alt="Job Image">
    @else
        <p>No image available.</p>
    @endif

    @if(session('status'))
    <div class="bg-green-500 text-white p-4">
        {{ session('status') }}
    </div>
@endif

    <!-- Display success message if any -->

    <!-- Apply Button and Form -->
    @auth
        <div class="mt-4">
            <h3>Apply for this Job</h3>
            <form action="{{ route('jobs.apply', $job->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" required>
    </div>
    <div class="form-group">
        <label for="phone_number">Phone Number</label>
        <input type="text" name="phone_number" class="form-control" id="phone_number" required>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <textarea name="address" class="form-control" id="address" rows="3" required></textarea>
    </div>
    <div class="form-group">
        <label for="cover_letter">Cover Letter</label>
        <input type="file" name="cover_letter" class="form-control-file" id="cover_letter" required>
    </div>
    <div class="form-group">
        <label for="resume">Resume</label>
        <input type="file" name="resume" class="form-control-file" id="resume" required>
    </div>
    <button type="submit" class="btn btn-primary">Apply</button>
</form>

        </div>
    @else
        <p class="alert alert-info mt-3">You need to <a href="{{ route('login') }}">log in</a> to apply for this job.</p>
    @endauth

    <a href="{{ route('jobs.index') }}" class="btn btn-secondary mt-3">Back to Listings</a>
</div>
@endsection

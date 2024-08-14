@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Job</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Job Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $job->title) }}" required>
        </div>
        <div class="form-group">
            <label for="description">Job Description</label>
            <textarea name="description" class="form-control" id="description" rows="5" required>{{ old('description', $job->description) }}</textarea>
        </div>
        <div class="form-group">
            <label for="company">Company</label>
            <input type="text" name="company" class="form-control" id="company" value="{{ old('company', $job->company) }}" required>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" class="form-control" id="location" value="{{ old('location', $job->location) }}" required>
        </div>
        <div class="form-group">
            <label for="image">Job Image</label>
            <input type="file" name="image" class="form-control-file" id="image">
            @if ($job->image)
                <img src="{{ Storage::url($job->image) }}" alt="Job Image" class="img-fluid mt-2" style="max-width: 150px;">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update Job</button>
    </form>
</div>
@endsection

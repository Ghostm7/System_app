@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Job</h1>

    <!-- Check if the user is an alumni -->
    @if(auth()->user()->role == 'alumni')
        <div class="alert alert-danger">
            You are not authorized to create jobs.
        </div>
    @else
        <!-- Display success message if any -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- Display validation errors if any -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Job Title</label>
                <input type="text" name="title" class="form-control" id="title" required>
            </div>
            <div class="form-group">
                <label for="description">Job Description</label>
                <textarea name="description" class="form-control" id="description" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="company">Company</label>
                <input type="text" name="company" class="form-control" id="company" required>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" class="form-control" id="location" required>
            </div>
            <div class="form-group">
                <label for="image">Job Image</label>
                <input type="file" name="image" class="form-control-file" id="image">
            </div>
            <button type="submit" class="btn btn-success">Create Job</button>
        </form>
    @endif
</div>
@endsection

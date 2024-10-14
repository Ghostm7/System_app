@extends('layouts.app')

@section('content')
<div class="container">
    

    <!-- Display flash messages -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- Show "Create New Job" button only for non-alumni users -->
    @unless(auth()->user()->role === 'alumni')
    <a href="{{ route('jobs.create', ['job' => 1]) }}" class="btn btn-primary">Create New Job</a>

    @endunless

    <div class="row">
        @foreach($jobs as $job)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if ($job->image)
                        <img src="{{ asset('storage/' . $job->image) }}" class="card-img-top" alt="{{ $job->title }}">
                    @else
                        <img src="https://via.placeholder.com/500x300?text=No+Image" class="card-img-top" alt="No Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $job->title }}</h5>
                        <p class="card-text"><strong>Company:</strong> {{ $job->company }}</p>
                        <p class="card-text"><strong>Location:</strong> {{ $job->location }}</p>
                        <p class="card-text">{{ $job->description }}</p>
                        <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-info">View</a>
                        @unless(auth()->user()->role === 'alumni')
                            <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endunless
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

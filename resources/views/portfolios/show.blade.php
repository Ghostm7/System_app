@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Portfolio Details</h1>

    <!-- Display portfolio details -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>{{ $portfolio->basic_information }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Education:</strong> {{ $portfolio->education }}</p>
            <p><strong>Work Experience:</strong> {{ $portfolio->work_experience }}</p>
            <p><strong>Skills:</strong> {{ $portfolio->skills }}</p>
            <p><strong>Personal Projects:</strong></p>
            <ul>
                @foreach(explode('|', $portfolio->personal_projects) as $project)
                    <li>{{ $project }}</li>
                @endforeach
            </ul>
            <p><strong>Achievements:</strong></p>
            <ul>
                @foreach(explode('|', $portfolio->achievements) as $achievement)
                    <li>{{ $achievement }}</li>
                @endforeach
            </ul>
        </div>
        <div class="card-footer text-end">
            @if (auth()->user()->hasRole('admin'))
                <!-- Admin Actions -->
                <form action="{{ route('admin.portfolios.updateReview', [$portfolio->id, 'approved']) }}" method="POST" style="display:inline;">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-success">Approve</button>
</form>

<form action="{{ route('admin.portfolios.updateReview', [$portfolio->id, 'rejected']) }}" method="POST" style="display:inline;">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-danger">Reject</button>
</form>

            @else
                <!-- Regular User Actions -->
                @if (auth()->id() === $portfolio->user_id)
                    <a href="{{ route('portfolios.edit', $portfolio->id) }}" class="btn btn-primary">Edit</a>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection

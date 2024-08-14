@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">My Portfolios</h1>

    <!-- Display success message if any -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- Display Create Portfolio Button -->
    @can('create', App\Models\Portfolio::class)
        <a href="{{ route('portfolios.create') }}" class="btn btn-primary mb-4">Create Portfolio</a>
    @endcan

    <!-- Display portfolios -->
    @forelse ($portfolios as $portfolio)
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="mb-0">{{ $portfolio->basic_information }}</h2>
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
                <a href="{{ route('portfolios.show', $portfolio->id) }}" class="btn btn-primary">View Details</a>
            </div>
        </div>
    @empty
        <p class="text-center">No portfolios found.</p>
    @endforelse
</div>
@endsection

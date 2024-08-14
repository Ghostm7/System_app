@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Review Portfolios</h1>

    <!-- Display success message if any -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

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
                <p><strong>Review Status:</strong> {{ ucfirst($portfolio->review_status) }}</p>
            </div>
            <div class="card-footer text-end">
                @if ($portfolio->review_status === 'pending')
                    <form action="{{ route('portfolios.review', [$portfolio->id, 'approved']) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                    <form action="{{ route('portfolios.review', [$portfolio->id, 'rejected']) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <p class="text-center">No portfolios found.</p>
    @endforelse
</div>
@endsection

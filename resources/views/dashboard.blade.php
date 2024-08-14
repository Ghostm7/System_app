@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>

    <!-- Display Create Portfolio Button -->
    @can('create', App\Models\Portfolio::class)
        <a href="{{ route('portfolios.create') }}" class="btn btn-primary mb-4">Create Portfolio</a>
    @endcan

    <!-- Other dashboard content here -->
</div>
@endsection

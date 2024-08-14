@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $alumniProfile->first_name }} {{ $alumniProfile->last_name }}</h1>

    @if($alumniProfile->profile_image)
        <img src="{{ asset('storage/' . $alumniProfile->profile_image) }}" alt="Profile Image">
    @endif

    <p><strong>Email:</strong> {{ $alumniProfile->email }}</p>
    <p><strong>Biography:</strong> {{ $alumniProfile->biography }}</p>

    <h3>Portfolios</h3>
    @foreach($alumniProfile->portfolios as $portfolio)
        <p>{{ $portfolio->title }}</p>
        <!-- Add a link to view the portfolio details -->
    @endforeach
</div>
@endsection

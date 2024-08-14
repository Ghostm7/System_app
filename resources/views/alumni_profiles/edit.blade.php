@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Alumni Profile</h1>

    <form action="{{ route('alumni_profiles.update', $alumniProfile->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Add fields similar to the create form -->
    </form>
</div>
@endsection

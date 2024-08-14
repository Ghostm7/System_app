@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Alumni Profile</h1>

    <form action="{{ route('alumni_profiles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Add fields for first_name, last_name, email, biography, profile_image -->
        <!-- Add form validation errors -->
    </form>
</div>
@endsection

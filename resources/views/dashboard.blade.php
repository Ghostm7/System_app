@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Dashboard</h1>

    <div class="row justify-content-center">
        @if (Auth::user()->hasRole('super-admin'))
            <div class="col-md-4 mb-4">
                <a href="{{ url('users') }}" class="card bg-danger text-white shadow text-decoration-none">
                    <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;">
                        <h5 class="card-title mb-0">Users</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ url('roles') }}" class="card bg-danger text-white shadow text-decoration-none">
                    <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;">
                        <h5 class="card-title mb-0">Roles</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ url('permissions') }}" class="card bg-danger text-white shadow text-decoration-none">
                    <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;">
                        <h5 class="card-title mb-0">Permissions</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('jobs.index') }}" class="card bg-danger text-white shadow text-decoration-none">
                    <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;">
                        <h5 class="card-title mb-0">Jobs</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ url('job-applications') }}" class="card bg-danger text-white shadow text-decoration-none">
                    <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;">
                        <h5 class="card-title mb-0">Job Applications</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('portfolios.index') }}" class="card bg-danger text-white shadow text-decoration-none">
                    <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;">
                        <h5 class="card-title mb-0">Manage Portfolios</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ url('profiles') }}" class="card bg-danger text-white shadow text-decoration-none">
                    <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;">
                        <h5 class="card-title mb-0">Manage Profiles</h5>
                    </div>
                </a>
            </div>
        @elseif (Auth::user()->hasRole('admin'))
            <div class="col-md-4 mb-4">
                <a href="{{ url('roles') }}" class="card bg-danger text-white shadow text-decoration-none">
                    <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;">
                        <h5 class="card-title mb-0">Manage Roles</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ url('permissions') }}" class="card bg-danger text-white shadow text-decoration-none">
                    <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;">
                        <h5 class="card-title mb-0">Manage Permissions</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('jobs.index') }}" class="card bg-danger text-white shadow text-decoration-none">
                    <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;">
                        <h5 class="card-title mb-0">Jobs</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ url('job-applications') }}" class="card bg-danger text-white shadow text-decoration-none">
                    <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;">
                        <h5 class="card-title mb-0">Job Applications</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('portfolios.index') }}" class="card bg-danger text-white shadow text-decoration-none">
                    <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;">
                        <h5 class="card-title mb-0">Portfolios</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ url('profiles') }}" class="card bg-danger text-white shadow text-decoration-none">
                    <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;">
                        <h5 class="card-title mb-0">Profiles</h5>
                    </div>
                </a>
            </div>
        @elseif (Auth::user()->hasRole('alumni'))
            <div class="col-md-4 mb-4">
                <a href="{{ route('jobs.index') }}" class="card bg-danger text-white shadow text-decoration-none">
                    <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;">
                        <h5 class="card-title mb-0">Jobs</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('portfolios.index') }}" class="card bg-danger text-white shadow text-decoration-none">
                    <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;">
                        <h5 class="card-title mb-0">My Portfolio</h5>
                    </div>
                </a>
            </div>
            <!-- Removed the profiles card for alumni -->
        @else
            <div class="col-md-4 mb-4">
                <div class="card bg-danger text-white shadow">
                    <div class="card-body text-center">
                        <p>You do not have any specific roles assigned.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

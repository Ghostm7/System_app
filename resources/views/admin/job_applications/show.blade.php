@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-lg font-semibold">Job Application Details</h2>
                    
                    <div class="mb-4">
                        <strong>Name:</strong> {{ $jobApplication->name }}
                    </div>
                    <div class="mb-4">
                        <strong>Phone Number:</strong> {{ $jobApplication->phone_number }}
                    </div>
                    <div class="mb-4">
                        <strong>Address:</strong> {{ $jobApplication->address }}
                    </div>
                    <div class="mb-4">
                        <strong>Cover Letter:</strong> <a href="{{ asset('storage/' . $jobApplication->cover_letter) }}" target="_blank">View</a>
                    </div>
                    <div class="mb-4">
                        <strong>Resume:</strong> <a href="{{ asset('storage/' . $jobApplication->resume) }}" target="_blank">View</a>
                    </div>

                    <!-- Action Buttons -->
                    <form action="{{ route('job-applications.update', $jobApplication->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="reviewed">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Review</button>
                    </form>

                    <form action="{{ route('job-applications.update', $jobApplication->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="stalled">
                        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Stall</button>
                    </form>

                    <form action="{{ route('job-applications.update', $jobApplication->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Approve</button>
                    </form>

                    <a href="{{ route('job-applications.index') }}" class="text-blue-500 hover:underline">Back to Applications</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Display status message -->
                    @if (session('status'))
                        <div class="alert alert-info bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2 class="text-lg font-semibold">Job Applications</h2>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($applications as $application)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $application->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $application->phone_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $application->address }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('job-applications.show', $application->id) }}" class="text-blue-500 hover:underline">View</a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('job-applications.destroy', $application->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this application?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline ml-4">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No job applications found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

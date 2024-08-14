@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Portfolio</h1>

    <form action="{{ route('portfolios.update', $portfolio->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="basic_information" class="form-label">Basic Information</label>
            <input type="text" class="form-control" id="basic_information" name="basic_information" value="{{ old('basic_information', $portfolio->basic_information) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="education" class="form-label">Education</label>
            <input type="text" class="form-control" id="education" name="education" value="{{ old('education', $portfolio->education) }}" required>
        </div>

        <div class="mb-3">
            <label for="work_experience" class="form-label">Work Experience</label>
            <input type="text" class="form-control" id="work_experience" name="work_experience" value="{{ old('work_experience', $portfolio->work_experience) }}" required>
        </div>

        <div class="mb-3">
            <label for="skills" class="form-label">Skills</label>
            <input type="text" class="form-control" id="skills" name="skills" value="{{ old('skills', $portfolio->skills) }}" required>
        </div>

        <div class="mb-3">
            <label for="personal_projects" class="form-label">Personal Projects</label>
            <textarea class="form-control" id="personal_projects" name="personal_projects" rows="3" required>{{ old('personal_projects', $portfolio->personal_projects) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="achievements" class="form-label">Achievements</label>
            <textarea class="form-control" id="achievements" name="achievements" rows="3">{{ old('achievements', $portfolio->achievements) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

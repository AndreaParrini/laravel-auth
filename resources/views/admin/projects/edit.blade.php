@extends('layouts.admin');

@section('content')
    <div class="container">
        <h3 class="text-center">Create a new project</h3>
        @include('partials.error')
        <form action="{{ route('admin.projects.update', $project) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    aria-describedby="helpId" placeholder="Es. molestiae cupiditate illo aut"
                    value="{{ old('title', $project->title) }}" />
                <small id="helpId" class="form-text text-muted">Inserte here a title of your project</small>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="content" rows="3">{{ old('content', $project->content) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

        </form>
    </div>
@endsection

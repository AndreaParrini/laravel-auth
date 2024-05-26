@extends('layouts.admin')

@section('content')
    <div class="bg-dark py-4">
        <div class="container d-flex justify-content-between align-items-center text-light">
            <h3 class="my-3 text-uppercase text-center">Modify project : {{ $project->title }}</h3>
            <a class="btn btn-primary" href="{{ route('admin.projects.index') }}"><i class="fas fa-arrow-left me-1"
                    aria-hidden="true"></i>Cancel</a>
        </div>

    </div>
    <div class="container mt-4">

        @include('partials.error')
        <form action="{{ route('admin.projects.update', $project) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    id="title" aria-describedby="helpId" placeholder="Es. molestiae cupiditate illo aut"
                    value="{{ old('title', $project->title) }}" />
                <small id="helpId" class="form-text text-muted">Inserte here a title of your project</small>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type_id" class="form-label">Type</label>
                <select class="form-select" name="type_id" id="type_id">
                    <option selected>Select a type of your project</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}"
                            {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex gap-4">
                <div>
                    @if (Str::startsWith($project->cover_image, 'https://'))
                        <img width="140" src="{{ $project->cover_image }}" alt="Cover Image">
                    @else
                        <img width="140" src="{{ asset('storage/' . $project->cover_image) }}" alt="Cover Image">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="cover_image" class="form-label">Modify Cover Image</label>
                    <input type="file" class="form-control" name="cover_image" id="cover_image" placeholder="cover image"
                        aria-describedby="fileHelpId" />
                    <div id="coverImageHelper" class="form-text">Uploade a new cover image</div>
                </div>
            </div>

            <div class="my-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="content" rows="3">{{ old('content', $project->content) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

        </form>
    </div>
@endsection

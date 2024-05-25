@extends('layouts.admin')

@section('content')
    <div class="bg-dark py-4">
        <div class="container d-flex justify-content-between align-items-center text-light">
            <h3 class="my-3 text-uppercase text-center">Create a new project</h3>
            <a class="btn btn-primary" href="{{ route('admin.projects.index') }}"><i class="fas fa-arrow-left me-1"
                    aria-hidden="true"></i>Cancel</a>
        </div>
    </div>
    <div class="container mt-4">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    id="title" aria-describedby="helpId" placeholder="Es. molestiae cupiditate illo aut"
                    value="{{ old('title') }}" />
                <small id="helpId" class="form-text text-muted">Inserte here a title of your project</small>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Uploade Cover Image</label>
                <input type="file" class="form-control" name="cover_image" id="cover_image" placeholder="cover image"
                    aria-describedby="fileHelpId" />
                <div id="coverImageHelper" class="form-text">Uploade a cover image</div>
            </div>


            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="content" rows="3">{{ old('content') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Create
            </button>

        </form>
    </div>
@endsection

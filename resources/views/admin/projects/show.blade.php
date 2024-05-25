@extends('layouts.admin')

@section('content')
    <div class="bg-dark py-4">
        <div class="container d-flex justify-content-between align-items-center text-light">
            <h3 class="my-3 text-uppercase text-center">{{ $project->title }}</h3>
            <a class="btn btn-primary" href="{{ route('admin.projects.index') }}"><i class="fas fa-arrow-left me-1"
                    aria-hidden="true"></i>Return all posts</a>
        </div>

    </div>
    <div class="container">
        <div class="row">
            <div class="col-6 my-5 text-center">
                @if (Str::startsWith($project->cover_image, 'https://'))
                    <img class="rounded-4" width="450" src="{{ $project->cover_image }}" alt="Cover Image">
                @else
                    <img class="rounded-4" width="450" src="{{ asset('storage/' . $project->cover_image) }}"
                        alt="Cover Image">
                @endif
            </div>
            <div class="col-6 my-5 text-center ">
                <h3 class="text-uppercase my-4">{{ $project->title }}</h3>
                <p class="fst-italic">{{ $project->content }}</p>
                <p>Type: {{ $project->type ? $project->type->name : 'No Type to this project' }}</p>
            </div>
        </div>

    </div>
@endsection

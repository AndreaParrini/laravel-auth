@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <img class="card-img-top" src="{{ $project->cover_image }}" alt="Cover Image" />
            <div class="card-body">
                <h4 class="card-title">{{ $project->title }}</h4>
                <p class="card-text">Content: {{ $project->content }}</p>
                <p class="text-muted">{{ $project->slug }}</p>
            </div>
        </div>

    </div>
@endsection

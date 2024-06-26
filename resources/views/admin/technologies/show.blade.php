@extends('layouts.admin')

@section('content')
    <div class="bg-dark py-4">
        <div class="container d-flex justify-content-between align-items-center text-light">
            <h3 class="my-3 text-uppercase text-center">Projects </h3>
            <a class="btn btn-primary" href="{{ route('admin.technologies.index') }}"> <i class="fa fa-arrow-left me-1"
                    aria-hidden="true"></i>Return</a>
        </div>

    </div>
    <div class="container my-4">
        <div class="row row-cols-4 g-3 mb-3">
            @forelse ($allProjectsTechnology as $project)
                <div class="col">
                    <a class="text-decoration-none" href="{{ route('admin.projects.show', $project) }}">
                        <div class="card h-100">
                            @if (Str::startsWith($project->cover_image, 'https://'))
                                <img height="300" class="rounded-top" src="{{ $project->cover_image }}" alt="Cover Image">
                            @else
                                <img height="300" class="rounded-top"
                                    src="{{ asset('storage/' . $project->cover_image) }}" alt="Cover Image">
                            @endif
                            <div class="card-body text-center">
                                <h5 class="card-title text-uppercase">{{ $project->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted ">To more info click the card</h6>
                                <div class="technologies">
                                    @forelse ($project->technologies as $technology)
                                        <span class="badge bg-primary">{{ $technology->name }}</span>
                                    @empty
                                        <span>Nessuna tecnologia</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </a>

                </div>

            @empty
                <div class="col">
                    <p>No projects here</p>
                </div>
            @endforelse
        </div>

        {{-- {{ $allProjectsTechnology->links('pagination::bootstrap-5') }} --}}
    </div>
@endsection

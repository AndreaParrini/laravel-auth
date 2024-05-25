@extends('layouts.admin')

@section('content')
    <div class="bg-dark py-4">
        <div class="container d-flex justify-content-between align-items-center text-light">
            <h3 class="my-3 text-uppercase text-center">Projects</h3>
            <a class="btn btn-primary" href="{{ route('admin.projects.create') }}"> <i class="fa fa-plus me-1"
                    aria-hidden="true"></i>Create</a>
        </div>

    </div>
    <div class="container mt-4">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @include('partials.error')
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Cover Image</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr class="">
                            <td scope="row">{{ $project->id }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->content }}</td>
                            <td>
                                @if (Str::startsWith($project->cover_image, 'https://'))
                                    <img width="140" src="{{ $project->cover_image }}" alt="Cover Image">
                                @else
                                    <img width="140" src="{{ asset('storage/' . $project->cover_image) }}"
                                        alt="Cover Image">
                                @endif

                            </td>
                            <td>{{ $project->slug }}</td>
                            <td class="text-nowrap">
                                <a class="btn btn-sm btn-primary" href="{{ route('admin.projects.show', $project) }}"><i
                                        class="fa fa-eye me-1" aria-hidden="true"></i>View</a>
                                <a class="btn btn-sm btn-secondary" href="{{ route('admin.projects.edit', $project) }}"><i
                                        class="fa fa-pencil me-1" aria-hidden="true"></i>Edit</a>
                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalId--{{ $project->id }}">
                                    <i class="fa fa-trash me-1" aria-hidden="true"></i>Delete
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId--{{ $project->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId--{{ $project->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId--{{ $project->id }}">
                                                    Delete a project
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-wrap">
                                                You are about to destroy this project :
                                                <strong>{{ $project->title }}</strong> ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <form action="{{ route('admin.projects.destroy', $project) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        Confirm
                                                    </button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @empty
                        <tr class="">
                            <td scope="row">No Record to show</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
            {{ $projects->links('pagination::bootstrap-5') }}
        </div>


    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="container">
        <h3 class="my-3 text-uppercase text-center">Projects</h3>
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
                                <img src="{{ $project->cover_image }}" alt="Cover Image">
                            </td>
                            <td>{{ $project->slug }}</td>
                            <td>
                                <a href="{{ route('admin.projects.show', $project) }}">View</a>
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

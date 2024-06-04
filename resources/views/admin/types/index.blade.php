@extends('layouts.admin')

@section('content')
    <div class="bg-dark py-4">
        <div class="container d-flex justify-content-between align-items-center text-light">
            <h3 class="my-3 text-uppercase text-center">Types</h3>
        </div>

    </div>
    <div class="container mt-4">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @include('partials.error')
        <div class="container">
            <div class="row rows-cols-2 gap-3">
                <div class="col">
                    <form action="{{ route('admin.types.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Add new Type</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" aria-describedby="helpId" placeholder="Es. Programming, BackEnd"
                                value="{{ old('hiddenField') == 'create' ? old('name') : '' }}" />
                            <small id="helpId" class="form-text text-muted">Insert here a name of your new type</small>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <input type="hidden" name="hiddenField" value="create">


                        <button type="submit" class="btn btn-primary">
                            Add
                        </button>

                    </form>
                </div>
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th class="text-nowrap">Total Post</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($types as $type)
                                    <tr class="">
                                        <td scope="row">{{ $type->id }}</td>
                                        <td>
                                            <form action="{{ route('admin.types.update', $type) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')

                                                <input type="text"
                                                    class="form-control @if (old('hiddenField') == $type->id) @error('name', 'nameType') is-invalid @enderror @endif"
                                                    name="name" id="name" aria-describedby="helpId"
                                                    placeholder="Es. Programming, BackEnd"
                                                    value="{{ old('hiddenField') == $type->id ? old('name', $type->name) : $type->name }}" />
                                                @if (old('hiddenField') == $type->id)
                                                    @error('name', 'nameType')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                @endif

                                                <input type="hidden" name="hiddenField" value="{{ $type->id }}">

                                            </form>
                                        </td>
                                        <td>{{ $type->slug }}</td>
                                        <td class="text-center">{{ $type->projects->count() }}</td>
                                        <td class="text-nowrap">
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('admin.types.show', $type) }}"><i class="fa fa-eye me-1"
                                                    aria-hidden="true"></i>View</a>
                                            <!-- Modal trigger button -->
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalId--{{ $type->id }}">
                                                <i class="fa fa-trash me-1" aria-hidden="true"></i>Delete
                                            </button>

                                            <!-- Modal Body -->
                                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                            <div class="modal fade" id="modalId--{{ $type->id }}" tabindex="-1"
                                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                                aria-labelledby="modalTitleId--{{ $type->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalTitleId--{{ $type->id }}">
                                                                Delete a type
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-wrap">
                                                            You are about to destroy this type :
                                                            <strong>{{ $type->name }}</strong> ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <form action="{{ route('admin.types.destroy', $type) }}"
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
                        {{ $types->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection

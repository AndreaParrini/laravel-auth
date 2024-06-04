@extends('layouts.admin')

@section('content')
    <div class="bg-dark py-4">
        <div class="container d-flex justify-content-between align-items-center text-light">
            <h3 class="my-3 text-uppercase text-center">Technologies</h3>
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
                    <form action="{{ route('admin.technologies.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Add new Technology</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" aria-describedby="helpId" placeholder="Es. Html, Css, Js ..."
                                value="{{ old('hiddenField') == 'create' ? old('name') : '' }}" />
                            <small id="helpId" class="form-text text-muted">Insert here a name of your new
                                technology</small>
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
                                @forelse ($technologies as $technology)
                                    <tr class="">
                                        <td scope="row">{{ $technology->id }}</td>
                                        <td>
                                            <form action="{{ route('admin.technologies.update', $technology) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')

                                                <input type="text"
                                                    class="form-control  @if (old('hiddenField') == $technology->id) @error('name', 'nameTechnology') is-invalid @enderror @endif"
                                                    name="name" id="name" aria-describedby="helpId"
                                                    placeholder="Es. Html, Css, Js ..."
                                                    value="{{ old('hiddenField') == $technology->id ? old('name', $technology->name) : $technology->name }}" />


                                                @if (old('hiddenField') == $technology->id)
                                                    @error('name', 'nameTechnology')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                @endif

                                                {{-- Aggiunto un campo nascosto e gli passo l'id, così in caso di errore riesco a capire quale ha dato errore e quindi gestire l'old del name e gli errori solo per quell'input li --}}
                                                <input type="hidden" name="hiddenField" value="{{ $technology->id }}">
                                            </form>
                                        </td>
                                        <td>{{ $technology->slug }}</td>
                                        <td class="text-center">{{ $technology->projects->count() }}</td>
                                        <td class="text-nowrap">
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('admin.technologies.show', $technology) }}"><i
                                                    class="fa fa-eye me-1" aria-hidden="true"></i>View</a>
                                            <!-- Modal trigger button -->
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalId--{{ $technology->id }}">
                                                <i class="fa fa-trash me-1" aria-hidden="true"></i>Delete
                                            </button>

                                            <!-- Modal Body -->
                                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                            <div class="modal fade" id="modalId--{{ $technology->id }}" tabindex="-1"
                                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                                aria-labelledby="modalTitleId--{{ $technology->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="modalTitleId--{{ $technology->id }}">
                                                                Delete a type
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-wrap">
                                                            You are about to destroy this technology :
                                                            <strong>{{ $technology->name }}</strong> ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <form
                                                                action="{{ route('admin.technologies.destroy', $technology) }}"
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
                        {{ $technologies->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection

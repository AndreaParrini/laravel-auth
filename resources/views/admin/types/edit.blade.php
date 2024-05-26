@extends('layouts.admin')

@section('content')
    <div class="bg-dark py-4">
        <div class="container d-flex justify-content-between align-items-center text-light">
            <h3 class="my-3 text-uppercase text-center">Modify type: {{ $type->name }}</h3>
            <a class="btn btn-primary" href="{{ route('admin.types.index') }}"><i class="fas fa-arrow-left me-1"
                    aria-hidden="true"></i>Cancel</a>
        </div>
    </div>
    <div class="container mt-4">

        @include('partials.error')
        <form action="{{ route('admin.types.update', $type) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="helpId" placeholder="Es. Programming, BackEnd"
                    value="{{ old('name', $type->name) }}" />
                <small id="helpId" class="form-text text-muted">Inserte here a new name of type</small>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

        </form>
    </div>
@endsection

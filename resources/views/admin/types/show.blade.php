@extends('layouts.admin')

@section('content')
    <div class="bg-dark py-4">
        <div class="container d-flex justify-content-between align-items-center text-light">
            <h3 class="my-3 text-uppercase text-center">{{ $type->title }}</h3>
            <a class="btn btn-primary" href="{{ route('admin.types.index') }}"><i class="fas fa-arrow-left me-1"
                    aria-hidden="true"></i>Return all types</a>
        </div>

    </div>
    <div class="container">
        <div class="row">
            <div class="col-6 my-5 text-center">
                <img class="rounded-4" width="450" src="https://picsum.photos/id/6/200/300" alt="Cover Image">
            </div>
            <div class="col-6 my-5 text-center ">
                <h3 class="text-uppercase my-4">{{ $type->name }}</h3>
                <p class="fst-italic">{{ $type->slug }}</p>
            </div>
        </div>

    </div>
@endsection

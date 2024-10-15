@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Become a Villain</h1>

        <form action="{{ route('admin.villains.store') }}" method="POST" enctype="multipart/form-data"
            class="p-4 border rounded bg-light">
            @csrf
            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name" class="form-control"
                        placeholder="Enter villain name" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <input type="file" name="image" id="image" class="form-control">
                    <small class="form-text text-muted">Upload an image (optional).</small>
                </div>
            </div>

            <div class="row mb-3">
                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <input type="text" name="phone" id="phone" class="form-control"
                        placeholder="Enter phone number">
                    <small class="form-text text-muted">Your contact phone number (optional).</small>
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" id="email" class="form-control"
                        placeholder="Enter contact email" required>
                    <small class="form-text text-muted">Provide a contact email.</small>
                </div>
            </div>

            <div class="row mb-3">
                <label for="universe_id" class="col-sm-2 col-form-label">Universe</label>
                <div class="col-sm-10">
                    <select name="universe_id" id="universe_id" class="form-select">
                        @foreach ($universes as $universe)
                            <option value="{{ $universe->id }}">{{ $universe->name }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Select the universe.</small>
                </div>
            </div>

            <div class="d-grid gap-2 d-md-block">
                <button type="submit" class="btn btn-primary">Sign in now</button>
            </div>
        </form>
    </div>
@endsection

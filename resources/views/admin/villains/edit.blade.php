@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">{{ $villain->name }}, edit your profile</h1>

        <form action="{{ route('admin.villains.update', $villain) }}" method="POST" enctype="multipart/form-data"
            class="p-4 border rounded bg-light">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name" class="form-control" required value="{{ old('name', $villain->name) }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <input type="file" name="image" id="image" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $villain->phone) }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" id="email" class="form-control" required value="{{ old('email', $villain->email) }}">
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
                </div>
            </div>
            {{-- Skills --}}
            <div class="row mb-3">
                <label for="skill_id" class="col-sm-2 col-form-label">Skills</label>
                <div class="col-sm-10">
                    <select name="skill_id" id="skill_id" class="form-select">
                        @foreach ($skills as $skill)
                            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-grid gap-2 d-md-block">
                <a href="{{ route('admin.villains.edit', $villain) }}" class="btn btn-primary">Edit</a>
            </div>
        </form>
    </div>
@endsection

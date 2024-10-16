@extends('layouts.app')

@section('content')
    {{-- controllo erroi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="container mt-5">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <h1 class="mb-4">Become a Villain</h1>

        <form action="{{ route('admin.villains.store') }}" method="POST" enctype="multipart/form-data"
            class="p-4 border rounded bg-light">
            @csrf

            {{-- Campo nome --}}
            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Enter villain name" required>
                    @error('name')
                        <small class="text-danger mt-2">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Campo immagine --}}
            <div class="row mb-3">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <input type="file" name="image" id="image"
                        class="form-control @error('image') is-invalid @enderror">
                    <small class="form-text text-muted">Upload an image (optional).</small>
                    @error('image')
                        <small class="text-danger mt-2">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Campo telefono --}}
            <div class="row mb-3">
                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <input type="text" name="phone" id="phone"
                        class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone number">
                    <small class="form-text text-muted">Your contact phone number (optional).</small>
                    @error('phone')
                        <small class="text-danger mt-2">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Campo email --}}
            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email_contact" id="email"
                        class="form-control @error('email_contact') is-invalid @enderror" placeholder="Enter contact email"
                        required>
                    <small class="form-text text-muted">Provide a contact email.</small>
                    @error('email_contact')
                        <small class="text-danger mt-2">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Campo universo --}}
            <div class="row mb-3">
                <label for="universe_id" class="col-sm-2 col-form-label">Universe</label>
                <div class="col-sm-10">
                    <select name="universe_id" id="universe_id"
                        class="form-select @error('universe_id') is-invalid @enderror">
                        @foreach ($universes as $universe)
                            <option value="{{ $universe->id }}">{{ $universe->name }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Select the universe.</small>
                    @error('universe_id')
                        <small class="text-danger mt-2">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="d-grid gap-2 d-md-block">
                <button type="submit" class="btn btn-primary">Sign in now</button>
            </div>
        </form>
    </div>
@endsection

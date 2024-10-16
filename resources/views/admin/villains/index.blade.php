@extends('layouts.app')

@section('content')
    {{-- information card for each individual profile --}}
    {{-- <div class="d-flex justify-content-center">
        <div class="card" style="width: 100%;">
            <img src="{{ asset('storage/' . $villain->image) }}" class="card-img-top" alt="{{ $villain->name }} image">
            <div class="card-body">
                <h3 class="card-title">{{ $villain->name }}</h3>
                <h5 class="card-text">{{ $villain->universe->name }}</h5>
                <h5 class="card-text">{{ $villain->user->email }}</h5>
                <h5 class="card-text">{{ $villain->phone }}</h5>
                <a href="{{ route('admin.villains.edit', $villain) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div> --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Card for villain profile --}}
            <div class="card villain-card shadow-lg border-0">
                {{-- Show the villain's image --}}
                <div class="position-relative villain-image">
                    <img src="/placeholder_img.jpg" alt="{{ $villain->name }}" class="card-img-top img-fluid"
                        alt="{{ $villain->name }}">
                    <div class="position-absolute bottom-0 start-0 p-3 text-white villain-name-overlay">
                        <h3 class="text-center mb-0">{{ $villain->name }}</h3>
                    </div>
                </div>

                <div class="card-body py-4">
                    {{-- Villain's email --}}
                    <p>
                        <i class="fas fa-envelope text-primary"></i>
                        <strong>Email:</strong>
                        <a href="mailto:{{ $villain->email_contact }}"
                            class="text-decoration-none">{{ $villain->email_contact }}</a>
                    </p>

                    {{-- Villain's phone number --}}
                    <p>
                        <i class="fas fa-phone text-primary"></i>
                        <strong>Phone:</strong>
                        {{ $villain->phone ?? 'Not provided' }}
                    </p>

                    {{-- Villain's universe --}}
                    <p>
                        <i class="fas fa-globe text-primary"></i>
                        <strong>Universe:</strong>
                        {{ $villain->universe->name }}
                    </p>

                </div>
            </div>
        </div>
    </div>
@endsection

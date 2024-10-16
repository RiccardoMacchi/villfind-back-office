@extends('layouts.app')

@section('content')
    {{-- information card for each individual profile --}}
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="card mb-3" style="max-width: 800px;">
            <div class="row g-0 p-0">
                <div class="col-md-5 p-0">
                    <img src="{{ asset('storage/' . $villain->image) }}" class="img-fluid rounded-2 p-0 h-100" style="width: 100%; alt="{{ $villain->name }}">
                </div>
                <div class="col-md-7">
                    <div class="card-body ms-3">
                        <h2 class="card-title mb-4 fw-bold text-primary fs-1">{{ $villain->name }}</h2>
                        <div class="mb-4">
                            <i class="fas fa-envelope text-primary"></i>
                            <strong class="text-primary">Email:</strong>
                            <a href="mailto:{{ $villain->email_contact }}" class="text-decoration-none">
                                {{ $villain->email_contact ?? '-' }}
                            </a>
                        </div>
                        <div class="mb-4">
                            <i class="fas fa-phone text-primary"></i>
                            <strong class="text-primary">Phone:</strong>
                            {{ $villain->phone ?? '-' }}
                        </div>
                        <div class="mb-4">
                            <i class="fas fa-globe text-primary"></i>
                            <strong class="text-primary">Universe:</strong>
                            {{ $villain->universe->name }}
                        </div>
                        <div class="mb-4">
                            <i class="fas fa-hand-sparkles text-primary"></i>
                            <strong class="text-primary">Skills:</strong>
                            <ul>
                                @foreach ($skills as $skill)
                                <li>
                                    {{ $skill->name }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="mb-4">
                            <i class="fas fa-concierge-bell text-primary"></i>
                            <strong class="text-primary">Services:</strong>
                            <ul>
                                @foreach ($services as $service)
                                <li>
                                    {{ $service->name }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ route('admin.villains.edit', $villain) }}" class="btn btn-primary mt-4">Edit your profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
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

    {{-- information card for each individual profile --}}
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="card mb-3 p-0 col-12 col-sm-11 col-lg-9 col-xl-8 overflow-hidden">
                <div class="row g-0 p-0">
                    <div class="col-lg-5 p-0">
                        <img src="{!! asset('storage/' . $villain->image) !!}" alt="{!! $villain->name !!}"
                             class="img-fluid p-0 h-100 w-100 object-fit-cover"
                             onerror="this.onerror=null; this.src='{!! Vite::asset('resources/images/placeholders/image-placeholder-vertical.jpg') !!}'">
                    </div>
                    <div class="col-lg-7">
                        <div class="card-body ms-3">
                            <h2 class="card-title mb-4 fw-bold text-primary fs-1">
                                {{ $villain->name }}
                            </h2>
                            <div class="mb-4">
                                <i class="fas fa-envelope text-primary"></i>
                                <strong class="text-primary">Email:</strong>
                                <a href="mailto:{{ $villain->email_contact }}"
                                   class="text-decoration-none">
                                    {{ $villain->email_contact ?? '-' }}
                                </a>
                            </div>
                            <div class="mb-4">
                                <i class="fas fa-phone text-primary"></i>
                                <strong class="text-primary">Phone:</strong>
                                {{ $villain->phone ?? '-' }}
                            </div>
                            <div class="mb-4">
                                <i class="fas fa-star text-primary"></i>
                                <strong class="text-primary">Average rating:</strong>
                                {{ number_format($averageRating, 2) }}
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
                                    @foreach ($villain->skills as $skill)
                                        <li>{{ $skill->name }}</li>
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
                            <a href="{{ route('admin.villains.edit', $villain) }}"
                               class="btn btn-primary mt-4">
                                Edit your profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

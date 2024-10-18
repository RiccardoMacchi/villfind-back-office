@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="card mb-3 p-0 col-11 col-lg-9 col-xl-8 overflow-hidden">
                <div class="row g-0 p-0">
                    <div class="col-lg-5 p-0">
                        <img src="{!! $villain->image !!}" alt="{!! $villain->name !!}"
                             class="img-fluid p-0 h-100 w-100 object-fit-cover"
                             onerror="this.onerror=null; this.src='{!! Vite::asset('resources/images/placeholders/image-placeholder-vertical.jpg') !!}'">
                    </div>
                    <div class="col-lg-7">
                        <div class="card-body ps-5">
                            <h2 class="card-title fw-bold text-primary">
                                {{ $villain->name }}
                            </h2>
                            <div class="my-4">
                                <div class="mb-3">
                                    <strong class="text-primary">
                                        <i class="fas fa-envelope"></i>&ensp;Contact Email:
                                    </strong>

                                    @if ($userEmail)
                                        <span class="ps-3 d-block">
                                            {{ $userEmail }}
                                        </span>
                                    @else
                                        <span class="fst-italic ps-3 d-block">
                                            No address added yet
                                        </span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <strong class="text-primary">
                                        <i class="fas fa-phone"></i>&ensp;Contact Phone:
                                    </strong>

                                    @if ($villain->phone)
                                        <span class="ps-3 d-block">
                                            {{ $villain->phone }}
                                        </span>
                                    @else
                                        <span class="fst-italic ps-3 d-block">
                                            No number added yet
                                        </span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <strong class="text-primary">
                                        <i class="fas fa-star"></i>&ensp;Average Rating:
                                    </strong>

                                    @if (!$villain->ratings->isEmpty())
                                        <span class="ps-3 d-block">
                                            <span class="rating">
                                                {!! $average_rating_icons !!}
                                            </span>
                                            &#40;{{ number_format($average_rating, 2) }}&#41;
                                        </span>
                                    @else
                                        <span class="fst-italic ps-3 d-block">
                                            No reviews received yet
                                        </span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <strong class="text-primary">
                                        <i class="fas fa-globe"></i>&ensp;Universe:
                                    </strong>

                                    <span class="ps-3 d-block">
                                        {{ $villain->universe->name }}
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <strong class="text-primary">
                                        <i class="fas fa-hand-sparkles"></i>&ensp;Skills:
                                    </strong>

                                    @if (!$villain->skills->isEmpty())
                                        <ul class="ps-3">
                                            @foreach ($villain->skills->sortBy('name') as $skill)
                                                <li>{{ $skill->name }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="fst-italic ps-3 d-block">
                                            No skills added yet
                                        </span>
                                    @endif
                                </div>

                                <div>
                                    <strong class="text-primary">
                                        <i class="fas fa-concierge-bell"></i>&ensp;Services:
                                    </strong>

                                    @if (!$villain->services->isEmpty())
                                        <ul class="ps-3">
                                            @foreach ($villain->services->sortBy('name') as $service)
                                                <li>
                                                    {{ $service->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="fst-italic ps-3 d-block">
                                            No services added yet
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <a href="{{ route('admin.villains.edit', $villain) }}"
                               class="btn btn-primary">
                                Edit your profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

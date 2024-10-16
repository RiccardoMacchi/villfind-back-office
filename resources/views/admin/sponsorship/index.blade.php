@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h1 class="text-primary my-4">
            Sponsorship
        </h1>

        <div class="d-flex justify-content-between gap-3">
            @foreach ($sponsorship as $plan)
                <div class="card mb-3 p-0 p-4" style="width: 15rem">
                    <div>
                        <h3 class="card-title mb-4 fw-bold text-primary fs-5">{{ $plan->name }}</h3>
                        <div>
                            <span class=" fs-6" style="font: 900"><strong>Price:</strong></span>
                            <span>{{ $plan->price }} &#8364</span>
                        </div>
                        <div>
                            <span class="fs-6"><strong>Duration:</strong></span>
                            <span>{{ $plan->hours }} hours</span>
                        </div>
                    </div>
                    <div class="flex-shrink-0 py-3 text-primary fs-3">
                        <i class="fa-solid fa-cart-plus"></i>
                    </div>
                </div>
            @endforeach
        </div>
    @endsection

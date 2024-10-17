@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h1 class="text-primary my-4">
            Sponsorship
        </h1>

        <div class="d-flex justify-content-center gap-3 flex-wrap">
            @foreach ($sponsorship as $plan)
                <div class="card p-3 d-flex flex-column justify-content-end gap-4" style="width: 15rem">
                    <h2 class="card-title text-primary mb-auto" style="font-size: 1.75rem">
                        {{ $plan->name }}
                    </h2>

                    <div>
                        <div>
                            <strong class="fw-bolder">Price:</strong>
                            <span>{{ number_format($plan->price, 2) }} &#8364</span>
                        </div>

                        <div>
                            <strong class="fw-bolder">Duration:</strong>
                            <span>{{ $plan->hours }} hours</span>
                        </div>
                    </div>

                    <a href="#" class="btn btn-primary btn-lg">
                        <i class="fa-solid fa-cart-plus"></i>
                    </a>
                </div>
            @endforeach
        </div>
    @endsection

<?php
$clientToken = session('clientToken');
$price = session('price');
$hours = session('hours');
$clicked = session('clicked', false);
?>

@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h1 class="text-primary my-4">
            Sponsorships
        </h1>
        <p class="text-primary fw-semibold pb-3" style="font-size: 1.1rem">Do you want to highlight your profile? Our Premium
            packages provide a unique
            visibility
            boost: your profile will
            appear on the home page with an exclusive, customized style, and will always be at the top of advanced searches,
            making you immediately visible and attractive to visitors throughout the selected period.</p>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif


        <div class="d-flex justify-content-center gap-3 flex-wrap">
            @foreach ($sponsorships as $plan)
                <div class="card shadow p-3 d-flex flex-column justify-content-end gap-3" style="width: 18rem">
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

                        <div class="pt-2">
                            <span>{{ $plan->description }}</span>
                        </div>
                    </div>

                    <form action="{{ route('checkout.show', $plan) }}" method="GET">
                        <button id="active_payment" type="submit" class="btn btn-primary btn-lg">
                            <i class="fa-solid fa-cart-plus"></i>
                        </button>
                    </form>

                    {{-- <form action="{{ route('admin.sponsorship.purchase', $plan) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fa-solid fa-cart-plus"></i>
                        </button>
                    </form> --}}
                </div>
            @endforeach
        </div>
        @if ($clicked)
            <div>
                @include('../../checkout')
            </div>
        @endif

        @if ($is_sponsored)
            <div class="card shadow text-white p-4 mt-5 gap-3 bg-primary-special w-100">
                <div class="row">
                    <div class="col-lg-5 mb-3 mb-lg-0 d-flex flex-column justify-content-center">
                        <img src="{!! Vite::asset('resources/images/logos/logos-lt/logo-lt-mark.png') !!}" alt="Thank you!" class="w-100">
                    </div>

                    <div class="col-lg-7 d-flex flex-column justify-content-center gap-2 text-center">
                        <div>
                            <h2 class="mb-2">
                                You are currently sponsored!
                            </h2>

                            <p class="m-0">
                                Thank you for choosing our service! Your sponsorship is now active,
                                providing you with enhanced visibility and positioning you ahead of
                                others. This is a
                                valuable opportunity to reach a wider audience and promote your
                                offerings
                                effectively. We appreciate your trust in us, and we’re excited to help
                                you achieve your
                                goals!
                            </p>
                        </div>

                        <div>
                            <strong class="fnt-size-4 d-block mb-2">
                                Sponsorship expiration date:
                            </strong>

                            <span>
                                {{ $orders->first()->pivot->precise_expiration_date }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <h2 class="text-primary mt-5 mb-3">
            Purchase History
        </h2>

        <x-admin.table :items="$orders" :columns="$columns" />
    </div>

    <script>
        var activeScript = document.getElementById('active_payment')
        activeScript
    </script>
@endsection

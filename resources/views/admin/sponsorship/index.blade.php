@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h1 class="text-primary my-4">
            Sponsorships
        </h1>

        <div class="d-flex justify-content-center gap-3 flex-wrap">
            @foreach ($sponsorships as $plan)
                <div class="card shadow p-3 d-flex flex-column justify-content-end gap-4"
                     style="width: 15rem">
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

                    <form action="{{ route('admin.sponsorship.purchase', $plan) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fa-solid fa-cart-plus"></i>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <h2 class="text-primary mt-5 mb-3">
            Purchase History
        </h2>

        <x-admin.table :items="$orders" :columns="$columns" />
    </div>
@endsection

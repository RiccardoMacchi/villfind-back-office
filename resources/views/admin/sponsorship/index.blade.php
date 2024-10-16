@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h2 class="fs-4 text-primary my-4">
            Sponsorship
        </h2>
        <div>

            <div class="card">
                @foreach ($sponsorship as $plan)
                    <div class="card-body p-0">
                        <h2>{{ $plan->name }}</h2>
                        <h5>{{ $plan->price }}</h5>
                        <h5>{{ $plan->hours }}</h5>
                    </div>
                @endforeach
            </div>
        </div>
    @endsection

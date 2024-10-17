@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h2 class="fs-4 text-primary my-4 text-center">
            Sponsorship plans available
        </h2>
        <div class="d-flex gap-3 justify-content-center">
            @foreach ($sponsorship as $plan)
                <div class="card mb-3 p-0 p-4" style="width: 15rem">
                    <div>
                        <div>
                            <strong class="fw-bolder">Name:</strong>
                            <span>{{ $plan->name }} hours</span>
                        </div>
                        <div>
                            <strong class="fw-bolder">Price:</strong>
                            <span>{{ number_format($plan->price, 2) }} &#8364</span>
                            <span class="fs-6" style="font: 900"><strong>Price:</strong></span>
                            <span>{{ $plan->price }} &#8364</span>
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

        {{-- <div class="container p-4">
            <h2 class="fs-4 text-primary my-4 text-center">
                History of your Sponsorship
            </h2>
            @if (isset($sponsorships) && $sponsorships->isEmpty())
                <p>No sponsorships found.</p>
            @else
                <div>
                    <div class="card shadow-lg border-0 mb-4">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <span><i class="fa-solid fa-timeline"></i> Sponsorships linked to this profile</span>
                            <span class="pagination-info"></span>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-primary">Sponsorship Name</th>
                                        <th scope="col" class="w-50 text-primary">Purchase Price</th>
                                        <th scope="col" class="text-primary">Expiration Date</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    @foreach ($sponsorships as $single)
                                        <tr>
                                            <td>{{ $single->name }}</td>
                                            <td>{{ $single->pivot->purchase_price }}</td>
                                            <td>{{ $single->pivot->expiration_date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div> --}}
    </div>
@endsection

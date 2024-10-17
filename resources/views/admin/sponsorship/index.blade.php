@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h1 class="text-primary my-4">
            Sponsorship
        </h1>

        <div class="d-flex justify-content-center gap-3 flex-wrap">
            @foreach ($sponsorships as $plan)
                <div class="card shadow p-3 d-flex flex-column justify-content-end gap-4" style="width: 15rem">
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
    </div>


    <div class="container p-4">
        <h2 class="fs-4 text-primary my-4 text-center">
            History of your Sponsorship
        </h2>
        @if (isset($sponsorshipDetails) && $sponsorshipDetails->isEmpty())
            <p class="text-primary">You have no active sponsorship sponsorship. You have no past sponsorship records</p>
        @else
            <div>
                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <span><i class="fa-solid fa-timeline"></i> Sponsorships linked to this
                            profile</span>
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
                                @foreach ($sponsorshipDetails as $single)
                                    <tr>
                                        <td>{{ $single->name }}</td>
                                        <td>{{ $single->pivot->purchase_price }} &#8364</td>
                                        <td>{{ $single->pivot->expiration_date }} h</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

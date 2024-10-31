@extends('layouts.app')

@section('content')
    <div class="container container mb-3">
        <h2 class="text-primary mt-5 mb-3">
            Review detail
        </h2>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="mb-4 col-lg-4">
                <h3 class="text-primary d-inline">Name:</h3>
                <h5 class="d-inline fnt-size-7">
                    {{ $rating->pivot->full_name }}
                </h5>
            </div>

            <div class="mb-4 col-lg-4">
                <h3 class="text-primary d-inline">Date:</h3>
                <h5 class="d-inline fnt-size-7">
                    {{ $rating->pivot->formatted_created_at }}
                </h5>
            </div>

            <div class="mb-4 col-lg-4">
                <h3 class="text-primary d-inline">Vote:</h3>
                <h5 class="d-inline fnt-size-7 star-detail">
                    {!! \App\Functions\Helper::iconifyRating($rating->value) !!}
                </h5>
            </div>

            @if ($rating->pivot->content)
                <div class="mb-4">
                    <h3 class="text-primary d-inline">Review:</h3>
                    <p class="d-inline fnt-size-7">
                        {{ $rating->pivot->content }}
                    </p>
                </div>
            @endif
        </div>

        <a href="{{ route('admin.ratings.index') }}" class="btn btn-primary mt-3">
            Back
        </a>

    </div>
@endsection

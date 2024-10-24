@extends('layouts.app')

@section('content')
    <div class="container container mb-3">
        <h1 class="text-primary my-4">
            Review
        </h1>


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
                <h2 class="text-primary">Name:</h2>
                <strong class="fnt-size-4">
                    {{ $rating->pivot->full_name }}
                </strong>
            </div>

            <div class="mb-4 col-lg-4">
                <h2 class="text-primary">Date:</h2>
                <span class="fnt-size-4">
                    {{ $rating->pivot->created_at }}
                </span>
            </div>

            <div class="mb-4 col-lg-4">
                <h2 class="text-primary">Vote:</h2>
                <span class="fnt-size-4 rating">
                    {!! \App\Functions\Helper::iconifyRating($rating->value) !!}
                </span>
            </div>

            @if ($rating->pivot->content)
                <div class="mb-4">
                    <h2 class="text-primary">Review:</h2>
                    <p class="fnt-size-4">
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

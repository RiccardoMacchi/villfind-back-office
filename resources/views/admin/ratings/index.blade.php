@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h1 class="text-primary my-4">
            Ratings
        </h1>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($ratings->count())
            <span class="d-block text-center mb-3 fnt-size-4">
                <span class="rating">
                    {!! $average_rating_icons !!}
                </span>
                &#40;{{ number_format($average_rating, 2) }}&#41;
            </span>
        @endif

        {{-- @include('admin.partials.chart', ['ratings_counts' => $ratings_counts]) --}}

        <h2 class="text-primary mt-5 mb-3">
            Reviews
        </h2>

        <x-admin.table :items="$ratings" :columns="$columns" :isViewable="'pivot->id'" />

        {{-- <a href="{{ route('admin.ratings.statistics') }}" class="btn btn-primary mt-3">Statistics</a> --}}
    </div>
@endsection

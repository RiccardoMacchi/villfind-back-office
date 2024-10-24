@extends('layouts.app')

@section('content')
    {{-- controllo erroi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container py-4">
        <div class="fs-5 mb-3"><strong>Name:</strong> {{ $review->full_name }}</div>
        <div class="fs-6 mb-5"><strong>Date:</strong> {{ $review->created_at }}</div>
        <div class="fs-5 mb-3">
            <strong>Vote:</strong>
            <span class="rating">
                {!! \App\Functions\Helper::iconifyRating($rating->value) !!}
            </span>
        </div>

        <div class="fs-5 mt-4 mb-2">
            <strong>
                Review:
            </strong>
        </div>
        <p>
            {{ $review->content ?? 'No content' }}
        </p>

        <a href="{{ route('admin.ratings.index') }}" class="btn btn-primary mt-3">
            Back
        </a>

    </div>

@endsection

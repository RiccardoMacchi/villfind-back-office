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
        <div class="fs-5 mb-3"><strong>Sender:</strong> {{ $rating->pivot->full_name }}</div>
        <div class="fs-6 mb-3"><strong>Vote:</strong> {{ $rating->value }}</div>
        <div class="fs-6 mb-5"><strong>Date:</strong> {{ $rating->created_at }}</div>

        <div class="fs-5 mb-3"><strong>Message:</strong></div>
        <p>{{ $rating->pivot->content ?? 'No Content' }}</p>

    </div>

@endsection

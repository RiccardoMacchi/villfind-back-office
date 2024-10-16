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
        <div class="fs-5 mb-3"><strong>Sender:</strong> {{ $message->full_name }}</div>
        <div class="fs-6 mb-3"><strong>Phone:</strong> {{ $message->phone }}</div>
        <div class="fs-6 mb-5"><strong>Email:</strong> {{ $message->email }}</div>

        <div class="fs-5 mb-3"><strong>Message:</strong></div>
        <p>{{ $message->content }}</p>

        <button class="btn btn-primary mt-4">
            <a href="{{ route('admin.messages.index') }}">Back</a>
        </button>
    </div>


@endsection

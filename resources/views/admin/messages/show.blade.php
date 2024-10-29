@extends('layouts.app')

@section('content')
    <div class="container container mb-3">
        <h1 class="text-primary my-4">
            Message
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
            <div class="mb-4">
                <h2 class="text-primary">Sender:</h2>
                <strong class="fnt-size-4">
                    {{ $message->full_name }}
                </strong>
            </div>

            <div class="mb-4 col-lg-4">
                <h2 class="text-primary">Date:</h2>
                <span class="fnt-size-4">
                    {{ $message->created_at_formatted }}
                </span>
            </div>

            <div class="mb-4 col-lg-4">
                <h2 class="text-primary">Email:</h2>
                <span class="fnt-size-4">
                    {{ $message->email }}
                </span>
            </div>

            <div class="mb-4 col-lg-4">
                <h2 class="text-primary">Phone:</h2>
                <span class="fnt-size-4">
                    {{ $message->phone }}
                </span>
            </div>

            <div class="mb-4">
                <h2 class="text-primary">Text:</h2>
                <p class="fnt-size-4">
                    {{ $message->content }}
                </p>
            </div>
        </div>

        <a href="{{ route('admin.ratings.index') }}" class="btn btn-primary mt-3">
            Back
        </a>

    </div>
@endsection

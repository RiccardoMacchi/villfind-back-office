@extends('layouts.app')

@section('content')
    <div class="container container mb-3">
        <h2 class="text-primary mt-5 mb-3">
            Message detail
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
            <div class="mb-4">
                <h3 class="text-primary d-inline">Sender : </h3>
                <h5 class="d-inline fnt-size-7">
                    {{ $message->full_name }}
                </h5>
            </div>

            <div class="mb-4 col-lg-4">
                <h3 class="text-primary d-inline">Date:</h3>
                <span class="fnt-size-7">
                    {{ $message->formatted_created_at }}
                </span>
            </div>

            <div class="mb-4 col-lg-4">
                <h3 class="text-primary d-inline">Email:</h3>
                <span class="fnt-size-7">
                    {{ $message->email }}
                </span>
            </div>

            <div class="mb-4 col-lg-4">
                <h3 class="text-primary d-inline">Phone:</h3>
                <span class="fnt-size-7">
                    {{ $message->phone }}
                </span>
            </div>

            <div class="mb-4">
                <h3 class="text-primary d-inline">Text:</h3>
                <p class="fnt-size-7">
                    {{ $message->content }}
                </p>
            </div>
        </div>

        <a href="{{ route('admin.messages.index') }}" class="btn btn-primary mt-3">
            Back
        </a>
    </div>
@endsection

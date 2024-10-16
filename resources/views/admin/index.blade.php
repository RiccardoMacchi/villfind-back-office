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

    <div class="container mt-5">
        <h2 class="fs-3 text-primary my-4">
            Dashboard
        </h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-primary shadow-sm">
                    <div class="card-header bg-primary text-white">{{ __('User Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <span>You are logged in!</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

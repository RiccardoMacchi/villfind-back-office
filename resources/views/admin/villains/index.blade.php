@php
    // $userVillain = App\Models\Villain::where('user_id', Auth::id())->first();
@endphp
@extends('layouts.app')

@section('content')

    @if(session('edited'))
        <div class="alert alert-success" role="alert">
            {{ session('edited') }}
        </div>
    @endif

    {{-- information card for each individual profile --}}
    <div class="d-flex justify-content-center">
        <div class="card" style="width: 100%;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Name</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's
                    content.</p>
                    <a href="{{ route('admin.villains.edit', $villains) }}" class="nav-link">Edit</a>
            </div>
        </div>
    </div>

    {{-- <button>
        @if (!$userVillain)
            <a href="{{ route('admin.villains.create') }}" class="nav-link">Become a Villain</a>
        @endif
    </button> --}}
@endsection

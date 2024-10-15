@php
    // $userVillain = App\Models\Villain::where('user_id', Auth::id())->first();
@endphp
@extends('layouts.app')

@section('content')
    {{-- information card for each individual profile --}}
    <div class="d-flex justify-content-center">
        <div class="card" style="width: 100%;">
            <img src="{{ asset('storage/' . $villain->image) }}" class="card-img-top" alt="{{ $villain->name }} image">
            <div class="card-body">
                <h3 class="card-title">{{ $villain->name }}</h3>
                <h5 class="card-text">{{ $villain->universe->name }}</h5>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>

    {{-- <button>
        @if (!$userVillain)
            <a href="{{ route('admin.villains.create') }}" class="nav-link">Become a Villain</a>
        @endif
    </button> --}}
@endsection

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
        <h1>rating</h1>
        <span>Media: {{ $averageRating }}</span>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <h3>Totale Visualizzazioni in 1 anno: {{ $totalViews }}</h3>
    <h3>Totale Visualizzazioni negli ultimi 6 mesi: {{ $sixMonthViews }}</h3>
    <ul>
        @foreach ($monthlyViews as $views)
            <li>{{ $views->month }} : {{ $views->views }}</li>
        @endforeach
    </ul>
@endsection

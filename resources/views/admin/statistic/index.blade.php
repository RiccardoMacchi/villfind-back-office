@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-primary my-4">Statistics Views</h2>
        <h4 class="text-primary mt-2 mb-3">Total Views in the Last 12 Months: {{ array_sum($monthlyViews) }}</h4>
        @include('admin.statistic.partials.chart', [
            'chartId' => 'viewsChart',
            'data' => array_values($monthlyViews),
            'labels' => array_keys($months),
            'chartLabel' => 'Monthly Views',
            'backgroundColors' => ['rgba(53, 0, 95, 0.2)'],
            'borderColors' => ['rgba(53, 0, 95, 1)'],
        ])

        <h2 class="text-primary my-4">Statistics Reviews</h2>
        <h4 class="text-primary mt-2 mb-3">Total Reviews in the Last 12 Months: {{ array_sum($monthlyReviews) }}</h4>
        @include('admin.statistic.partials.chart', [
            'chartId' => 'reviewsChart',
            'data' => array_values($monthlyReviews),
            'labels' => array_keys($months),
            'chartLabel' => 'Recensioni Mensili',
            'backgroundColors' => ['rgba(54, 162, 235, 0.2)'],
            'borderColors' => ['rgba(54, 162, 235, 1)'],
        ])

        <h2 class="text-primary my-4">Message Statistics</h2>
        <h4 class="text-primary mt-2 mb-3">Total Message in the Last 12 Months: {{ array_sum($monthlyMessages) }}</h4>
        @include('admin.statistic.partials.chart', [
            'chartId' => 'messagesChart',
            'data' => array_values($monthlyMessages),
            'labels' => array_keys($months),
            'chartLabel' => 'Messaggi Mensili',
            'backgroundColors' => ['rgba(75, 192, 192, 0.2)'],
            'borderColors' => ['rgba(75, 192, 192, 1)'],
        ])

    </div>
@endsection

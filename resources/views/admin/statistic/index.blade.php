@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h1 class="text-primary my-4">
            Statistics
        </h1>

        <h2 class="text-primary mb-3">
            Views
        </h2>

        <span class="d-block text-center mb-3 fnt-size-4">
            Total in Last 12 Months: <strong>{{ array_sum($monthlyViews) }}</strong>
        </span>

        @include('admin.statistic.partials.chart', [
            'chartId' => 'viewsChart',
            'data' => array_values($monthlyViews),
            'labels' => array_keys($months),
            'chartLabel' => 'Monthly Views',
            'backgroundColors' => ['rgba(53, 0, 95, 0.3)'],
            'borderColors' => ['rgba(53, 0, 95, 1)'],
        ])

        <h2 class="text-primary mt-5 mb-3">
            Reviews
        </h2>

        <span class="d-block text-center mb-3 fnt-size-4">
            Total in Last 12 Months: <strong>{{ array_sum($monthlyReviews) }}</strong>
        </span>

        @include('admin.statistic.partials.chart', [
            'chartId' => 'reviewsChart',
            'data' => array_values($monthlyReviews),
            'labels' => array_keys($months),
            'chartLabel' => 'Monthly Reviews',
            'backgroundColors' => ['rgba(54, 162, 235, 0.3)'],
            'borderColors' => ['rgba(54, 162, 235, 1)'],
        ])

        <h2 class="text-primary mt-5 mb-3">
            Messages
        </h2>

        <span class="d-block text-center mb-3 fnt-size-4">
            Total in Last 12 Months: <strong>{{ array_sum($monthlyMessages) }}</strong>
        </span>

        @include('admin.statistic.partials.chart', [
            'chartId' => 'messagesChart',
            'data' => array_values($monthlyMessages),
            'labels' => array_keys($months),
            'chartLabel' => 'Monthly Messages',
            'backgroundColors' => ['rgba(75, 192, 192, 0.3)'],
            'borderColors' => ['rgba(75, 192, 192, 1)'],
        ])

    </div>
@endsection

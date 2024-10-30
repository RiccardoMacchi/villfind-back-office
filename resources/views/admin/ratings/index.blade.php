@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h1 class="text-primary my-4">
            Ratings
        </h1>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($ratings->count())
            <span class="d-block text-center mb-3 fnt-size-4">
                <span class="rating">
                    {!! $average_rating_icons !!}
                </span>
                &#40;{{ number_format($average_rating, 2) }}&#41;
            </span>
        @endif

        <canvas id="ratingsChart" style="max-width: 600px;" class="w-100 h-auto mx-auto d-block"></canvas>

        <h2 class="text-primary mt-5 mb-3">
            Reviews
        </h2>
        <div class="col-12">
            <x-admin.table :items="$ratings" :columns="$columns" :isViewable="'pivot->id'" />
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ratingsCounts = @json($ratings_counts);

        const ctx = document.getElementById('ratingsChart').getContext('2d');

        const totalRatings = ratingsCounts[1] + ratingsCounts[2] + ratingsCounts[3] + ratingsCounts[4] +
            ratingsCounts[5];

        if (totalRatings === 0) {
            displayNoReviewsMessage();
        } else {
            const ratingsChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: [
                        '1 Star',
                        '2 Stars',
                        '3 Stars',
                        '4 Stars',
                        '5 Stars'
                    ],
                    datasets: [{
                        label: 'Number of Ratings',
                        data: [
                            ratingsCounts[1],
                            ratingsCounts[2],
                            ratingsCounts[3],
                            ratingsCounts[4],
                            ratingsCounts[5]
                        ],
                        backgroundColor: [
                            '#35005f',
                            '#6a0dad',
                            '#4737a2',
                            '#236196',
                            '#008b8b'
                        ],
                        borderColor: '#F5F5F5',
                        borderWidth: 4
                    }]
                },
                options: {
                    cutout: '60%',
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                padding: 15
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    const total = tooltipItem.dataset.data.reduce((acc,
                                        curr) => acc + curr, 0);
                                    const value = tooltipItem.raw;
                                    const percentage = ((value / total) * 100).toFixed(2);
                                    return `${value} Ratings (${percentage}%)`;
                                }
                            }
                        }
                    }

                }
            });

            // Optionally resize the chart on window resize
            window.addEventListener('resize', function() {
                ratingsChart.resize();
            });
        }

        function displayNoReviewsMessage() {
            ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
            ctx.font = "20px Arial";
            ctx.fillStyle = "#000";
            ctx.textAlign = "center";
            ctx.textBaseline = "middle";
            ctx.fillText("No Reviews", ctx.canvas.width / 2, ctx.canvas.height / 2);
        }
    </script>
@endsection

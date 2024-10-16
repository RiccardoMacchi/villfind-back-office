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

    <div class="container p-3">

        <h2 class="fs-4 text-primary my-4">
            Statistics
        </h2>
        <div class="fs-5 mb-3"><strong>Average rating:</strong> {{ number_format($averageRating, 2) }}</div>

        <!-- grafico ratings -->
        <canvas id="ratingsChart" width="300" height="100" class="p-4"></canvas>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            
            const ratingsData = @json($ratingsData);

            console.log(ratingsData); 

            const ctx = document.getElementById('ratingsChart').getContext('2d');
            const ratingsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'],  
                    datasets: [{
                        label: 'Number of Ratings',
                        data: [
                            ratingsData['1_star'],   
                            ratingsData['2_stars'],  
                            ratingsData['3_stars'],  
                            ratingsData['4_stars'],  
                            ratingsData['5_stars']   
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    devicePixelRatio: 4,
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,  
                                callback: function(value) {
                                    if (Number.isInteger(value)) {
                                        return value;  
                                    }
                                }
                            }
                        }
                    }
                }
            });
        </script>

        <a href="{{ route('admin.ratings.index') }}" class="btn btn-primary mt-3">Back</a>

    </div>

@endsection

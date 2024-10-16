@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h1 class="text-primary my-4">
            Statistics
        </h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Rating</th>
                    <th>Content</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ratingsDetails as $rating)
                    <tr>
                        <td>{{ $rating->full_name }}</td>
                        <td>{{ $rating->rating_id }}</td>
                        <td>{{ $rating->content ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="#" class="btn btn-primary mt-3">Statistics</a>
    </div>
@endsection

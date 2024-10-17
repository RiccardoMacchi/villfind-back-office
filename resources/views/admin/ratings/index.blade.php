@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h1 class="text-primary my-4">
            Ratings
        </h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Rating</th>
                    <th>Content</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ratingsDetails as $rating)
                    <tr>
                        <td>{{ $rating->full_name }}</td>
                        <td>{{ $rating->rating_id }}</td>
                        <td>{{ $rating->content ?? '-' }}</td>
                        <td>
                            @include('admin.general.button_view', [
                                'link' => route('admin.ratings.show', $rating->id),
                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="route" class="btn btn-primary mt-3">Statistics</a>
    </div>
@endsection

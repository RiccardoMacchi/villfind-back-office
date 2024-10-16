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
        <table class="table">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Rating</th>
                        <th>Content</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ratingsDetails as $rating)
                        <tr>
                            <td>{{ $rating->full_name }}</td>
                            <td>{{ $rating->rating_id }}</td>
                            <td>{{ $rating->content ?? '-' }}</td>
                            <td><a class="btn btn-warning" href="{{ route('admin.ratings.show', $userRating->pivot->id) }}"><i
                            class="fa-solid fa-eye"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
       
            <a href="{{ route('admin.ratings.statistics', $rating->rating_id) }}" class="btn btn-primary">Statistics</a>
    </div>
@endsection

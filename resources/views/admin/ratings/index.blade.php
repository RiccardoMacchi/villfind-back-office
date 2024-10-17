@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h1 class="text-primary my-4">
            Ratings
        </h1>

        <table class="table">
            <thead>
                <tr>
                    <th class="text-primary">Full Name</th>
                    <th class="text-primary">Rating</th>
                    <th class="text-primary">Content</th>
                    <th class="text-primary text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ratingsDetails as $rating)
                    <tr>
                        {{-- @dd($rating) --}}
                        <td>{{ $rating->full_name }}</td>
                        <td>{{ $rating->rating_id }}</td>
                        <td>{{ $rating->content ?? '-' }}</td>
                        <td class="col-1 text-center">
                            <menu class="d-flex justify-content-center gap-1">
                                <li>
                                    @include('admin.general.button_view', [
                                        'link' => route('admin.ratings.show', $rating->id),
                                    ])
                                </li>
                            </menu>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('admin.ratings.statistics') }}" class="btn btn-primary mt-3">Statistics</a>
    </div>
@endsection

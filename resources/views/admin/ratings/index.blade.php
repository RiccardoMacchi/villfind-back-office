@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h1 class="text-primary my-4">
            Ratings
        </h1>


        <div class="card shadow-lg mb-3 overflow-hidden border-primary-subtle">
            <div class="card-header bg-primary-subtle border-primary-subtle">
                {{ $ratingsDetails->links() }}
            </div>

            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-primary col-3">Full Name</th>
                            <th class="text-primary text-center col-2">Rating</th>
                            <th class="text-primary col-6">Content</th>
                            <th class="text-primary text-center col-1">Action</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($ratingsDetails as $rating)
                            <tr>
                                <td class="col-3">{{ $rating->full_name }}</td>
                                <td class="col-2 text-center">{{ $rating->rating_id }}</td>
                                <td class="col-6 text-primary text-truncate">
                                    {{ $rating->content ?? '-' }}</td>
                                <td class="col-1 text-center">
                                    <menu class="d-flex justify-content-center gap-1">
                                        <li>
                                            @include('admin.general.button_view', [
                                                'link' => route(
                                                    'admin.ratings.show',
                                                    $rating->id),
                                            ])
                                        </li>
                                    </menu>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <a href="#" class="btn btn-primary mt-3">Statistics</a>
    </div>
@endsection

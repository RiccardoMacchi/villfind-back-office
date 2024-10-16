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

    <div class="container mt-5">
        <h1>rating</h1>
        <span>Media: {{ $averageRating }}</span>
        {{-- @foreach ($ratingsPerVillain as $villainRate)
            @foreach ($villainRate->ratings as $userRating)
                <h2>{{ $userRating->pivot }}</h2>
            @endforeach
        @endforeach --}}
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Content</th>
                    <th scope="col">Vote</th>
                    <th scope="col">Option</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ratingsPerVillain as $villainRate)
                    @foreach ($villainRate->ratings as $userRating)
                        <tr>
                            <td>
                                <h5>{{ $userRating->pivot->full_name }}</h5>
                            </td>
                            <td>{{ $userRating->pivot->content ?? 'No content' }}</td>
                            <td>{{ $userRating->pivot->rating_id }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('admin.ratings.show', $userRating->pivot->id) }}"><i
                                        class="fa-solid fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

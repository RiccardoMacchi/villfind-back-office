@extends('layouts.app')

@section('content')
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Sender</th>
                    <th scope="col">Content</th>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <th scope="row">{{ $message->name }}</th>
                        <td>{{ $message->content }}</td>
                        <td>{{ $message->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.messages.show', $message) }}"><i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

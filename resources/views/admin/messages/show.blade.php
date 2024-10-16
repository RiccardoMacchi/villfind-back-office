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

    <div>
        <h2>Dettaglio di: {{ $message->name }}</h2>
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
                <tr>
                    <th scope="row">{{ $message->name }}</th>
                    <td>{{ $message->content }}</td>
                    <td>{{ $message->created_at }}</td>
                    <td>
                        show
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

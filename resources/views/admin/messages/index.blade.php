@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h2 class="fs-4 text-primary my-4">
            Messages
        </h2>
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
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    {{ $messages->links() }}
                </div>
                <div class="card-body p-0">

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
                                    <th scope="row">{{ $message->full_name }}</th>
                                    <td>{{ $message->content }}</td>
                                    <td>{{ $message->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.messages.show', $message) }}"><i
                                                class="fa-solid fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    @endsection

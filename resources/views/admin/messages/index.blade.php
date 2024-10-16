@extends('layouts.app')

@section('content')
    <div class="container p-3">
        <h2 class="fs-4 text-primary my-4">
            Messages
        </h2>
        {{-- controllo errori --}}
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
                                <th scope="col" class="text-primary">Sender</th>
                                <th scope="col" class="w-50 text-primary">Content</th>
                                <th scope="col" class="text-primary">Sent on</th>
                                <th scope="col" class="text-center text-primary">Details</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($messages as $message)
                                <tr>
                                    <th scope="row">{{ $message->full_name }}</th>
                                    <td>{{ $message->content }}</td>
                                    <td>{{ \Carbon\Carbon::parse($message->created_at)->format('d/m/Y H:i') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.messages.show', $message) }}"><i class="fa-solid fa-eye text-primary"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection

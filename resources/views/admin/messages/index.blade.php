@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h1 class="text-primary my-4">
            Messages
        </h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-lg mb-3 overflow-hidden border-primary-subtle">
            <div class="card-header bg-primary-subtle border-primary-subtle">
                {{ $messages->links() }}
            </div>

            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="col-3 text-primary">Sender</th>
                            <th scope="col" class="col-6 text-primary">Content</th>
                            <th scope="col" class="col-2 text-primary text-center">Sent on</th>
                            <th scope="col" class="col-1 text-primary text-center">Options</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($messages as $message)
                            <tr class="message-row">
                                <th scope="row" class="fw-normal col-3">
                                    {{ $message->full_name }}
                                </th>

                                <td class="col-6 text-truncate">
                                    {{ $message->content }}
                                </td>

                                <td class="col-2 text-center">
                                    {{ \Carbon\Carbon::parse($message->created_at)->format('d/m/Y H:i') }}
                                </td>

                                <td class="col-1 text-center">
                                    <menu class="d-flex justify-content-center gap-1">
                                        <li>
                                            @include('admin.general.button_view', [
                                                'link' => route(
                                                    'admin.messages.show',
                                                    $message),
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
    </div>
@endsection

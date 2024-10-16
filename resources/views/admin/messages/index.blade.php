rendimi responsive questo codice senza cambiare niente altro
@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h1 class="text-primary my-4">
            Messages
        </h1>

        <div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <span><i class="fa-solid fa-inbox"></i> Message List</span>
                    <span class="pagination-info">
                        Showing {{ $messages->firstItem() }} to {{ $messages->lastItem() }} of {{ $messages->total() }} results
                    </span>
                    <div class="d-flex mt-2">
                        {{ $messages->links() }}
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="text-primary">Sender</th>
                                <th scope="col" class="w-50 text-primary">Content</th>
                                <th scope="col" class="text-primary">Sent on</th>
                                <th scope="col" class="text-center text-primary">Details</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($messages as $message)
                                <tr class="message-row">
                                    <th scope="row" class="fw-normal">{{ $message->full_name }}</th>
                                    <td>{{ $message->content }}</td>
                                    <td>{{ \Carbon\Carbon::parse($message->created_at)->format('d/m/Y H:i') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.messages.show', $message) }}" class="text-primary hover-effect">
                                            <i class="fa-solid fa-eye eye-icon"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .message-row:hover {
            background-color: #e9ecef;
            transition: background-color 0.3s ease;
        }

        
        .eye-icon {
            transition: transform 0.2s ease-in-out, color 0.2s ease;
        }

        .eye-icon:hover {
            transform: scale(1.5); 
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }
        .pagination-info {
            font-size: 0.9rem;
            color: white;
        }
        .small.text-muted{
            display: none;
        }
    </style>
@endsection
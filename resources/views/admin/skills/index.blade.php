@extends('layouts.app')

@section('content')
    {{-- controllo errori --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container mb-3">
        <h2 class="fs-4 text-primary my-4 text-center">
            Skills
        </h2>

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
                <span><i class="fa-solid fa-list"></i> Skills List</span>
                <div class="d-flex mt-2">
                    {{ $skills->links() }}
                </div>
            </div>

            <div class="card-body p-0">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-primary col-11">Name</th>
                            <th scope="col" class="text-primary text-center col-1">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($skills as $skill)
                            <tr class="skill-row">
                                <th scope="row" class="col-11">
                                    <form id="update-{{ $skill->id }}" action="{{ route('admin.skills.update', $skill) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input
                                            class="input-edit form-control @if ($errors->any() && old('id') == $skill->id) is-invalid @endif"
                                            type="text" name="name" value="{{ $skill->name }}">
                                        <input type="hidden" name="id" value="{{ $skill->id }}">
                                    </form>
                                </th>

                                <td class="text-center col-1">
                                    <menu class="d-flex justify-content-center gap-1">
                                        <li>
                                            <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </li>
                                    </menu>
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <form action="{{ route('admin.skills.store') }}" method="POST">
                                @csrf
                                <th scope="row" class="col-11 py-0">
                                    <div class="position-relative py-3">
                                        <input type="text" class="form-control @if ($errors->any() && old('id') == count($skills) + 1 && $skills->contains('name', old('name'))) is-invalid @endif"
                                            id="input-name" name="name" aria-errormessage="input-name-error"
                                            value="@if ($errors->any() && old('id') == count($skills) + 1 && $skills->contains('name', old('name'))) {{ old('name') }} @endif"
                                            minlength="3" maxlength="55" placeholder="Name..." required>
                                        <input type="hidden" name="id" value="0">
                                        @if ($errors->any() && old('name'))
                                            @error('name')
                                                <small id="input-name-error" class="invalid-feedback position-absolute bottom-0 start-0">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        @endif
                                    </div>
                                </th>

                                <td class="text-center col-1">
                                    <menu class="d-flex justify-content-center gap-1">
                                        <li>
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="fa-solid fa-paper-plane"></i>
                                            </button>
                                        </li>
                                    </menu>
                                </td>
                            </form>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        /* Effetto hover per le righe della tabella */
        .skill-row:hover {
            background-color: #f8f9fa;
            transition: background-color 0.3s ease;
        }

        /* Ombra della card */
        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        /* Hover effetto per il pulsante di cancellazione */
        .btn-danger:hover {
            background-color: #dc3545;
            opacity: 0.9;
        }

        /* Effetti di animazione per i pulsanti */
        .btn-primary, .btn-danger {
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-primary:hover, .btn-danger:hover {
            transform: scale(1.1);
        }

        .small.text-muted{
            display: none;
        }
    </style>

    <script>
        function submitUpdate(id) {
            let form = document.getElementById(update-${id})
            form.submit();
        }
    </script>
@endsection
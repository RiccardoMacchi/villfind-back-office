@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h2 class="fs-4 text-primary my-4">
            Skills
        </h2>

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
            {{-- <div class="card-header">
                {{ $skills->links() }}
            </div> --}}

            <div class="card-body p-0">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="text-primary col-9">Name</th>

                            <th scope="col" class="text-primary text-center col-3">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($skills as $skill)
                            <tr>
                                <th scope="row" class="col-9">
                                    <form id="update-{{ $skill->id }}"
                                        action="{{ route('admin.skills.update', $skill) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input
                                            class="input-edit form-control @if ($errors->any() && old('id') == $skill->id) is-invalid @endif"
                                            type="text" name="name" value="{{ $skill->name }}">
                                        {{-- Input hidden per salvare id in old e fare verifica --}}
                                        <input type="hidden" name="id" value="{{ $skill->id }}">
                                    </form>
                                </th>

                                <td class="text-center col-3">
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

                                <th scope="row" class="col-9 py-0">
                                    <div class="position-relative py-3">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="input-name" name="name" aria-errormessage="input-name-error"
                                            value="{!! old('name', '') !!}" minlength="3" maxlength="55"
                                            placeholder="Name..." required>

                                        @error('name')
                                            <small id="input-name-error"
                                                class="invalid-feedback position-absolute bottom-0 start-0">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </th>

                                <td class="text-center col-3">
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
@endsection

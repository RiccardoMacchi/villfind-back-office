@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <h1 class="text-primary my-4">
            Skills
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
                {{ $skills->links() }}
            </div>

            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-primary col-11">Name</th>
                            <th scope="col" class="text-primary text-center col-1">Option</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($skills as $skill)
                            <tr class="skill-row">
                                <th scope="row" class="col-11">
                                    <form id="update-{{ $skill->id }}"
                                          action="{{ route('admin.skills.update', $skill) }}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input class="input-edit form-control bg-transparent border-top-0 border-end-0 border-start-0 @if ($errors->any() && old('id') == $skill->id) is-invalid @endif"
                                               type="text" name="name"
                                               value="{{ $skill->name }}">
                                        <input type="hidden" name="id"
                                               value="{{ $skill->id }}">
                                    </form>
                                </th>

                                <td class="text-center col-1">
                                    <menu class="d-flex justify-content-center gap-1">
                                        <li>
                                            @include('admin.general.button_delete', [
                                                'link' => route(
                                                    'admin.skills.destroy',
                                                    $skill),
                                            ])
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
                                        <input type="text"
                                               class="form-control bg-transparent border-top-0 border-end-0 border-start-0 @if ($errors->any() && old('id') == count($skills) + 1 && $skills->contains('name', old('name'))) is-invalid @endif"
                                               id="input-name" name="name"
                                               aria-errormessage="input-name-error"
                                               value="@if ($errors->any() && old('id') == count($skills) + 1 && $skills->contains('name', old('name'))) {{ old('name') }} @endif"
                                               minlength="3" maxlength="55" placeholder="Name..."
                                               required>
                                        <input type="hidden" name="id" value="0">
                                        @if ($errors->any() && old('name'))
                                            @error('name')
                                                <small id="input-name-error"
                                                       class="invalid-feedback position-absolute bottom-0 start-0">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        @endif
                                    </div>
                                </th>

                                <td class="col-1">
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

    <script>
        function submitUpdate(id) {
            let form = document.getElementById(update - $ {
                id
            })
            form.submit();
        }
    </script>
@endsection

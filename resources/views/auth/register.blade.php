@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form id="registration-form" method="POST" action="{{ route('process') }}">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name" class="col-lg-4 col-form-label">
                                    {{ __('Name *') }}
                                </label>

                                <div class="col-lg-8 position-relative">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name" pattern=".{3,}"
                                           title="The name must be at least 3 characters long"
                                           value="{{ old('name') }}" required autocomplete="name"
                                           autofocus>

                                    @error('name')
                                        <small class="invalid-feedback position-absolute start-0 px-3"
                                               style="bottom: -1.25em; font-size: .75em;" role="alert">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="email" class="col-lg-4 col-form-label">
                                    {{ __('E-Mail Address *') }}
                                </label>

                                <div class="col-lg-8 position-relative">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email" minlength="3" maxlength="255"
                                           pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                           title="Please enter a valid lowercase email address."
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <small class="invalid-feedback position-absolute start-0 px-3"
                                               style="bottom: -1.25em; font-size: .75em;" role="alert">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password" class="col-lg-4 col-form-label">
                                    {{ __('Password *') }}
                                </label>

                                <div class="col-lg-8 position-relative">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password" minlength="8" maxlength="32"
                                           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%&*!?])[A-Za-z\d@#$%&*!?]{8,32}$"
                                           title="Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, one number, and one special character (@, #, $, %, &, *, !, ?)"
                                           autocomplete="new-password" required>

                                    @error('password')
                                        <small class="invalid-feedback position-absolute start-0 px-3"
                                               style="bottom: -1.25em; font-size: .75em;" role="alert">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password-confirm" class="col-lg-4 col-form-label">
                                    {{ __('Confirm Password *') }}
                                </label>

                                <div class="col-lg-8 position-relative">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" autocomplete="new-password"
                                           required>
                                </div>
                            </div>

                            {{-- Universe --}}
                            <div class="mb-4 row">
                                <label for="universe_id" class="col-lg-4 col-form-label">
                                    Universe *
                                </label>

                                <div class="col-lg-8 position-relative">
                                    <div class="input-group">
                                        <select name="universe_id" id="universe_id"
                                                class="form-select select-height @error('universe_id') is-invalid @enderror"
                                                required>

                                            <option value="" disabled
                                                    @selected(!old('universe_id', null))>
                                                Select a universe of origin
                                            </option>

                                            @foreach ($universes as $universe)
                                                <option value="{!! $universe->id !!}"
                                                        @selected($universe->id === old('universe_id', null))>
                                                    {{ $universe->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @error('universe_id')
                                        <small class="invalid-feedback position-absolute start-0 px-3"
                                               style="bottom: -1.25em; font-size: .75em;" role="alert">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Skills --}}
                            <div class="row mb-4">
                                <label for="skills" class="col-lg-4 col-form-label">
                                    Skills *
                                </label>

                                <div class="col-lg-8 position-relative">
                                    <div class="dropdown">
                                        <button type="button" id="skills"
                                                class="form-select text-start @error('skills') is-invalid @enderror"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            None
                                        </button>

                                        <ul class="dropdown-menu w-100 select-height"
                                            aria-labelledby="skills">
                                            @foreach ($skills as $skill)
                                                <li>
                                                    <label class="dropdown-item"
                                                           for="skill-{!! $skill->id !!}"
                                                           onclick="event.stopPropagation()">
                                                        <input type="checkbox" name="skills[]"
                                                               value="{!! $skill->id !!}"
                                                               id="skill-{!! $skill->id !!}"
                                                               data-name="{!! $skill->name !!}"
                                                               class="form-check-input"
                                                               @checked(in_array($skill->id, old('skills', [])))
                                                               onclick="event.stopPropagation()">

                                                        {{ $skill->name }}
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    @error('skills')
                                        <small class="invalid-feedback position-absolute start-0 px-3"
                                               style="bottom: -1.25em; font-size: .75em;" role="alert">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="module">
        checkboxListSelector('skills');
    </script>

    <script>
        const form = document.getElementById('registration-form');

        const passwordInputField = document.getElementById('password');
        const passwordConfirmInputField = document.getElementById('password-confirm');

        passwordInputField.addEventListener('input', () => {
            passwordConfirmInputField.setCustomValidity('');
        });

        passwordConfirmInputField.addEventListener('input', () => {
            passwordConfirmInputField.setCustomValidity('');
        });

        form.addEventListener('submit', (event) => {
            if (passwordInputField.value !== passwordConfirmInputField.value) {
                passwordConfirmInputField.setCustomValidity('Passwords do not match.');
                passwordConfirmInputField.reportValidity();
                event.preventDefault();
            } else {
                passwordConfirmInputField.setCustomValidity('');
            }
        });
    </script>
@endsection

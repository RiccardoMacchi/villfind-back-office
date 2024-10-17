@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('process') }}">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            {{-- Univers --}}
                            <div class="row mb-3">
                                <label for="universe_id" class="col-sm-2 col-form-label">Universe</label>

                                <div class="col-sm-10 pb-3">
                                    <div class="input-group">
                                        <select name="universe_id" id="universe_id" aria-errormessage="universe_id-error"
                                            class="form-select @error('universe_id') is-invalid @enderror" required>

                                            <option value="" disabled>
                                                Select a universe of origin
                                            </option>

                                            @foreach ($universes as $universe)
                                                <option value="{!! $universe->id !!}" @selected($universe->id === old('universe_id', null))>
                                                    {{ $universe->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @error('universe_id')
                                        <small id="universe_id-error"
                                            class="invalid-feedback position-absolute bottom-0 start-0">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            {{-- Skills --}}
                            <div class="row mb-3">
                                <label for="skills" class="col-sm-2 col-form-label">skills</label>

                                <div class="col-sm-10 pb-3">
                                    <div class="dropdown">
                                        <button type="button" id="skills"
                                            class="form-select text-start @error('skills') is-invalid @enderror"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            None
                                        </button>

                                        <ul class="dropdown-menu w-100" aria-labelledby="skills">
                                            @foreach ($skills as $skill)
                                                <li>
                                                    <label class="dropdown-item" for="skill-{!! $skill->id !!}"
                                                        onclick="event.stopPropagation()">
                                                        <input type="checkbox" name="skills[]"
                                                            value="{!! $skill->id !!}"
                                                            id="skill-{!! $skill->id !!}"
                                                            data-name="{!! $skill->name !!}" class="form-check-input"
                                                            @checked(in_array($skill->id, old('skills', []))) onclick="event.stopPropagation()">

                                                        {{ $skill->name }}
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    @error('skills')
                                        <small id="skills-error" class="invalid-feedback position-absolute bottom-0 start-0">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const dropdownButton = document.getElementById('skills');
        const dropdownMenu = document.querySelectorAll('.dropdown-menu input');

        let selectedItems = [];

        for (const checkbox of dropdownMenu) {
            updateSelectedCheckbox(checkbox);
            checkbox.addEventListener('change', handleCheckbox);
        }

        function handleCheckbox(event) {
            const checkbox = event.target;
            updateSelectedCheckbox(checkbox);
        }

        function updateSelectedCheckbox(checkbox) {
            const newItem = {
                name: checkbox.dataset.name,
                value: checkbox.value,
            };

            if (checkbox.checked) {
                selectedItems.push(newItem);
            } else {
                selectedItems = selectedItems.filter((item) => item.value !== newItem.value);
            }

            const selectedItemsNames = selectedItems.map(item => item.name);

            dropdownButton.innerText = selectedItemsNames.length > 0 ? selectedItemsNames.join(
                ' \u{02219} ') : 'None';
        }
    </script>
@endsection

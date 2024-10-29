@php
    $is_update_form = isset($villain) ? true : false;
@endphp

<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="p-4 border rounded bg-light"
    onchange="updateRequirements();">
    @csrf

    @if ($is_update_form)
        @method('PUT')
    @endif

    <div class="row mb-4">
        <label for="name" class="col-lg-3 col-form-label">
            Name *
        </label>

        <div class="col-12  col-lg-9 position-relative">
            <div class="input-group">
                <input type="text" name="name" id="name" aria-errormessage="name-error"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $is_update_form ? $villain->name : '') }}" minlength="3" maxlength="250"
                    placeholder="Villain name" required>
            </div>

            @error('name')
                <small id="name-error" class="invalid-feedback position-absolute start-0 px-3"
                    style="bottom: -1.25em; font-size: .75em;" role="alert">
                    {{ $message }}
                </small>
            @enderror
        </div>
    </div>

    <div class="row mb-4">
        <label for="image" class="col-lg-3 col-form-label">
            Image
        </label>

        <div class="col-12  col-lg-9 position-relative">
            <div class="input-group">
                <input type="file" name="image" id="image" aria-errormessage="image-error"
                    class="form-control @error('image') is-invalid @enderror">

                @isset($villain->image)
                    <div class="input-group-text">
                        <input class="form-check-input mt-0 me-2" type="checkbox" name="image_delete" id="delete-image">
                        <label for="delete-image"><i class="fa-regular fa-trash-can"></i></label>
                    </div>
                @endisset
            </div>

            @error('image')
                <small id="image-error" class="invalid-feedback position-absolute start-0 px-3"
                    style="bottom: -1.25em; font-size: .75em;" role="alert">
                    {{ $message }}
                </small>
            @enderror
        </div>
    </div>

    <div class="row mb-4">
        <label for="phone" class="col-lg-3 col-form-label">
            Phone
        </label>

        <div class="col-12  col-lg-9 position-relative">
            <div class="input-group">
                <select name="country_code" id="country_code"
                    class="form-select @error('country_code') is-invalid @enderror"
                    style="flex-shrink: 4; flex-grow: 1; max-width: 5.5em">
                    <option value="" disabled @selected(!old('country_code', $is_update_form && $villain->phone ? $villain->phone : null))>
                        +0
                    </option>

                    @for ($i = 1; $i <= 380; $i++)
                        <option value="+{{ $i }}" @selected('+' . $i === old('country_code', $is_update_form && $villain->phone ? explode(' ', $villain->phone)[0] : null))>
                            +{{ $i }}
                        </option>
                    @endfor
                </select>

                <input type="text" name="phone" id="phone" aria-errormessage="phone-error"
                    class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone', $is_update_form && $villain->phone ? explode(' ', $villain->phone)[1] : '') }}"
                    placeholder="Phone number" pattern="^(?:[^\d]*[\d][^\d]*){8,15}$" minlength="8" maxlength="25"
                    title="Enter a valid phone number (8 to 15 digits)." style="flex-shrink: 1; flex-grow: 4">
            </div>

            @error('phone')
                <small id="phone-error" class="invalid-feedback position-absolute start-0 px-3"
                    style="bottom: -1.25em; font-size: .75em;" role="alert">
                    {{ $message }}
                </small>
            @enderror
        </div>
    </div>

    <div class="row mb-4">
        <label for="universe_id" class="col-lg-3 col-form-label">
            Universe *
        </label>

        <div class="col-12  col-lg-9 position-relative">
            <div class="input-group">
                <select name="universe_id" id="universe_id" aria-errormessage="universe_id-error"
                    class="form-select select-height @error('universe_id') is-invalid @enderror" required>

                    <option value="" disabled @selected(!old('universe_id', $is_update_form ? $villain->universe_id : null))>
                        Select a universe of origin
                    </option>

                    @foreach ($universes as $universe)
                        <option value="{!! $universe->id !!}" @selected($universe->id === old('universe_id', $is_update_form ? $villain->universe_id : null))>
                            {{ $universe->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            @error('universe_id')
                <small id="universe_id-error" class="invalid-feedback position-absolute bottom-0 start-0" role="alert">
                    {{ $message }}
                </small>
            @enderror
        </div>
    </div>

    <div class="row mb-4">
        <label for="skills" class="col-lg-3 col-form-label">
            Skills
        </label>

        <div class="col-12 col-lg-9 position-relative">
            <div class="dropdown">
                <button type="button" id="skills"
                    class="form-select text-start @error('skills') is-invalid @enderror" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    None
                </button>

                <ul class="dropdown-menu w-100 select-height" aria-labelledby="skills">
                    @foreach ($skills as $skill)
                        <li>
                            <label class="dropdown-item" for="skill-{!! $skill->id !!}"
                                onclick="event.stopPropagation()">
                                <input type="checkbox" name="skills[]" value="{!! $skill->id !!}"
                                    id="skill-{!! $skill->id !!}" data-name="{!! $skill->name !!}"
                                    class="form-check-input" onclick="event.stopPropagation()"
                                    @checked(in_array($skill->id, old('skills', $is_update_form ? $villain->skills->pluck('id')->toArray() : [])))>

                                {{ $skill->name }}
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>

            @error('skills')
                <small id="skills-error" class="invalid-feedback position-absolute start-0 px-3"
                    style="bottom: -1.25em; font-size: .75em;" role="alert">
                    {{ $message }}
                </small>
            @enderror
        </div>
    </div>

    <div class="row mb-4">
        <label for="services" class="col-lg-3 col-form-label">
            Services
        </label>

        <div class="col-12 col-lg-9 position-relative">
            <div class="dropdown">
                <button type="button" id="services"
                    class="form-select text-start @error('services') is-invalid @enderror" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    None
                </button>

                <ul class="dropdown-menu w-100 select-height" aria-labelledby="services">
                    @foreach ($services as $service)
                        <li>
                            <label class="dropdown-item" for="service-{!! $service->id !!}"
                                onclick="event.stopPropagation()">
                                <input type="checkbox" name="services[]" value="{!! $service->id !!}"
                                    id="service-{!! $service->id !!}" data-name="{!! $service->name !!}"
                                    class="form-check-input" onclick="event.stopPropagation()"
                                    @checked(in_array($service->id, old('services', $is_update_form ? $villain->services->pluck('id')->toArray() : [])))>

                                {{ $service->name }}
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>

            @error('services')
                <small id="services-error" class="invalid-feedback position-absolute start-0 px-3"
                    style="bottom: -1.25em; font-size: .75em;" role="alert">
                    {{ $message }}
                </small>
            @enderror
        </div>
    </div>

    <div class="row mb-5">
        <label for="cv" class="col-lg-3 col-form-label">
            Curriculum Vitae
        </label>

        <div class="col-12 col-lg-9 position-relative">
            <div class="input-group">
                <input type="file" name="cv" id="cv" aria-errormessage="cv-error"
                    class="form-control @error('cv') is-invalid @enderror">

                @isset($villain->cv)
                    <div class="input-group-text">
                        <input class="form-check-input mt-0 me-2" type="checkbox" name="cv_delete" id="delete-cv">
                        <label for="delete-cv"><i class="fa-regular fa-trash-can"></i></label>
                    </div>
                @endisset
            </div>

            @error('cv')
                <small id="cv-error" class="invalid-feedback position-absolute start-0 px-3"
                    style="bottom: -1.25em; font-size: .75em;" role="alert">
                    {{ $message }}
                </small>
            @enderror
        </div>
    </div>

    <div class="d-grid gap-2 d-lg-block">
        <button type="submit" class="btn btn-primary">
            {{ $is_update_form ? 'Edit' : 'Create' }}
        </button>
    </div>
</form>

<script type="module">
    checkboxListSelector('services');
    checkboxListSelector('skills');
</script>

<script>
    let phoneInputField = document.getElementById('phone');

    phoneInputField.addEventListener("input", () => updateRequirements());
    phoneInputField.addEventListener("change", () => updateRequirements());

    updateRequirements();

    function updateRequirements() {
        const countryCodeInputField = document.getElementById('country_code');

        if (phoneInputField.value !== '') {
            countryCodeInputField.required = true;
        } else {
            countryCodeInputField.required = false;
        }
    }
</script>

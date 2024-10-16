@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">{{ $villain->name }}, edit your profile</h1>

        <form action="{{ route('admin.villains.update', $villain) }}" method="POST"
              enctype="multipart/form-data" class="p-4 border rounded bg-light">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name</label>

                <div class="col-sm-10 pb-3">
                    <div class="input-group">
                        <input type="text" name="name" id="name"
                               aria-errormessage="name-error"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $villain->name) }}" placeholder="Villain name"
                               required>
                    </div>

                    @error('name')
                        <small id="name-error" class="invalid-feedback position-absolute bottom-0 start-0">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="image" class="col-sm-2 col-form-label">Image</label>

                <div class="col-sm-10 pb-3">
                    <div class="input-group">
                        <input type="file" name="image" id="image"
                               aria-errormessage="image-error"
                               class="form-control @error('image') is-invalid @enderror">

                        @isset($villain->image)
                            <div class="input-group-text">
                                <input class="form-check-input mt-0 me-2" type="checkbox"
                                       name="image_delete" id="delete-image">
                                <label for="delete-image">Delete</label>
                            </div>
                        @endisset
                    </div>

                    @error('image')
                        <small id="image-error" class="invalid-feedback position-absolute bottom-0 start-0">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="email_contact" class="col-sm-2 col-form-label">Contact Email</label>
                <div class="col-sm-10 pb-3">
                    <div class="input-group">
                        <input type="email" name="email_contact" id="email_contact"
                               aria-errormessage="email_contact-error"
                               class="form-control @error('email_contact') is-invalid @enderror"
                               value="{{ old('email_contact', $villain->email_contact) }}"
                               placeholder="Email address" required>
                    </div>

                    @error('email_contact')
                        <small id="email_contact-error"
                               class="invalid-feedback position-absolute bottom-0 start-0">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="phone" class="col-sm-2 col-form-label">Contact Phone</label>

                <div class="col-sm-10 pb-3">
                    <div class="input-group">
                        <input type="text" name="phone" id="phone"
                               aria-errormessage="phone-error"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone', $villain->phone) }}" placeholder="Phone number">
                    </div>

                    @error('phone')
                        <small id="phone-error" class="invalid-feedback position-absolute bottom-0 start-0">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="universe_id" class="col-sm-2 col-form-label">Universe</label>

                <div class="col-sm-10 pb-3">
                    <div class="input-group">
                        <select name="universe_id" id="universe_id"
                                aria-errormessage="universe_id-error"
                                class="form-select @error('universe_id') is-invalid @enderror" required>

                            <option value="" disabled>
                                Select a universe of origin
                            </option>

                            @foreach ($universes as $universe)
                                <option value="{!! $universe->id !!}" @selected($universe->id == old('universe_id', $villain->universe_id))>
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

            <div class="row mb-3">
                <label for="services" class="col-sm-2 col-form-label">Services</label>

                <div class="col-sm-10 pb-3">
                    <div class="dropdown">
                        <button type="button" id="services"
                                class="form-select text-start @error('services') is-invalid @enderror"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            None
                        </button>

                        <ul class="dropdown-menu w-100" aria-labelledby="services">
                            @foreach ($services as $service)
                                <li>
                                    <label class="dropdown-item" for="service-{!! $service->id !!}"
                                           onclick="event.stopPropagation()">
                                        <input type="checkbox" name="services[]"
                                               value="{!! $service->id !!}"
                                               id="service-{!! $service->id !!}"
                                               data-name="{!! $service->name !!}"
                                               class="form-check-input" @checked(in_array($service->id, old('services', $villain->services->pluck('id')->toArray())))
                                               onclick="event.stopPropagation()">

                                        {{ $service->name }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    @error('services')
                        <small id="services-error"
                               class="invalid-feedback position-absolute bottom-0 start-0">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>

            <div class="d-grid gap-2 d-md-block">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
    </div>

    <script>
        const dropdownButton = document.getElementById('services');
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

@php
    $is_update_form = isset($item_to_update) ? true : false;
@endphp


<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="row g-2">
    @csrf

    @if ($is_update_form)
        @method('PUT')
    @endif

    <div class="col-12 position-relative pb-4">
        <label for="input-title" class="form-label text-primary">
            Title
        </label>

        <input type="text" class="form-control @error('title') is-invalid @enderror" id="input-title" name="title"
            aria-errormessage="input-title-error" value="{!! old('title', $is_update_form ? $item_to_update->title : '') !!}" minlength="3" maxlength="150"
            placeholder="Title..." required>

        @error('title')
            <small id="input-title-error" class="invalid-feedback position-absolute bottom-0 start-0">
                {{ $message }}
            </small>
        @enderror
    </div>

    <div class="col-12 position-relative pb-4">
        <label for="input-body" class="form-label text-primary">
            Body
        </label>

        <textarea type="text" class="form-control @error('body') is-invalid @enderror" id="input-body" name="body"
            aria-errormessage="input-body-error" rows="6" minlength="3" maxlength="65535" placeholder="Body..." required>{!! old('body', $is_update_form ? $item_to_update->body : '') !!}</textarea>

        @error('body')
            <small id="input-body-error" class="invalid-feedback position-absolute bottom-0 start-0">
                {{ $message }}
            </small>
        @enderror
    </div>

    <div class="col-12 position-relative pb-4">
        <label for="input-type" class="form-label text-primary">
            Type
        </label>

        <select class="form-control @error('post_type_id') is-invalid @enderror" id="input-type" name="post_type_id"
            aria-errormessage="input-type-error">
            <option value="" @selected(old('post_type_id', $is_update_form ? $item_to_update->post_type_id : null) == null)>
                None
            </option>

            @foreach ($types as $type)
                <option value="{!! $type->id !!}" @selected(old('post_type_id', $is_update_form ? $item_to_update->post_type_id : null) == $type->id)>
                    {!! $type->name !!}
                </option>
            @endforeach
        </select>

        @error('post_type_id')
            <small id="input-type-error" class="invalid-feedback position-absolute bottom-0 start-0">
                {{ $message }}
            </small>
        @enderror
    </div>

    <div class="col-12 position-relative pb-4">
        <label for="input-tags" class="form-label text-primary">
            Tags
        </label>

        <div class="dropdown">
            <button class="form-control text-start @error('tags') is-invalid @enderror" type="button" id="input-tags"
                data-bs-toggle="dropdown" aria-expanded="false">
                None
            </button>

            <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="input-tags">
                @foreach ($tags as $tag)
                    <li>
                        <label class="dropdown-item" for="tag-{!! $tag->slug !!}">
                            <input type="checkbox" name="tags[]" value="{!! $tag->id !!}"
                                id="tag-{!! $tag->slug !!}" data-name="{!! $tag->name !!}"
                                @checked(in_array($tag->id, old('tags', $is_update_form ? $item_to_update->tags->pluck('id')->toArray() : [])))>
                            {{ $tag->name }}
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>

        @error('tags')
            <small id="input-type-error" class="invalid-feedback position-absolute bottom-0 start-0">
                {{ $message }}
            </small>
        @enderror
    </div>

    @if ($is_update_form)
        <div class="col-12 position-relative pb-4">
            <label for="input-archived-status" class="form-label text-primary">
                Status
            </label>

            <select class="form-control @error('is_archived') is-invalid @enderror" id="input-archived-status"
                name="is_archived" aria-errormessage="input-archived-status-error" required>
                <option value="0" @selected(!old('is_archived', $is_update_form ? boolval($item_to_update->is_archived) : false))>Not archived</option>

                <option value="1" @selected(old('is_archived', $is_update_form ? boolval($item_to_update->is_archived) : false))>Archived</option>
            </select>

            @error('is_archived')
                <small id="input-archived-status-error" class="invalid-feedback position-absolute bottom-0 start-0">
                    {{ $message }}
                </small>
            @enderror
        </div>
    @endif

    <div class="col-12 position-relative pb-4">
        <label for="input-image" class="form-label text-primary">
            Image
        </label>

        <div class="input-group">
            <input type="file" class="form-control @error('img_path') is-invalid @enderror" id="input-image"
                name="img_path" aria-errormessage="input-image-error">

            @if ($is_update_form)
                <div class="input-group-text">
                    @if ($item_to_update->img_path)
                        <input class="form-check-input mt-0 me-2" type="checkbox" name="img_delete" id="delete-image">
                        <label for="delete-image">Delete current image</label>
                    @else
                        No current image
                    @endif
                </div>
            @endif
        </div>

        @error('img_path')
            <small id="input-image-error" class="invalid-feedback position-absolute bottom-0 start-0">
                {{ $message }}
            </small>
        @enderror
    </div>

    <div class="col-12 text-center">
        <button class="btn btn-primary" type="submit"><i class="fa-solid fa-paper-plane"></i></button>
    </div>

    <script>
        const dropdownButton = document.getElementById('input-tags');
        const dropdownMenu = document.querySelectorAll('.dropdown-menu input');

        let selectedItems = [];

        for (const checkbox of dropdownMenu) {
            updateSelectedCheckbox(checkbox);
            checkbox.addEventListener('change', handleCB);
        }
        console.log(selectedItems);

        function handleCB(event) {
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

            dropdownButton.innerText = selectedItemsNames.length > 0 ? selectedItemsNames.join(' \u{02219} ') : 'None';
        }
    </script>
</form>

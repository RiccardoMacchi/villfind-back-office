<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:150',
            'body' => 'required|min:3|max:65535',
            'is_archived' => 'required|boolean',
            'post_type_id' => 'nullable|exists:post_types,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'img_path' => 'nullable|image',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if (!isset($this->is_archived)) {
            $this->merge([
                'is_archived' => false,
            ]);
        }
    }
}

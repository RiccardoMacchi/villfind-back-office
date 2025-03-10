<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VillainRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:250',
            'image' => 'nullable|image|max:4096',
            'cv' => 'nullable|file|mimes:pdf|max:2048',
            'phone' => 'nullable|string|min:8|max:25|regex:/^(?=(?:[^\d]*\d){8,15}[^\d]*$)[\d().,\s-]+$/',
            'country_code' => 'required_with:phone|string|min:2|max:4|regex:/^\+\d{1,3}$/',
            'universe_id' => 'required|exists:universes,id',
            'skills' => 'required|array',
            'skills.*' => 'exists:skills,id',
            'services' => 'nullable|array',
            'service.*' => 'exists:services,id',
        ];
    }
}

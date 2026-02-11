<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:255|unique:locations,name',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Location name is required.',
            'name.string' => 'Location name must be a string.',
            'name.min' => 'Location name must be at least 2 characters.',
            'name.max' => 'Location name cannot exceed 255 characters.',
            'name.unique' => 'This location name already exists.',
        ];
    }
}

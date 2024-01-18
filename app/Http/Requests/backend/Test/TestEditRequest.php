<?php

namespace App\Http\Requests\backend\Test;

use Illuminate\Foundation\Http\FormRequest;

class TestEditRequest extends FormRequest
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
            'name' => 'required|max:50|min:3',
            'type' => 'required|max:50|min:3',
            'overview' => 'required|max:255|min:3',
            'cbc_test' => 'required',
            'recommended_for' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Test name is required",
        ];

    }
}
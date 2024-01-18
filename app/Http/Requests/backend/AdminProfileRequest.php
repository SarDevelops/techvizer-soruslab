<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class AdminProfileRequest extends FormRequest
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
            'first_name' => 'required|alpha|max:50|min:3|regex:/^[a-zA-Z]+$/',
            'last_name' => 'required|alpha|max:50|min:3|regex:/^[a-zA-Z]+$/',
            'profile' => 'nullable|mimes:jpeg,jpg,png|max:10000',
        ];
    }

    public function messages()
    {
        return [
            'profile.max' => 'The :attribute must not be greater than 10MB.',
        ];
    }
}

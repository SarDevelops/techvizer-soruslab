<?php

namespace App\Http\Requests\backend\HealthConcern;

use Illuminate\Foundation\Http\FormRequest;

class HealthConcernAddRequest extends FormRequest
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
            'image' => 'nullable|mimes:jpeg,jpg,png',
        ];
    }
}

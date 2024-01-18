<?php

namespace App\Http\Requests\backend\User;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'profile' => 'nullable|max:5000|mimes:jpg,jpeg,png',
            'first_name' => 'required|min:2|max:20|regex:/^[A-Za-z ]+$/',
            'last_name' => 'nullable|min:2|max:20|regex:/^[A-Za-z ]+$/',
            'email' => 'required|email|max:191|unique:users,email,'.$this->user,
            'role' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'Password must contains one uppercase, lowercase, number and special character.',
			'first_name.max' => 'Please enter only 20 characters',
			'last_name.max' => 'Please enter only 20 characters',
			'first_name.regex' => 'allow only characters',
			'last_name.regex' => 'allow only characters',
        ];

    }
}

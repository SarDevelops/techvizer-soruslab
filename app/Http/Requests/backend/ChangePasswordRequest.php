<?php

namespace App\Http\Requests\backend;

use App\Rules\ValidatePassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => ['required', new ValidatePassword(Auth::guard('admin')->user())],
            'new_password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%&])(\S+){8,100}$/u',
            'password_confirmation' => 'required|same:new_password',
        ];
    }

    public function messages()
    {
        return [
            'new_password.regex' => 'The :attribute must contain one uppercase, lowercase, number and special character from @#$%& and without whitespaces',
            'new_password.required' => 'The new password field is required.',
            'password_confirmation.required' => 'The confirm new password field is required.',
            'password_confirmation.same' => 'The confirm new password and new password must match.',
        ];
    }
}

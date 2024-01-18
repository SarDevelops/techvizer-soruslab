<?php

namespace App\Http\Requests\backend\RolePermission;

use Illuminate\Foundation\Http\FormRequest;

class RolePermissionRequest extends FormRequest
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
    public function rules()
    {
        return [
            'role_name' => 'required|min:2|max:50|regex:/^[A-Za-z ]+$/',  //Rule::notIn(['Super Admin'])
            'permissions' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'role_name.required' => "Role name is required",
            'role_name.not_in' => 'Role name "Super Admin" is restricted.',
			'role_name.regex' => 'allow only characters',
        ];

    }
}

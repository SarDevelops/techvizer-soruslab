<?php

namespace App\Http\Requests\backend\Package;

use Illuminate\Foundation\Http\FormRequest;

class PackageEditRequest extends FormRequest
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
            'image' => 'nullable|mimes:jpeg,jpg,png|dimensions:min_width=377,min_height=178',
            'type' => 'required|max:50|min:3',
            'overview' => 'required|max:255|min:3',
            'cbc_test' => 'required',
            'includes_pack' => 'nullable',
            'category' => 'required',
            'recommended_for' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Package name is required",
            'image.dimensions'=>'please select image width 377px  and height 178px'
        ];

    }
}

<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class BackendSettingsRequest extends FormRequest
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
            'site_email' => ['required', 'string', 'regex:/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/'],
            'site_name' => ['required', 'string', 'min:3'],
            'site_contact' => ['required', 'string', 'min:3'],
            'site_address' => ['required', 'string', 'min:3'],
            'admin_name' => ['required', 'string', 'min:3'],
            'admin_email' => ['required', 'string', 'regex:/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/'],
            'admin_contact' => ['required', 'string', 'min:3'],
            'smtp_host' => ['required', 'string', 'min:3'],
            'smtp_port' => ['required', 'numeric'],
            'smtp_encryption' => ['required', 'string', 'min:3'],
            'smtp_user' => ['required', 'string', 'regex:/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/'],
            'smtp_password' => ['required', 'string', 'min:3'],
            'from_name' => ['required', 'string', 'min:3'],
            'reply_to_email' => ['required', 'string', 'min:3'],
            'email_signature' => ['required', 'string', 'min:3'],
            'email_header' => ['required', 'string', 'min:3'],
            'email_footer' => ['required', 'string', 'min:3'],
            'facebook_url' => ['required', 'string', 'min:3', 'regex:/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/'],
            'instagram_url' => ['required', 'string', 'min:3', 'regex:/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/'],
            'twitter_url' => ['required', 'string', 'min:3', 'regex:/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/'],
            'about_us' => ['required', 'string', 'min:3'],
            'blog' => ['required', 'string', 'min:3'],
            'privacy_policy' => ['required', 'string', 'min:3'],
            'tearm_condition' => ['required', 'string', 'min:3'],
            'aws_key' => ['required', 'string', 'min:3'],
            'aws_secret' => ['required', 'string', 'min:3'],
            'aws_region' => ['required', 'string', 'min:3'],
            'aws_bucket' => ['required', 'string', 'min:3'],
            'email' => ['required', 'string', 'regex:/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/'],
            'timezone' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'site_email.regex' => 'The site email must be a valid email address.',
            'admin_email.regex' => 'The admin email must be a valid email address.',
            'smtp_user.regex' => 'Enter a valid email address.',
            'facebook_url.regex' => 'Enter valid URL',
            'instagram_url.regex' => 'Enter valid URL',
            'twitter_url.regex' => 'Enter valid URL',
            'email.regex' => 'The email must be a valid email address.',
        ];
    }
}

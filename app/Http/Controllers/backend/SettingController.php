<?php

namespace App\Http\Controllers\backend;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Rules\NoHtmlTags;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use Artisan;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    public function index(): View
    {
        activity_log('Setting', 'Show Setting Page');
        return view('backend.settings.index');
    }

    public function update(Request $request): JsonResponse
    {

        try {
            DB::beginTransaction();
            if ($request->ajax()) {
                $site_logo_exist = $request->site_logo_exist;
                $view_name = $request->view_name;
                if ($view_name == 'timezone_setting') {
                    $validation_array = [
                        'timezone' => 'required',
                    ];
                    $all_data['timezone'] = $request->timezone;
                }
                if ($view_name == 'general_settings') {
                    $validation_array = [
                        'site_name' => 'required|string|max:60|regex:/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/',
                        'site_email' => 'required|string|email|max:80',
                        'site_contact' => 'required|numeric|digits_between:0000000000,9999999999',
                        'site_address' => ['required', new NoHtmlTags],
                        'admin_name' => ['required', 'string', new NoHtmlTags, 'max:60'],
                        'admin_email' => 'required|string|email|max:80',
                        'admin_contact' => 'required|numeric|digits_between:0000000000,9999999999',
                    ];
                    if ($request->hasFile('site_logo')) {
                        $validation_array['site_logo'] = 'mimes:jpg,jpeg,png,JPG,JPEG,PNG';
                    }
                } elseif ($view_name == 'email_settings') {
                    $validation_array = [
                        'smtp_host' => ['required', new NoHtmlTags],
                        'smtp_port' => 'required|numeric',
                        'smtp_encryption' => 'required|in:ssl,tls',
                        'smtp_user' => ['required', 'string', 'max:80', new NoHtmlTags],
                        'smtp_password' => ['required', new NoHtmlTags],
                        'from_name' => ['required', 'string', 'max:80', new NoHtmlTags],
                        'reply_to_email' => 'required|string|email|max:80',
                        'email_signature' => ['required', 'string', 'max:80', new NoHtmlTags],
                    ];
                } elseif ($view_name == 'social_media_settings') {
                    $validation_array = [
                        'facebook_url' => ['active_url', 'nullable', new NoHtmlTags],
                        'instagram_url' => ['active_url', 'nullable', new NoHtmlTags],
                        'twitter_url' => ['active_url', 'nullable', new NoHtmlTags],
                    ];
                } elseif ($view_name == 'project_mode_setting') {
                    $validation_array = [
                        // 'ip_address'            => 'required',
                    ];
                }
                if (isset($validation_array)) {
                    $request->validate($validation_array, [
                        'site_logo.mimes' => "Please select jpg, jpeg and png format only.",
                        'site_contact.digits_between' => "Please enter valid contact number.",
                        'site_name.regex' => "Please enter letters only.",
                        'admin_contact.digits_between' => "Please enter valid contact number.",
                        'admin_name.max' => "The admin name must not be greater than 60 characters.",
                    ]);
                }
                $all_data = $request->except([
                    '_token',
                    'proengsoft_jsvalidation',
                    'view_name',
                    'site_logo_exist',
                ]);
                if ($request->hasFile('site_logo')) {
                    $file_name = 'site_logo' . '.' . $request->file('site_logo')->getClientOriginalExtension();
                    $site_logo = file_uploading(
                        $request->file('site_logo'),
                        $file_name,
                        'site_logo',
                        'site_logo.png'
                    );
                    $all_data['site_logo'] = $site_logo;
                } else {
                    $all_data['site_logo'] = $site_logo_exist == 1 ? config('customConfig.site.logo') : '';
                }
                foreach ($all_data as $key_data => $data) {
                    $is_exists = Setting::where('name', $key_data)->count();
                    if ($is_exists) {
                        $result = Setting::where('name', $key_data)->update([
                            'value' => $data,
                        ]);
                    } else {
                        $result = Setting::create([
                            'user_id' => Auth::id(),
                            'name' => $key_data,
                            'value' => $data,
                        ]);
                    }
                }
                $view_name = ucfirst(str_replace('_', ' ', $view_name));
                DB::commit();
                activity_log('Setting Update', $view_name . ' has been updated successfully');
                Artisan::call('config:cache');
                Artisan::call('cache:clear');

                return get_success_response(route('admin.settings'), $view_name . ' has been updated successfully.', ['redirect_url' => route('admin.settings')]);
            }
            activity_log('Setting Update', '500 server not found');
            return get_fail_response(route('admin.settings'), 'Something went wrong!.', ['redirect_url' => route('admin.settings')]);
        } catch (\Exception $e) {
            DB::rollback();
            activity_log('Setting Update', 'Something want to wrong.' . $e);
            return response()->json(json_response(false, $e->getMessage()), 500);
        }
    }

    /* clear cache */
    public function clear_cache(): JsonResponse
    {
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('clear-compiled');
        return get_success_response(route('admin.settings'), 'Cache cleared successfully.');
    }

}

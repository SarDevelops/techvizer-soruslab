<?php
use App\Models\ActivityLog;
use App\Models\EmailTemplate;
use App\Models\RolePermission;
use App\Models\RolePermissionModule;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

if (!function_exists('json_response')) {
    function json_response($flag = false,$message = 'Someting went wrong',$data = []) {
        $response['FLAG'] = $flag;
        $response['MESSAGE'] = $message;
        $response['DATA'] = $data;

        return $response;
    }
}

if (!function_exists('file_uploading')) {
    function file_uploading($file, $file_name, $folder, $old_profile = '', $webp = false)
    {
        try {
            $destination = public_path("uploads/$folder");
            if ($old_profile) {
                $unlink_file = $destination . '/' . $old_profile;
                if (file_exists($unlink_file)) {
                    unlink($unlink_file);
                }
            }

            if (!File::isDirectory($destination)) {
                File::makeDirectory($destination, 0777, true, true);
            }

            $file->move($destination, $file_name);
            // Store webp image start here
            if ($webp) {
                if ($old_profile) {
                    $unlink_webp_file = $destination . '/webp/' . webp_file_name($old_profile);
                    if (file_exists($unlink_webp_file)) {
                        unlink($unlink_webp_file);
                    }
                }

                $destination_webp = $destination . '/webp';
                if (!File::isDirectory($destination_webp)) {
                    File::makeDirectory($destination_webp, 0777, true, true);
                }

                $webp_file_name = webp_file_name($file_name);
                $image = Image::make($destination . '/' . $file_name)->encode('webp', 90)->save($destination_webp . '/' . $webp_file_name);
            }
            // Store webp image end here
            return $file_name;
        } catch (\Exception $e) {
            return $e;
        }
    }
}

if (!function_exists('get_settings')) {
    function get_settings($name = '')
    {
        if ($name == '') {
            $settings = Setting::all();

            return $settings;
        } else {
            $result = Setting::where('name', $name)->first();
            if ($result) {
                if (in_array($name, ['email_header', 'email_footer'])) {
                    return stripslashes($result['value']);
                } else {
                    return $result->value;
                }
            } else {
                return null;
            }
        }
    }
}

if (!function_exists('str_slug')) {
    function str_slug($string = '')
    {
        return Str::slug($string);
    }
}

if (!function_exists('is_active_menu')) {
    function is_active_menu($url_name, $className = 'active', $params = '')
    {
        if (request()->route()) {
            $name = request()
                ->route()
                ->getName();
            $url_params = request()->route('location');

            if (is_array($url_name)) {
                return in_array($name, $url_name) ? $className : '';
            } else {
                if ($name == $url_name) {
                    if (isset($url_params)) {
                        if ($url_params == $params) {
                            return $className;
                        } else {
                            return '';
                        }
                    }

                    return $className;
                } else {
                    return '';
                }
            }
            return null;
        }
    }
}

if (!function_exists('get_service')) {
    function get_service($service_id, $value = '')
    {
        $service = Service::findOrFail($service_id);

        if ($value != null) {
            return $service[$value];
        }

        return $service;
    }
}

if (!function_exists('is_all_action_permision')) {
    function is_all_action_permision($permissions_name)
    {
        foreach ($permissions_name as $permission) {
            if (\Gate::allows($permission)) {
                return '';
            }
        }

        return '-';
    }
}

/**
 * User activity logs
 * @param  string   $activity       Activity name/title
 * @param  string   $description    short description about activity
 * @param  int      $logged_by      Logged-In User ID
 * @return null
 */
if (!function_exists('activity_log')) {
    function activity_log($activity, $description, $logged_by = 0)
    {
        if (Auth::check()) {
            $logged_by = Auth::user()->id;
        }

        if (\Schema::hasTable('activity_logs')) {
            ActivityLog::create([
                'activity' => $activity,
                'description' => $description,
                'logged_by' => $logged_by,
            ]);
        }
    }
}

//this function is used for get success response
if (!function_exists('get_success_response')) {
    function get_success_response($url = '', $message = '', $extra_parameter = array(), $set_alert = 0)
    {
        if (Request::ajax()) {
            $response['status'] = true;
            $response['msg'] = $message;

            if (!empty($extra_parameter)) {
                $response = array_merge($response, $extra_parameter);
            }

            if ($set_alert && $message != '') {
                Session::flash(config('general.msg_message'), $message);
            }
            return response()->json($response, 200);
            exit;
        } else {
            return redirect($url)->with(config('general.msg_message'), $message);
            return true;
        }
    }
}

//this function is used for get fail response
if (!function_exists('get_fail_response')) {
    function get_fail_response($url = '', $message = "No record found.", $extra_parameter = array(), $set_alert = 0)
    {
        if (Request::ajax()) {
            $response['status'] = false;
            $response['msg'] = $message;

            if (!empty($extra_parameter)) {
                $response = array_merge($response, $extra_parameter);
            }

            if ($set_alert && $message != '') {
                Session::flash(config('general.msg_error'), $message);
            }
            return response()->json($response, 500);
            exit;
        } else {
            return redirect($url)->with(config('general.msg_error'), $message);
            return true;
        }
    }
}

if (!function_exists('check_image_exist')) {
    function check_image_exist($path = '', $result = false)
    {
        if ($path && File::exists(public_path($path))) {
            return asset($path);
        } else {
            if ($result) {
                return false;
            } else {
                return asset('theme/dist/assets/media/avatars/blank.png');
            }

        }
    }
}
if (!function_exists('get_email_template')) {
    function get_email_template($slug)
    {
        $result = EmailTemplate::where('slug', $slug)->first();
        if ($result) {
            return $result;
        } else {
            return null;
        }
    }
}
if (!function_exists('server_info')) {
    function server_info()
    {
        $server_info = URL::current();
        $explode = explode('/', $server_info);
        $host = isset($explode[2]) ? $explode[2] : 'localhost';
        return $host;
    }
}

if (!function_exists('is_localhost_server')) {
    function is_localhost_server()
    {
        $server_info = server_info();
        if (
            $server_info == 'localhost' ||
            $server_info == '127.0.0.1:8000' ||
            $server_info == '127.0.0.1'
        ) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * debug_print_r
 *
 * @param array|object $variable The variable name of the function.
 */
if (!function_exists('debug_print_r')) {
    function debug_print_r($variable, $is_die = false)
    {
        if (get_settings('production_mode') == 1) {
            $ip_addresses = explode(",", get_settings('ip_address'));
            if (in_array($_SERVER['REMOTE_ADDR'], $ip_addresses)) {
                if (is_array($variable)) {
                    echo "<pre>";
                    print_r($variable);
                    echo "</pre>";
                } elseif (is_object($variable)) {
                    echo "<pre>";
                    print_r($variable);
                    echo "</pre>";
                } else {
                    echo $variable;
                }

                if ($is_die) {
                    die;
                }

            }
        }
    }
}

/**
 * debug_dd
 *
 * @param array|object $variable The variable name of the function.
 */
if (!function_exists('debug_dd')) {
    function debug_dd($variable)
    {
        if (get_settings('production_mode') == 1) {
            $ip_addresses = explode(",", get_settings('ip_address'));
            if (in_array($_SERVER['REMOTE_ADDR'], $ip_addresses)) {
                if (is_array($variable)) {
                    dd($variable);
                } else if (is_object($variable)) {
                    dd($variable);
                } else {
                    dd($variable);
                }
            }
        }
    }
}

/**
 * format_date
 *
 * @param date $date The variable name of the function
 * @return date format date and time according to the set time zone in General Setting (Timezone)
 */
if (!function_exists('format_date')) {
    function format_date($date)
    {
        $date = \Carbon\Carbon::parse($date, 'UTC')->setTimezone(config('customConfig.site.timezone'));
        $formattedDate = $date->format('d-M-Y h:i a');
        return $formattedDate;
    }
}
/**
 * is_test_data
 */
if (!function_exists('is_test_data')) {
    function is_test_data()
    {
        $production_mode = config('customConfig.environment.production_mode');
        return ($production_mode == 1) ? '0' : '1';
    }
}

if (!function_exists('is_section_menu')) {
    function is_section_menu($sections)
    {
        $permissions = RolePermissionModule::select('id')->whereIn('module_type', $sections)->get()->toArray();
        $idValues = array_map(function ($item) {
            return $item['id'];
        }, $permissions);
        $roles = RolePermission::whereIn('module_id', $idValues)->where('role_id', auth()->user()->role)->get();
        foreach ($roles as $key => $role) {
            if ($role->permissions['view']) {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('is_section_menu')) {
    function is_section_menu($sections)
    {
        $permissions = RolePermissionModule::select('id')->whereIn('module_type', $sections)->get()->toArray();
        $idValues = array_map(function ($item) {
            return $item['id'];
        }, $permissions);
        $roles = RolePermission::whereIn('module_id', $idValues)->where('role_id', auth()->user()->role)->get();
        foreach ($roles as $key => $role) {
            if ($role->permissions['view']) {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('webp_file_name')) {
    function webp_file_name($file_name = '')
    {
        return explode('.', $file_name)[0] . '.webp';
    }
}

if (!function_exists('generate_random_string')) {
    function generate_random_string()
    {
        return Str::random(15);
    }
}

if (!function_exists('remove_directory')) {
    function remove_directory($path)
    {
        if (File::isDirectory($path)) {
            File::deleteDirectory($path);
            return true;
        }
        return false;
    }
}

if (!function_exists('default_image_url')) {
    function default_image_url()
    {
        return asset("images/no_image.png");
    }
}

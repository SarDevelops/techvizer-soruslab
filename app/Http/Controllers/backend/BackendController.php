<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\AdminProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BackendController extends Controller
{
    public function profile(Request $request): View
    {
        $admin = Auth::guard('admin')->user();

        activity_log('Admin Profile', 'Show Admin Profile Page');
        return view('backend.profiles.profile', compact('admin'));
    }

    public function profile_update(AdminProfileRequest $request)
    {
        try {
            DB::beginTransaction();
            $admin = User::findOrFail(Auth::guard('admin')->user()->id);
            $admin->first_name = $request->first_name;
            $admin->last_name = $request->last_name;

            $profile_name = '';
            // Upload the profile picture
            if ($request->hasFile('profile')) {
                $profile_name = file_uploading(
                    $request->file('profile'), // File which is uploading
                    base64_encode(time()).'.'.$request->file('profile')->getClientOriginalExtension(), // Rename the file and override to save the storage
                    'user_profile', // Folder name,
                    Auth::user()->profile
                );
            }
            if (!empty($profile_name)) {
                $admin->profile = $profile_name;
            }

            if ($admin->save()) {
                DB::commit(); // If everything went well, commit the transaction
                activity_log('Upload Profile Picture', 'Your profile has been updated successfully.');
                toastr()->success('Your profile has been updated successfully.');
                return response()->json(json_response(true, 'Your profile has been updated successfully.'), 200);
            }
            activity_log('Upload Profile Picture error', '500 server not found');
            return response()->json(json_response(), 500);

        } catch (\Exception $e) {
            DB::rollback(); // Something went wrong, rollback the transaction
            // Optionally handle the exception or log it
        }
    }

    public function change_password(ChangePasswordRequest $request)
    {
        $this->change_password_update_mail();
        // dd($request->all());
        $admin = User::findOrFail(Auth::guard('admin')->user()->id);
        $admin->password = bcrypt($request->new_password);
        if ($admin->save()) {
            activity_log('Change Admin password', 'Your Password has been updated successfully.');

            return response()->json(json_response(true, 'Your password has been updated successfully.'), 200);
        }
        activity_log('Change Admin password error', '500 server not found');
        return response()->json(json_response(), 500);

    }

}

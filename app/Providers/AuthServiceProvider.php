<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\ResetPassword;
use Auth;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::before(function ($user) {
			$user_permitted_modules = $user->role_detail->permissions;

            if ($user_permitted_modules) {
				foreach($user_permitted_modules as $key => $user_permitted_module) {
					$module_name = $user_permitted_module->module_detail->module_type;
                    $permission_types = $user_permitted_module->permissions;
                    foreach($permission_types as $permission_type => $is_permitted) {

                        if ($is_permitted) {
                            Gate::define("$module_name:$permission_type", function ($user) use ($is_permitted) {
                                return true;
                            });
                        }
                    }
                }
            }
        });

        // Change the link path for reset password link
        ResetPassword::createUrlUsing(function ($user, string $token) {
            if ($user->role_detail->role_name == 'admin') {
                return route('admin.password.reset', ['token' => $token]);
            }
            return route('password.reset', ['token' => $token]);
        });
    }
}

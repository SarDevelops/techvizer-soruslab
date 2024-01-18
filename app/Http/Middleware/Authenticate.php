<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (str_contains($request->route()->getPrefix(), 'admin')) {
            if (! $request->expectsJson()) {
                return route('admin.login');
            }
        }else{

            if (! $request->expectsJson()) {
                return route('login');
            }
        }
    }
}

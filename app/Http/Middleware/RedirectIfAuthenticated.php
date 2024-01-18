<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string...$guards): Response
    {
        $is_admin = (str_contains($request->url(), 'admin')) ? true : false;

        if (!$is_admin && Auth::guard('web')->check()) {
            return redirect(RouteServiceProvider::HOME);
        }

        if ($is_admin && Auth::guard('admin')->check()) {
            return redirect(RouteServiceProvider::ADMIN_HOME);
        }

        return $next($request);
    }
}

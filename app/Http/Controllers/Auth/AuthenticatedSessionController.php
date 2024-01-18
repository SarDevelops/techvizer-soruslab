<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        // Check the route prefix is admin
        if (str_contains($request->route()->getPrefix(), 'admin')) {
            activity_log('Admin', 'Admin login page');
            return view('auth.admin.login');
        }

        activity_log('User', 'User login page');
        return view('auth.login'); // User login page
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse | JsonResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $redirect_route = route('dashboard');
        // if URL contains the prefix admin then redict on admin panel
        // Ex: https://www.example.com/admin/login
        if (str_contains(request()->route()->getPrefix(), 'admin')) {
            $redirect_route = route('admin.dashboard');
        }

        toastr()->success('You have successfully logged in.');
        if ($request->ajax()) {
            return response()->json(json_response(true, 'Add health concern form fetch successfully.',['redirect_url' => $redirect_route]), 200);
        }
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $redirect = route('login');
        if (str_contains(request()->route()->getPrefix(), 'admin')) {
            Auth::guard('admin')->logout();
            activity_log('Admin Logout', 'Admin Logout successfully');
            $redirect = route('admin.login');
        } else {
            activity_log('User Logout', 'User Logout');
            Auth::guard('web')->logout();
        }
        $request->session()->regenerate();
        toastr()->success('You have successfully logged out.');
        return redirect()->to($redirect);
    }
}

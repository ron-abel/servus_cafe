<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Tenant;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $domain_name = explode('.', URL::current());
        $subdomain = substr($domain_name[0], strrpos($domain_name[0], '/') + 1);
        $tenant_details = DB::table('tenants')->where('tenant_name', $subdomain)->first();
        $request->authenticate();
        if(Auth::user()->user_role_id == 3){
            return redirect()->intended('student');
        }
        $request->session()->regenerate();
        if($tenant_details){
            return redirect()->intended('admin');
        }
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $domain_name = explode('.', URL::current());
        $subdomain = substr($domain_name[0], strrpos($domain_name[0], '/') + 1);
        $tenant_details = Tenant::where("tenant_name",$subdomain)->first();
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        if($subdomain && $tenant_details){
            return redirect('/admin/login');
        }
        return redirect('/login');
    }
    public function clientDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/student/login');
        return redirect('/login');
    }
}

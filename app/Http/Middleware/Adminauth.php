<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Adminauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_id = Auth::id();
        $sub_domain_name = config('app.superadmin');
        if($user_id && Auth::user()->user_role_id == 2){
          $user_details = Auth::user();
          
          view()->share('user_details', $user_details);
          view()->share('sub_domain', $sub_domain_name);
          
          return $next($request);
        } else{
            return redirect('admin/login');
        }
    }
}

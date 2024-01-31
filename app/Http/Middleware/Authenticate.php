<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // $domain_name = explode('.', URL::current());
        // $subdomain = substr($domain_name[0], strrpos($domain_name[0], '/') + 1);
        // // dd($subdomain);
        // if($subdomain){
        //     return $request->expectsJson() ? null : route('admin.login');
        // }
        return $request->expectsJson() ? null : route('login');
    }
}

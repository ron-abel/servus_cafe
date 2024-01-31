<?php
$tenant = App\Models\Tenant::find($tenant_id);
$is_active = 0;
if ($tenant && isset($tenant->id)) {
    $is_active = $tenant->is_active;
}
?>
@extends('admin.layouts.logindefault')

@section('title', 'Servus cafe - Studen Login Credentials Required')

@section('content')


<div class="main-container">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="logo ">
                <a href="#">
                    <img src="{{ asset('img/client/whitelogo2.svg') }}" style="width:100%;max-height:100px;"  alt="ServusCafe Logo">
                </a>
            </div>
            <form method="post" action="{{ route('student_login') }}" class="login100-form validate-form">
                @csrf
                @if ( session()->has('error') )
                <div style="width:100%; padding:5px; font-size:13px; font-weight:bold; color:#f00; text-align:center;">
                    {{ session()->get('error') }}
                </div>
                @endif
                @if(session()->has('success'))
                <div class="text-success" style="width:100%; padding:5px; font-size:13px; font-weight:bold;  text-align-center">
                    {{ session()->get('success') }}
                </div>
                @endif
                @if(session()->has('info'))
                    <div class="text-info" style="width:100%; padding:5px; font-size:13px; font-weight:bold; text-align-center">
                        {{ session()->get('info') }}
                    </div>
                @endif

				<div class="login100-form-title">
                	<span class="login100-form-title-1">
                        Student Login
                	</span>
	            </div>

                <div class="wrap-input100 validate-input m-b-20 mt-2" data-validate="User email is required">
                    <input class="input100" type="email" name="email" placeholder="Enter your email" required />
                </div>

                @error('email')
                <p class="mt-2 text-sm text-red-600" id="email-error">{{ $message }}</p>
                @enderror

                <div class="wrap-input100 validate-input m-b-20 mt-2" data-validate="Password is required">
                    <input name="password" class="input100" type="password" placeholder="Enter Your Password" required />
                </div>

                @error('email')
                <p class="mt-2 text-sm text-red-600" id="email-error">{{ $message }}</p>
                @enderror

                <div class="form-check col-md-12 ml-1">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label style="font-size:14px;" class="" for="remember">
                        Remember Me
                    </label>
                </div>

				<div class="container-login-form-btn">
                @if(!$is_active)
                <button disabled="disabled" type="button" role="button" class="login-form-btn bg-accent">Login</button>
                @else
                <input type="submit" class="login100-form-btn bg-accent" value="Login" />
                    @endif
                </div>

                <div class="col-md-12 text-center pt-2">
                    <a href="/forgot_password">Forgot Password?</a>
                    <br>
                    @if(!$is_active)
                <div class="col-md-12 text-center">
                    <p class="text-danger mt-2">
                        This portal is inactive. Please email {{env('ADMIN_SUPPORT_EMAIL')}} for help.
                    </p>
                </div>
                @else
                <a href="{{url('/register_user')}}">Signup</a>
                @endif
                </div>
            </form>
        </div>
    </div>
</div>
@stop

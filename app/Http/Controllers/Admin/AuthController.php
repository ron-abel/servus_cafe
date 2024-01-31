<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $sendGridServices;
    public $sub_domain_name;
    public $cur_tenant_id;
    public function __construct()
    {
        Controller::setSubDomainName();
        $this->sub_domain_name = session()->get('subdomain');
        $this->cur_tenant_id = session()->get('tenant_id');
        // $this->sendGridServices = new SendGridServices($this->cur_tenant_id);
    }
    public function login(Request $request)
    {
        if(Auth::check()){
            return redirect('admin');
        }
        $subdomain = $this->sub_domain_name;
        $tenant_id = $this->cur_tenant_id;
        $tenant_details = Tenant::where('tenant_name', $subdomain)->first();

        $user_id = Auth::id();
        

        if ($subdomain == config('app.superadmin')) {
            return view('superadmin.login', ['tenant_id' => $tenant_id]);
        } else {
            return view('admin.login', ['tenant_id' => $tenant_id, 'subdomain' => $subdomain]);
        }
    }
    public function register_user($subdomain, Request $request)
    {
        return view('admin.pages.register_user', ['error' => "", 'tenant_id' => $this->cur_tenant_id, 'subdomain' => $subdomain]);
        // try{
        //     $tenant_id = $this->cur_tenant_id;
        //     $invite = UserInvite::where("tenant_id", $tenant_id)->where('token', $request->token)->first();
        //     $error = "";
        //     if (!isset($invite) and empty($invite)) {
        //         $error = "Link is invalid please contact support!";
        //     }
        //     return $this->_loadContent('admin.pages.register_user', ['error'=>$error, 'tenant_id'=>$tenant_id, 'invite' => $invite, 'subdomain'=>$subdomain, 'token'=>$request->token]);
        // } catch (Exception $e) {
        //     return $e->getMessage();
        // }
    }

    /*
    * [POST] Register invited user
    */
    public function post_register_user($subdomain, Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required | min:6',
            'confirm_password' => 'required|same:password'
        ]);
        // dd($request,$this->cur_tenant_id);
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request['password']);
        $user->user_role_id = 2;
        $user->tenant_id = $this->cur_tenant_id;
        if ($user->save()) {
            event(new Registered($user));
            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);;
        }
        return redirect()->back();
        // $user 

    }
}

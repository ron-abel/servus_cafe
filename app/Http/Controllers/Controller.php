<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class Controller extends BaseController
{
    use AuthorizesRequests , ValidatesRequests;
    var $data;
    var $fv_cur_tenant_id;

    public function __construct()
    {

        $this->data = array();
    }

    public function setSubDomainName()
    {
        //Check Subdomain
        $domain_name = explode('.', URL::current());
        $subdomain = substr($domain_name[0], strrpos($domain_name[0], '/') + 1);

        $tenant = DB::table('tenants')->where('tenant_name', $subdomain)->first();

        //To used in other files as well
        session()->put('subdomain', $subdomain);
        if (isset($tenant->id)) {
            session()->put('tenant_id',  $tenant->id);
        }

        $this->fv_cur_tenant_id = session()->get('tenant_id');
    }
}

<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Sandwich;
use App\Models\Topping;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;


class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (config('app.env') == 'local') {
            $http = "http://";
        } else {
            $http = "https://";
        }
        $domainName = config('app.domain');
        $all_tenants = Tenant::with('owner')->get();
        return view('superadmin.home', [
            'all_tenants' => $all_tenants,
            'all_plans' => "",
            'plans' => "",
            'max_price_plan' => "",
            'domainName'  => $domainName,
            'http'        => $http,
        ]);
    }

    public function editTenantActiveStatus($tenant_id, Request $request)
    {
        try {
            $tenant_details =  Tenant::where('id', $tenant_id)->first();
            
            if ($tenant_details) {
                $tenant_details->is_active = $request->input('status');

                if ($tenant_details->save()) {
                    return response()->json([
                        'success'        => true,
                        'message'  => 'Tenant status changed successfully'
                    ], 200);
                } else {
                    return response()->json([
                        'success'        => false,
                        'message'  => 'Unable to change status at the moment'
                    ], 200);
                }
            } else {
                return response()->json([
                    'success'        => false,
                    'message'  => 'Unable to change status at the moment'
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'success'        => false,
                'message'  => $e->getMessage()
            ], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('superadmin.pages.add_tenant');
    }
    public function order(Request $request)
    {
        if($request->input('tenant_id')){
            $all_orders = DB::table('orders')
            ->select('orders.*', 'users.first_name as first_name', 'users.last_name as last_name',
             'locations.name as name', 'sandwiches.sandwich_name as sandwich_name','tenants.tenant_name as tenant_name')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('tenants', 'orders.tenant_id', '=', 'tenants.id')
            ->leftJoin('locations', 'orders.location_id', '=', 'locations.id')
            ->leftJoin('sandwiches', 'orders.sandwich_id', '=', 'sandwiches.id')
            ->orderBy('user_id', 'desc')
            ->orderBy('order_date', 'desc')
                ->where('orders.tenant_id', $request->input('tenant_id'))
                ->get();
            foreach ($all_orders as $o) {
                $toppingIds = json_decode($o->topping_id, true);
                if (is_array($toppingIds) && !empty($toppingIds)) {
                    $toppings = DB::table('toppings')
                        ->select('toppings.topping_name')
                        ->whereIn('id', $toppingIds)
                        ->get();
            
                    $o->toppings = $toppings;
                }elseif(!empty($toppingIds)){
                    $toppings = DB::table('toppings')
                        ->select('toppings.topping_name')
                        ->where('id', $toppingIds)
                        ->get();
            
                    $o->toppings = $toppings;

                } else {
                    $o->toppings = null;
                }
            }
            return response()->json($all_orders);    
        }
        $all_tenants = Tenant::get();
        $all_orders = DB::table('orders')
            ->select('orders.*', 'users.first_name as first_name', 'users.last_name as last_name',
             'pickup_times.name as name', 'sandwiches.sandwich_name as sandwich_name','tenants.tenant_name as tenant_name')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('tenants', 'orders.tenant_id', '=', 'tenants.id')
            ->leftJoin('pickup_times', 'orders.location_id', '=', 'pickup_times.id')
            ->leftJoin('sandwiches', 'orders.sandwich_id', '=', 'sandwiches.id')
            ->orderBy('user_id', 'desc')
            ->orderBy('order_date', 'desc')
            ->get();

        foreach ($all_orders as $o) {
            $toppingIds = json_decode($o->topping_id, true);
            if (is_array($toppingIds) && !empty($toppingIds)) {
                $toppings = DB::table('toppings')
                    ->select('toppings.topping_name')
                    ->whereIn('id', $toppingIds)
                    ->get();
        
                $o->toppings = $toppings;
            }elseif(!empty($toppingIds)){
                $toppings = DB::table('toppings')
                    ->select('toppings.topping_name')
                    ->where('id', $toppingIds)
                    ->get();
        
                $o->toppings = $toppings;

            } else {
                $o->toppings = null;
            }
        }
        return view('superadmin.pages.order', compact('all_orders','all_tenants'));
    }
    public function location()
    {
        $all_tenants = Tenant::get();
        $all_locations = Location::with('tenant')->get();
        return view('superadmin.pages.location', compact('all_locations', 'all_tenants'));
    }
    public function getLocations(Request $request)
    {
        $tenantId = $request->input('tenant_id');

        $locations = Location::with('tenant')->where('tenant_id', $tenantId)->get();

        return response()->json($locations);
    }
    public function sandwich(Request $request)
    {
        if($request->input('tenant_id')){
            $all_sandwiches = Sandwich::with('tenant')->where('tenant_id', $request->input('tenant_id'))->get();
            return response()->json($all_sandwiches);    
        }
        $all_tenants = Tenant::get();
        $all_sandwiches = Sandwich::with('tenant')->get();
        return view('superadmin.pages.sandwich', compact('all_sandwiches','all_tenants'));
    }
    public function topping(Request $request)
    {
        if($request->input('tenant_id')){
            $all_sandwiches = Topping::with('tenant')->where('tenant_id', $request->input('tenant_id'))->get();
            return response()->json($all_sandwiches);    
        }
        $all_tenants = Tenant::get();
        $all_toppings = Topping::with('tenant')->get();
        return view('superadmin.pages.topping',compact('all_toppings','all_tenants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->tenant_id){
            $tenant = Tenant::with('owner')->find($request->tenant_id);
            $user = $tenant->owner;
        }else{
            $request->validate([
                'tenant_name' => 'required|unique:tenants,tenant_name',
                'school_name' => 'required|string',
                'school_location' => 'required|string',
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => 'required|same:confirm_password'
            ]);
    
            $tenant = new Tenant();
            $user = new User();
        }
        $tenant->tenant_name = $request->tenant_name;
        $tenant->school_name = $request->school_name;
        $tenant->school_location = $request->school_location;
        $tenant->note = $request->note;
        $tenant->save();

        if ($tenant) {
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->user_role_id = 2;
                $user->tenant_id = $tenant->id;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
            $user->save();
            return redirect('/admin');
        }
        return redirect()->back()->with('error', "failed");
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant,$id)
    {
        $tenant = Tenant::with('owner')->findOrFail($id);
        return view('superadmin.pages.add_tenant',compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        //
    }
}

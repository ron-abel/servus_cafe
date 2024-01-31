<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Order;
use App\Models\Sandwich;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index() 
    {
        return view('admin.pages.dashboard');
    }
    public function order() 
    {
        $all_orders = DB::table('orders')
            ->select('orders.*', 'users.first_name as first_name','users.last_name as last_name', 
            'pickup_times.name as name',
            'sandwiches.sandwich_name as sandwich_name')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('pickup_times', 'orders.location_id', '=', 'pickup_times.id')
            ->leftJoin('sandwiches', 'orders.sandwich_id', '=', 'sandwiches.id')
            ->orderBy('user_id', 'desc')
            ->orderBy('order_date', 'desc')
            ->where('orders.tenant_id',Auth::user()->tenant_id)
            ->get();
            foreach ($all_orders as $key=>$o) {
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
        return view('admin.pages.order',compact('all_orders'));
    }
    public function profile() 
    {
        return view('admin.pages.profile');
    }
    public function location() 
    {
        $all_locations = Location::where('tenant_id',Auth::user()->tenant_id)->get();
        return view('admin.pages.location',compact('all_locations'));
    }
   
    //
}

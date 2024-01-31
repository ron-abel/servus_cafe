<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_locations = Location::where('tenant_id',Auth::user()->tenant_id)->get();
        return view('admin.pages.location',compact('all_locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.locationForm');   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $subdomain, $id)
    {
        $location = Location::find($id);
        return view('admin.pages.locationForm',compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tenant_id = Auth::user()->tenant_id;
        if($request->location_id !==null){
            $location = Location::find($request->location_id);
            $message = "Updated Successfully";
        }else{
            $request->validate([
                "location_name"=>"required",
                // "api_key"=>"required",
                // "printer_id"=>"required"
            ]);
            $location = new Location();
            $message = "Created Successfully";
        }
        $location->name = $request->location_name;
        // $location->api_key = $request->api_key;
        // $location->printer_id = $request->printer_id;
        $location->tenant_id = $tenant_id;
        if($location->save()){
            return redirect('admin/pickup_time')->with('success',$message);
        }
        return redirect()->back()->with('error',"Failed");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $subdomain,$id)
    {
    
        $topping = Location::where('id',$id)->delete();
        if($topping){
            return redirect()->back()->with('success',"Location deleted Successfully");
        }
        return redirect()->back()->with('error',"Failed");

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToppingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_toppings = Topping::where('tenant_id',Auth::user()->tenant_id)->get();
        return view('admin.pages.topping',compact('all_toppings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.toppingForm');
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
    public function edit(string $subdomain,$id)
    {
        $topping = Topping::find($id);
        return view('admin.pages.toppingForm',compact('topping'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tenant_id = Auth::user()->tenant_id;
        if($request->topping_id !==null){
            $topping = Topping::find($request->topping_id);
            $message = "Updated Successfully";
        }else{
            $topping = new Topping();
            $message = "Created Successfully";
        }
        $topping->topping_name = $request->topping_name;
        $topping->tenant_id = $tenant_id;
        if($topping->save()){
            return redirect('admin/toppings')->with('success',$message);
        }
        return redirect()->back()->with('error',"Failed");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $tenant,$id)
    {
    
        $topping = Topping::where('id',$id)->delete();
        if($topping){
            return redirect()->back()->with('success',"Topping deleted Successfully");
        }
        return redirect()->back()->with('error',"Failed");

    }
}

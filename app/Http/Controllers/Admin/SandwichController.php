<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sandwich;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SandwichController extends Controller
{
    public function index() 
    {
        $all_sandwiches = Sandwich::where('tenant_id',Auth::user()->tenant_id)->get();
        return view('admin.pages.sandwich',compact('all_sandwiches'));
    }
    public function create()
    {
        return view('admin.pages.sandwichForm');    
    }
    public function edit(string $subdomain, $id)
    {
        $sandwich = Sandwich::find($id);
        return view('admin.pages.sandwichForm',compact('sandwich'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tenant_id = Auth::user()->tenant_id;
        if($request->sandwich_id !==null){
            $sandwich = Sandwich::find($request->sandwich_id);
            $message = "Updated Successfully";
        }else{
            $sandwich = new Sandwich();
            $message = "Created Successfully";
        }
        $sandwich->sandwich_name = $request->sandwich_name;
        $sandwich->tenant_id = $tenant_id;
        if($sandwich->save()){
            return redirect('admin/sandwiches')->with('success',$message);
        }
        return redirect()->back()->with('error',"Failed");
    }
    public function destroy(string $subdomain,$id)
    {
        $topping = Sandwich::where('id',$id)->delete();
        if($topping){
            return redirect()->back()->with('success',"Sandwich deleted Successfully");
        }
        return redirect()->back()->with('error',"Failed");

    }
}

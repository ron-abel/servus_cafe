<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TenantPrintNode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrintNodeController extends Controller
{
    public function index()
    {
        $printNode = TenantPrintNode::where('tenant_id',Auth::user()->tenant_id)->get();
        return view('admin.pages.printNode',compact('printNode'));
    }
    public function create()
    {
        return view('admin.pages.printNodeForm');
    }
    public function edit(string $subdomain,$id)
    {
        $printNode = TenantPrintNode::find($id);
        return view('admin.pages.printNodeForm',compact('printNode'));
    }
    public function update(Request $request, string $id)
    {
        $tenant_id = Auth::user()->tenant_id;
        if($request->print_node_id !==null){
            $request->validate([
                "api_key"=>"required",
                "printer_id"=>"required|numeric"
            ]);
            $printNode = TenantPrintNode::find($request->print_node_id);
            $message = "Updated Successfully";
        }else{
            $request->validate([
                "api_key"=>"required",
                "printer_id"=>"required|numeric"
            ]);
            $printNode = new TenantPrintNode();
            $message = "Created Successfully";
        }
        $printNode->api_key = $request->api_key;
        $printNode->printer_id = $request->printer_id;
        $printNode->tenant_id = $tenant_id;
        if($printNode->save()){
            return redirect('admin/print-node')->with('success',$message);
        }
        return redirect()->back()->with('error',"Failed");
    }
    public function destroy(string $tenant,$id)
    {
    
        $printNode = TenantPrintNode::where('id',$id)->delete();
        if($printNode){
            return redirect()->back()->with('success',"PrintNode deleted Successfully");
        }
        return redirect()->back()->with('error',"Failed");

    }
}

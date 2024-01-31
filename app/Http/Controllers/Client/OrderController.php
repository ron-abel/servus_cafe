<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Order;
use App\Models\Sandwich;
use App\Models\TenantPrintNode;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Rawilk\Printing\Facades\Printing;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect('student/order');

        // return view('client.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {       
        $sandwiches = Sandwich::where('tenant_id',Auth::user()->tenant_id)->get();
        $location = Location::where('tenant_id',Auth::user()->tenant_id)->get();
        $toppings = Topping::where('tenant_id',Auth::user()->tenant_id)->get();
        $user = Auth::user();
        return view('client.pages.order',compact('sandwiches','toppings','user','location'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                "location" => "required",
                "sandwich" => "required",
                "order_date" => "required",
                "other_sandwich" => "required_if:sandwich,other",
            ];
            
            if (isset($request->other_topping_type)) {
                $rules["other_topping"] = "required";
            }else{
                $rules["topping"] = "required";
            }
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $user = Auth::user();
            $order = new Order();
            $order->user_id = $user->id;
            $order->tenant_id = $user->tenant_id;
            $order->location_id = $request->location;
            $order->order_date =  $request->order_date;
            $order->sandwich_id =  $request->sandwich == "other" ? null : $request->sandwich;
            $order->sandwich_other_name =  $request->other_sandwich;
            $order->topping_other_name =  $request->other_topping;
            $order->topping_id =  json_encode($request->topping); 
            $order->save();
            
            // send the printing command
            $orderData = $this->_sendPrintCommand($request->topping, $request->sandwich, $order, $user);
            if(is_string($orderData)){
                return redirect('student/thanks')->with('error',$orderData);
            }
            return redirect('student/thanks')->with('orderData',$orderData);
        } catch (\Exception $ex) {
            Log::warning($ex->getMessage());
            return $ex->getMessage();
        }
    }


    /**
     * Send Printing command.
     */
    public function _sendPrintCommand($topping, $sandwich, $order, $user){
        try {
            // this comes from the PrintNode setup.
            // we can set it up on settings for every school.

            $location = Location::where('id',$order->location_id)->first();

            $printNode = TenantPrintNode::where('tenant_id',$user->tenant_id)->first();
            
            $printer_id = isset($printNode->printer_id) ? $printNode->printer_id : env('PRINT_NODE_TEST_PRINTER_ID');

            $apiKey = isset($printNode->api_key) ? $printNode->api_key:env('PRINT_NODE_API_KEY');
            
            $toppings = Topping::whereIn('id',$topping)->get();
            $sandwich = Sandwich::where('id',$sandwich)->first();
            $orderData = [
                "order"=>$order,
                "user"=>$user,
                "topping"=>$toppings,
                "sandwich"=>$sandwich,
                "location"=>$location,
            ];
            $pdf = FacadePdf::loadView('pdf.order', compact('orderData'));

            $pdfContent = $pdf->output();
    
            $filePath = public_path('orders/order_' . $order->id . '.pdf');
            file_put_contents($filePath, $pdfContent);
            Config::set('printing.drivers.printnode.key', $apiKey);

            $printJob = Printing::newPrintTask()
                ->printer($printer_id)
                ->file($filePath) 
                ->send();
    
            $filePath = public_path('test_order.pdf');

            return $orderData;
        } catch (\Exception $ex) {
            Log::warning($ex->getMessage());
            return $ex->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}

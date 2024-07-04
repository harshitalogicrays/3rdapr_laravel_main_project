<?php

namespace App\Http\Controllers\Admin;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AOrderController extends Controller
{
    public function index(){
        $orders = Orders::paginate(5);
        return view('admin.orders',compact('orders'));
    }
    public function vieworder($id){
        $order = Orders::where('id',$id)->first();
        return view('admin.vieworder',compact('order'));
    }

    public function updatestatus($orderid,Request $request){
        $order = Orders::where('id',$orderid)->first();
        if($order){
            $order->update([
                'status_message'=>$request->order_status
            ]);
        return redirect('/admin/orders')->with('message','order status updated');
        }
    }
}

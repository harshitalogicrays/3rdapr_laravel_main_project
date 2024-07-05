<?php

namespace App\Http\Controllers\Admin;

use App\Models\Orders;
use App\Mail\InvoiceMail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

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

    public function viewinvoice($id){
        $order = Orders::where('id',$id)->first();
        return view('frontend.generate-invoice',compact('order'));
    }
    public function downloadinvoice($id){
        $order = Orders::where('id',$id)->first();
        $data=['order'=>$order];
        $pdf = Pdf::loadView('frontend.generate-invoice', $data);
        return $pdf->download('invoice'.$id.'.pdf');
    }
    public function sendinvoice($id){
        $order = Orders::where('id',$id)->first();
        $data=['order'=>$order];
        $pdf = Pdf::loadView('frontend.generate-invoice', $data);
        $data1 = ['order'=>$order,'pdf'=>$pdf,'subject'=>$order->status_message];
        try{
                Mail::to($order->email)->send(new InvoiceMail($data1));
                return redirect('admin/orders')->with('message','Invoice Mail Sent Successfully');
        }
        catch(\Exeception $e){
            return redirect('admin/orders')->with('message','something went wrong');
        }
    }
}

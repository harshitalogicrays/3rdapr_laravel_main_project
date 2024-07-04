<?php

namespace App\Http\Controllers\frontend;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{   
        public function index(){
            $orders = Orders::where('user_id',auth()->user()->id)->paginate(5);
            return view('frontend.myorders',compact('orders'));
        }
        public function vieworder($id){
            $order = Orders::where('id',$id)->where('user_id',auth()->user()->id)->first();
            return view('frontend.viewmyorder',compact('order'));
        }
}

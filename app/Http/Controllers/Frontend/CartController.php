<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        return view('frontend.cart');
    }
    public function checkout(){
        return view('frontend.checkout-show');
    }
}

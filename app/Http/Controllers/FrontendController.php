<?php

namespace App\Http\Controllers;

use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
   public function index(){
      $categories = Category::where('status','0')->get();
        return view('frontend.index',compact('categories'));
   }

   public function cproducts($id=''){

   }
}

<?php

namespace App\Http\Controllers;

use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Products;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
   public function index(){
      $categories = Category::where('status','0')->get();
        return view('frontend.index',compact('categories'));
   }

   public function cproducts($c=''){
      if($c==''){
         $category='All categories';
         $products = Products::where('status','1')->get();
         return view('frontend.cproducts',compact('category','products'));
      }
      else {
         $category = Category::where('name',$c)->first();
         if($category){
            $products = $category->products()->where('status','1')->get();
            return view('frontend.cproducts',compact('category','products'));
         }
         else {
            return redirect()->back();
         }
      }
      }
     
}

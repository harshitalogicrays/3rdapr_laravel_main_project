<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Products;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

      public function viewproduct($product){
             $product = Products::where('name',$product)->first();
             if($product){
               return view('frontend.viewproduct',compact('product'));
               }
               else {  return redirect()->back(); }
      }

      public function searchproduct(Request $request){
         if($request->search!=null){
           $products =  Products::where('name','LIKE','%'.$request->search.'%')->paginate(5);
           return view('frontend.search',compact('products'));
         }
         else {
            $products =  Products::paginate(5);
            return view('frontend.search',compact('products'));
         }
      }
     
      public function profile(){
         return view('frontend.profile');
      }
      public function saveprofile(Request $request){
            $request->validate([
               'name'=>['required','string'],
               'phone'=>'required|string|min:10|max:10',
               'pincode'=>'required|string|min:6|max:6',
               'address'=>'required|string'
            ]);
           $user =  User::find(Auth::user()->id);
           $user->update(['name'=>$request->name]);
           $user->userDetail()->updateOrCreate(
            [],
            ['user_id'=>$user->id,
            'phone'=>$request->phone,
            'pincode'=>$request->pincode,
            'address'=>$request->address
           ]);
           return redirect()->back()->with('message','user profie updated');
      }

      public function changepassword(){
         return view('frontend.changepassword');
      }

      public function updatepassword(Request $request){
         $request->validate([
            'current_password'=>['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
         ]);
         $currentpasswordstatus=Hash::check($request->current_password, auth()->user()->password);
         if($currentpasswordstatus){
            User::find(auth()->user()->id)->update([
                'password'=>Hash::make($request->password)
            ]);
            return redirect()->back()->with('message','password updated');
        }
        else {
            return redirect()->back()->with('message','password does not match with old password');
        }
      }
}

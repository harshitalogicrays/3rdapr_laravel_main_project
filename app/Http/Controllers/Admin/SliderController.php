<?php

namespace App\Http\Controllers\Admin;


use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function index(){
        $sliders=Slider::paginate(2);
        return view('admin.slider.index',compact('sliders')); }

   public function create(){
        return view('admin.slider.create'); }
        
   public function add(Request $request){
   $validated=$request->validate(['title'=>'required']);
   if($request->hasFile('image')){
    $file=$request->file('image');
    $ext=$file->getClientOriginalExtension();
    $filename=time().'.'.$ext;
    $file->move('uploads/sliders/',$filename);
    $path='uploads/sliders/'.$filename;}
    Slider::create([
        'title'=>$validated['title'],
        'description'=>$request->description,
        'status'=>$request->status==true ? '1':'0',
        'image'=>$path]);
       return redirect('/admin/slider/view')->with('message','slider added');}
}

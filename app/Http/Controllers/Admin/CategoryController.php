<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function view(){
        $categories = Category::paginate(5);
            return view('admin.category.index')->with('categories',$categories);
    }
    public function add(){
        return view('admin.category.add');
    }
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name'=>'required'
        ]);
        $category = new Category;
        $category->name=$request->name;
        $category->description=$request->description;
        $category->status = $request->status==true ? '0':'1';
        if($request->hasFile('image')){
            $uploadPath = 'uploads/category/';
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();          
            $filename=time().'.'.$ext;
            $file->move($uploadPath,$filename);
            $category->image = $uploadPath.$filename;
            if($category->save()) {
                return redirect('/admin/category/view')->with('message','category added');
            }
        }
    }

    public function delete($id){
        $category = Category::find($id);
        if($category){
            if(File::exists($category->image)){
                File::delete($category->image);
            }
            $category->delete();
            return redirect('/admin/category/view')->with('message','category deleted'); 
        }
    }

    public function edit($id){
        $category = Category::find($id);
        return view('admin.category.edit')->with('category',$category);
    }

    public function update($id, Request $request){
        $request->validate([
            'name'=>'required'
        ]);
        $category = Category::find($id);
        $category->name=$request->name;
        $category->description=$request->description;
        $category->status = $request->status==true ? '0':'1';
        if($request->hasFile('image')){
            if(File::exists($category->image)){
                File::delete($category->image);
            }
            $uploadPath = 'uploads/category/';
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();          
            $filename=time().'.'.$ext;
            $file->move($uploadPath,$filename);
            $category->image = $uploadPath.$filename;           
        }
        if($category->save()) {
            return redirect('/admin/category/view')->with('message','category updated');
        }
    }

}

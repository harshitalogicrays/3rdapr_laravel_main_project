<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Products;
use App\Models\Admin\ProductImages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    public function view(){
           $products =  Products::paginate(5);    
        return view('admin.products.index')->with('products',$products);
    }
    public function add(){ 
        $categories = Category::all();
        return view('admin.products.add')->with('categories',$categories);}
        
    public function store(ProductFormRequest $request){ 
        $validatedData = $request->validated();
        $category = Category::find($validatedData['category_id']);
        $product = $category->products()->create([
            'category_id'=>$validatedData['category_id'],
            'name'=>$validatedData['name'],
            'original_price'=>$validatedData['original_price'],
            'selling_price'=>$validatedData['selling_price'],
            'qty'=>$validatedData['qty'],
            'brand'=>$request['brand'],
            'description'=>$request['description'],
            'status'=>$request->status==true ? '1':'0'
        ]);
        if($request->hasFile('image')){
            $uploadPath='uploads/products/';
            $i=1;
            foreach($request->file('image') as $imageFile){
                $ext = $imageFile->getClientOriginalExtension();          
                $filename=time().$i++.'.'.$ext;
                $imageFile->move($uploadPath,$filename);
                $filepathfordb = $uploadPath.$filename;
                $product->productImages()->create([
                    'product_id'=>$product->id,
                    'image'=>$filepathfordb
                ]);
            }  }
        return redirect('/admin/product/view')->with('message','product added');
    }
    function delete($id){
        $product = Products::find($id);
        if($product->productImages){
            foreach($product->productImages as $imageFile){
                if(File::exists($imageFile->image))
                 File::delete($imageFile->image);
                $product->productImages()->delete();
        } }
        $product->delete();
        return redirect('/admin/product/view')->with('message','product deleted');     }

    function destroy($id){
        $img = ProductImages::find($id);
        if(File::exists($img->image))
             File::delete($img->image);
        $img->delete();
        return redirect()->back();   }

    function edit($id){ 
        $categories = Category::all();
        $product = Products::find($id);
        return view('admin.products.edit')->with(['categories'=>$categories,'product'=>$product])  ;}

    function update(ProductFormRequest $request, $id){
        $validatedData = $request->validated();
        $product = Products::where('id',$id)->first();
        if($product){
            $product->update([
                'category_id'=>$validatedData['category_id'],
                'name'=>$validatedData['name'],
                'original_price'=>$validatedData['original_price'],
                'selling_price'=>$validatedData['selling_price'],
                'qty'=>$validatedData['qty'],
                'brand'=>$request['brand'],
                'description'=>$request['description'],
                'status'=>$request->status==true ? '1':'0'
            ]);
            if($request->hasFile('image')){
                $uploadPath='uploads/products/';
                $i=1;
                foreach($request->file('image') as $imageFile){
                    $ext = $imageFile->getClientOriginalExtension();          
                    $filename=time().$i++.'.'.$ext;
                    $imageFile->move($uploadPath,$filename);
                    $filepathfordb = $uploadPath.$filename;
                    $product->productImages()->create([
                        'product_id'=>$product->id,
                        'image'=>$filepathfordb
                    ]);
                }  }
        }
       
        return redirect('/admin/product/view')->with('message','product updated');
    
    }
}

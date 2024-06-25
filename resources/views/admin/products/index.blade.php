@extends('layouts.admin')
@section('content')
@if (session('message'))
<div class="alert alert-success" role="alert">
    {{ session('message') }}
</div>
@endif
<div class="card">
    <div class="card-header">
        <h1>View Products   
            <a type="button" class="btn btn-primary float-end" href="{{url('/admin/product/add')}}"  >
                Add Product
        </a> </h1>
    </div>
    <div class="card-body">
       <div  class="table-responsive mb-3"  >
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                   <th>Sr.No</th>
                   <th>Category</th>
                   <th>Name</th>
                   <th>Image</th>
                   <th>selling_price</th>
                   <th>Brand</th>
                   <th>status</th>
                   <th>description</th>
                   <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $key=>$product)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->name}}</td>
                    <td>
                        @if ($product->productImages()->count()>0)
                            <img src="{{asset($product->productImages[0]->image)}}" height='50px' width='50px'/>
                        @endif
                    </td>
                    <td>{{$product->selling_price}}</td>
                    <td>{{$product->brand}}</td>                
                    <td>  @if ($product->status=="1")
                        <span class="badge rounded-pill text-bg-success">Active</span>                       
                        @else
                        <span class="badge rounded-pill text-bg-danger">Inactive</span>  
                        @endif</td>
                    <td>{{$product->description}}</td>
                    <td>
                        <a type="button"  class="btn btn-success me-2"
                        href="{{url('admin/product/edit/'.$product->id)}}"><i class="bi bi-pen"></i> </a>
                        <a type="button"  class="btn btn-danger" onclick="return window.confirm('are you sure you want to delete this??')" href="{{url('admin/product/delete/'.$product->id)}}"><i class="bi bi-trash"></i> </a>
                       

                    </td>
                </tr>
                @empty
                    <tr><td colspan="9">NO product found</td></tr>
                @endforelse
            </tbody>
        </table>
       </div>
       {{$products->links('pagination::bootstrap-5')}}
    </div>
</div>

@endsection
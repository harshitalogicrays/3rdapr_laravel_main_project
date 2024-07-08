@extends('layouts.app')
@section('content')
<div class="container mt-5">
<div class="row">
    <div class="col">
        <div class="row">
        @forelse ($products as $product )
        <div class="col-md-3">
            <div class="product-card">
                <div class="product-card-img">
                    @if ($product->status=='1')
                     <label class="stock bg-success">In Stock</label>
                    @else
                    <label class="stock bg-danger">Out of Stock</label>
                    @endif
                    <a href="{{url('/categories/viewproduct/'.$product->name) }}">
                    <img src="{{asset($product->productImages[0]->image)}}" height='200px' alt="{{$product->name}}">
                    </a>
                </div>
                <div class="product-card-body">
                    <p class="product-brand">{{$product->brand}}</p>
                    <h5 class="product-name">
                       <a href="">
                          {{$product->name}}
                       </a>
                    </h5>
                    <div>
                        <span class="selling-price">${{$product->selling_price}}</span>
                        <span class="original-price">${{$product->original_price}}</span>
                    </div>
                    </div>
            </div>
        </div>
        @empty
            <h1>No product found</h1>
        @endforelse
    </div>  
    </div>
    {{$products->links('pagination::bootstrap-5')}}
</div>
</div>
@endsection

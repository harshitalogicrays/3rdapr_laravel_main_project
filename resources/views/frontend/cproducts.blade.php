@extends('layouts.app')
@section('content')
<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Our Products</h4>
            </div>
        </div>
         <livewire:frontend.cproducts :products="$products" :category="$category"  />
         
        </div>

</div>

@endsection
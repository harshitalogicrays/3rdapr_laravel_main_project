<div class="row">
    <div class="col-3">
        <h4>Sort By:  </h4>
        <div class="card">
            <div class="card-header">Price</div>
            <div class="card-body">
                {{-- <div class="form-check">
                    <input class="form-check-input" type="radio"  value="high-to-low" wire:model="priceInput"/>
                    <label class="form-check-label" for=""> High to Low </label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                       
                         value="low-to-high" wire:model="priceInput"
                    />
                    <label class="form-check-label" for="">
                        Low to High
                    </label>
                </div> --}}
                <input type="radio" value="below1000" wire:model="priceInput" 
                wire:click="filterData('below1000')"> >=100 and < 1000<br>
                <input type="radio"  value="below2000" wire:model="priceInput"   wire:click="filterData('below2000')"> >=1000 and < 2000<br>
                <input type="radio"  value="below3000" wire:model="priceInput"   wire:click="filterData('below3000')"> >=2000 and <= 3000<br>
        
            </div>
        </div>
    </div>
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
            <h1>No product found for {{$category->name}}</h1>
        @endforelse
    </div>  
    </div>
</div>
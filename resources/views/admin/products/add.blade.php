@extends('layouts.admin')
@section('content')
<form enctype="multipart/form-data" action="{{url('/admin/product/add')}}" method="post">
    @csrf
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
      <button class="nav-link" id="nav-details-tab" data-bs-toggle="tab" data-bs-target="#nav-details" type="button" role="tab" aria-controls="nav-details" aria-selected="false">Details</button>
      <button class="nav-link" id="nav-images-tab" data-bs-toggle="tab" data-bs-target="#nav-images" type="button" role="tab" aria-controls="nav-images" aria-selected="false">Images</button>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
        <div class="card p-2">
            <div class="mb-3">
                <label for="" class="form-label">Category</label>
                <select class="form-select"  name="category_id" >
                    <option value='' selected disabled>Select one</option>
                    @foreach ($categories as $c )
                            <option value={{$c->id}}>{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input type="text" name="name"  class="form-control" />
                @error('name')
                <small id="helpId" class="text-danger">{{$message}}</small>
                @enderror
              
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Brand</label>
                <input type="text" name="brand"  class="form-control" />
            </div>
            <div class="form-check-inline">
                <label class="form-check-label me-4" for="">status: </label>
                <input class="form-check-input" type="checkbox" name="status" />              
            </div>       
            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
            </div>
                 
        </div>
    </div>
    <div class="tab-pane fade" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab" tabindex="0">
        <div class="card p-2">
            <div class="mb-3">
                <label for="" class="form-label">Selling Price</label>
                <input type="number" name="selling_price"  class="form-control" />
                @error('selling_price')
                <small id="helpId" class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Oringinal Price</label>
                <input type="number" name="original_price"  class="form-control" />
                @error('original_price')
                <small id="helpId" class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Stock</label>
                <input type="number" name="qty"  class="form-control" />
                @error('qty')
                <small id="helpId" class="text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>

    </div>
    <div class="tab-pane fade" id="nav-images" role="tabpanel" aria-labelledby="nav-images-tab" tabindex="0">
        <div class="card p-2">
            <div class="mb-3">
                <label for="" class="form-label">Choose file</label>
                <input type="file"   class="form-control" name="image[]" multiple/>
            </div>
            <button type="submit"  class="btn btn-primary"> Submit</button>
            
         </div>

    </div>
  </div>
</form>
@endsection
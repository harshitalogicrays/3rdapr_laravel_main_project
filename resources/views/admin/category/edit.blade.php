@extends('layouts.admin')
@section('content')
<div class="container col-10">
    <div class="card">
        <div class="card-header">
            <h1>edit category 
                <a type="button" class="btn btn-danger float-end" href="{{url('/admin/category/view')}}"  >
                    View Categories
                </a>
                
            </h1>
        </div>
        <div class="card-body">
            <form method='post' action="{{'/admin/category/update/'.$category->id}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text"  name="name"  value="{{$category->name}}" class="form-control" />
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Image</label>
                    <input type="file"  name="image"  class="form-control" />
                    @if ($category->image)
                        <img src="{{asset($category->image)}}" height="70px" width='70px' class="mt-2"/>
                    @endif
                     </div>
                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <textarea  name="description"  class="form-control">{{$category->description}}</textarea>
                </div>
                <div class="form-check-inline">            
                    <label class="form-check-label" for=""> status </label>
                    <input class="form-check-input" type="checkbox" name="status"
                    {{$category->status=='0'?'checked':''}}/>  
                </div><br/> 
                <button type="submit" class="btn btn-primary mt-3">
                    Update
                </button>
                           
            </form>
        </div>
    </div>
</div>
@endsection
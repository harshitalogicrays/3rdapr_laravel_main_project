@extends('layouts.admin')
@section('content')
<div class="container col-10">
    <div class="card">
        <div class="card-header">
            <h1>Add category 
                <a type="button" class="btn btn-danger float-end" href="{{url('/admin/category/view')}}"  >
                    View Categories
                </a>
                
            </h1>
        </div>
        <div class="card-body">
            <form method='post' action="{{'/admin/category/add'}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text"  name="name"  class="form-control" />
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Image</label>
                    <input type="file"  name="image"  class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <textarea  name="description"  class="form-control"></textarea>
                </div>
                <div class="form-check-inline">            
                    <label class="form-check-label" for=""> status </label>
                    <input class="form-check-input" type="checkbox" name="status"/>  
                </div><br/> 
                <button type="submit" class="btn btn-primary mt-3">
                    Submit
                </button>
                           
            </form>
        </div>
    </div>
</div>
@endsection
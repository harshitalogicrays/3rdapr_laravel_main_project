@extends('layouts.admin')
@section('content')
@if (session('message'))
<div class="alert alert-success" role="alert">
    {{ session('message') }}
</div>
@endif
<div class="card">
    <div class="card-header">
        <h1>View categories   
            <a type="button" class="btn btn-primary float-end" href="{{url('/admin/category/add')}}"  >
                Add Category
        </a> </h1>
    </div>
    <div class="card-body">
       <div  class="table-responsive mb-3"  >
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                   <th>Sr.No</th>
                   <th>NAme</th>
                   <th>Image</th>
                   <th>status</th>
                   <th>description</th>
                   <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as  $k=>$c)
                <tr class="">
                    <td scope="row">{{$k+1}}</td>
                    <td>{{$c->name}}</td>
                    <td><img src="{{asset($c->image)}}" height="50px" width="50px"></td>
                    <td scope="row">
                        @if ($c->status=="0")
                        <span class="badge rounded-pill text-bg-success">Active</span>                       
                        @else
                        <span class="badge rounded-pill text-bg-danger">Inactive</span>  
                        @endif

                    </td>
                    <td>{{$c->description}}</td>
                    <td>
                        <a type="button"  class="btn btn-success me-2"
                        href="{{url('admin/category/edit/'.$c->id)}}"><i class="bi bi-pen"></i> </a>
                        <a type="button"  class="btn btn-danger" onclick="return window.confirm('are you sure you want to delete this??')" href="{{url('admin/category/delete/'.$c->id)}}"><i class="bi bi-trash"></i> </a>
                       
                    </td>
                </tr>
                @empty
                  <tr><td colspan="6">No Category found</td></tr>  
                @endforelse
              
            </tbody>
        </table>
       </div>
       {{$categories->links('pagination::bootstrap-5')}}
    </div>
</div>

@endsection
@extends('layouts.app')
@section('content')
   @include('frontend.slider',['sliders'=>App\Models\Admin\Slider::where('status','1')->get()])

   <div class="container mt-5">
      <h1 class="text-center">---------------------Categories---------------------</h1>
      <div class="row">
         @forelse ($categories as $c)
         <div class="col-3">
            <div class="card mt-3 mb-3">
               <a href="{{url('/categories/cproducts/'.$c->name)}}">
               <img class="card-img-top" src="{{asset($c->image)}}" alt="Title" height='200px'/></a>
               <div class="card-body">
                  <h4 class="card-title">{{$c->name}}</h4>
                  <p class="card-text">{{$c->description}}</p>
               </div>
              
            </div>
         </div>
         @empty
            <h3>No Category Found</h3>
         @endforelse
       
      </div>
     
   
   </div>
@endsection
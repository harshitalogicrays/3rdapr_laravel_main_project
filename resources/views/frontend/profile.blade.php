@extends('layouts.app')
@section('content')
<div class="container mt-5">
    @if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
    @endif
</div>

    <div class="container mt-5 shadow p-3">
        <div class="card">
            <div class="card-header">
                <h1>Profile 
                <a type="button" class="btn btn-primary btn-lg float-end" href="{{url('changepassword')}}"> Change Password   </a>
                
                </h1> 
            </div>
            <div class="card-body">
                <form action="{{url('saveprofile')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" id="name"  class="form-control" placeholder="Enter Name"  value="{{Auth::user()->name}}"/>
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                             @enderror
                        </div>
                       
                        <div class="col-md-6 mb-3">
                            <label>Phone Number</label>
                            <input type="number" name="phone" id="phone"  class="form-control" placeholder="Enter Phone Number" value="{{Auth::user()->userDetail->phone ?? ''}}" />
                            @error('phone')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label>Email Address</label>
                            <input type="email" name="email" id="email"   readonly  value="{{Auth::user()->email}}"class="form-control" placeholder="Enter Email Address" />
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                             @enderror
                        </div>
                     
                        <div class="col-md-6 mb-3">
                            <label>Pin-code (Zip-code)</label>
                            <input type="number" name="pincode" id="pincode"  value="{{Auth::user()->userDetail->pincode ?? ''}}" class="form-control" placeholder="Enter Pin-code" />
                            @error('pincode')
                            <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                       
                        <div class="col-md-12 mb-3">
                            <label>Full Address</label>
                            <textarea name="address" id="address"   class="form-control" rows="2">{{Auth::user()->userDetail->address ?? ''}}</textarea>
                           @error('address')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                        </div>
                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Submit
                        </button>
                        
                </form>
            </div>
        </div>
        
    </div>
@endsection
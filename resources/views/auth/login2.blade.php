@extends('layouts.formMain')
@section('content')
<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row"> <img src="{{ url('/images/logo.png') }}" style = "top:0;left:0;height: 30%;" class="logo"> </div>
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="{{ url('/images/login2.jpg') }}" class="image"> </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                    <div class="row mb-4 px-3">
                        <h2 class="mb-0 mr-4 mt-2">Log In</h2>
                    </div>
                    @if ($errors->any())
<div class="alert alert-danger alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <p>{{ $message }}</p>
                        </div>
                    @endif
                    <small>Please fill this form to log in. </small>
                    <div class="row px-3 mb-4">

                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                   <form action="{{ route('loginStore') }}"  method="post">
                   {!! csrf_field() !!}
                    <div class="row px-3"> <label class="mb-1">
                            <h6 class="mb-0 text-sm">Email Address</h6>
                        </label> <input class="mb-4" type="text" name="email" placeholder="Enter a valid email address"> </div>
                    <div class="row px-3"> <label class="mb-1">
                            <h6 class="mb-0 text-sm">Password</h6>
                        </label> <input type="password" name="password" placeholder="Enter password"> </div>
                        <div class="row" style ="margin: 5% 0% 0% -5%">
                        <div class="custom-control custom-checkbox custom-control-inline">  <button  type="submit" class="btn btn-blue text-center">Login</button> </div> <a href="{{url('/forgetPassword')}}" tagert= "_blank" class="ml-auto mb-0 text-sm">Forgot Password?</a>
                        </div>
                </div>
            </div>
        </div>
        </form>
        <div class="bg-blue py-4 " style ="background-color:#242459;">
            <div class="row px-3" > <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; {{ $date->year}}. All rights reserved.</small>
                <div class="social-contact ml-4 ml-sm-auto"> <span class="fa fa-facebook mr-4 text-sm"></span> <span class="fa fa-google-plus mr-4 text-sm"></span> <span class="fa fa-linkedin mr-4 text-sm"></span> <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span> </div>
            </div>
        </div>
    </div>
@stop

@extends('layouts.formMain')
@section('content')
<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-5">
                <div class="card1 pb-5">
                    <div class="row"> <img src="{{ url('/images/logo.png') }}" style = "top:0;left:0;height: 30%;" class="logo"> </div>
                 <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="{{ url('/images/register.jpg') }}" class="image"> </div>
                   </div>
            </div>
            <div class="col-lg-7">
                <div class="card2 card border-0 px-4 py-5">
                    <div class="row mb-4 px-3">
                        <h2 class="mb-0 mr-4 mt-2">Register User</h2>
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
                    @if (Session('message'))
                        <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <p>{{ session('message') }}</p>
                        </div>
                    @endif
                    @if (Session('success'))
                        <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    <small>Please fill this form to create an account. </small>
                    <div class="row px-3 mb-4">

                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                   <form  class="row g-3" action="{{ route('registerStore')}}"  method="post">
                   {!! csrf_field() !!}
                   <div class="col-md-3">
                    <label for="Title" class="form-label">Title</label>
                    <select class=" form-control form-select form-select-lg mb-1 h-50" value = "{{ old('title')}}" required name = "title" aria-label=".form-select-lg example">
                <option value="" selected disabled>None</option>
                <option value="Mr.">Mr.</option>
                <option value="Mrs.">Mrs.</option>
                <option value="Ms.">Ms.</option>
                <option value="Dr."> Dr.</option>
                <option value="Esq.">Esq.</option>
                <option value="Hon.">Hon.</option>
                <option value="Jr.">Jr.</option>
                <option value="Msgr.">Msgr.</option>
                <option value="Prof.">Prof.</option>
                <option value="Rev.">Rev.</option>
                <option value="Rt. Hon.">Rt. Hon.</option>
                <option value="Sr.">Sr.</option>
                <option value="St.">St.</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="Name" class="form-label">Name</label>
                    <input type="text" name = "name" placeHolder = "John" class="form-control" id="name" value = "{{ old('name')}}"  required>
                </div>
                <div class="col-md-5">
                    <label for="surname" class="form-label">Surname</label>
                    <input type="text" placeHolder = "example" name = "surname" value = "{{ old('surname')}}"  class="form-control" id="surname"  required >
                </div>
                <div class="col-md-4">
                    <label for="surname" class="form-label">Id No.</label>
                    <input type="text" placeHolder = "2303300876089" name = "id_no"  value = "{{ old('id_no')}}" class="form-control" id="id_no" required>
                </div>
                <div class="col-md-3">
                    <label for="Name" class="form-label">Gender</label>
                    <select  name ="gender" class=" form-control form-select form-select-lg mb-1 h-50" value = "{{ old('gender')}}" required aria-label=".form-select-lg example">
                        <option value ="" selected disabled>None</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email"  placeHolder = "john.example@ictchoice.co.za" value = "{{ old('email')}}" name = "email" class="form-control" id="Email" required>
                </div>
                <div class="col-md-4">
                    <label for="surname" class="form-label">Mobile Number</label>
                    <input type="text" placeHolder = "0123456789" name = "phone"  value = "{{ old('phone')}}" class="form-control" id="phone"  pattern="[0-9]{10}" required>
                </div>
                <div class="col-md-3">
                    <label for="Name" class="form-label">Communication</label>
                    <select  name ="communication" class=" form-control form-select form-select-lg mb-1 h-50" value = "{{ old('communication')}}" required aria-label=".form-select-lg example">
                        <option value ="" selected disabled>None</option>
                        <option value="Email">Email</option>
                        <option value="SMS">SMS</option>
                        <option value="Both">Both</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="apointment_date" class="form-label">Apointment date</label>
                    <input type="date"  name = "apointment_date"  value = "{{ old('apointment_date')}}" class="form-control" id="apointment_date" required>
                </div>
                <div class="col-md-3">
                    <label for="department" class="form-label">Department</label>
                    <select name = "department" class=" form-control form-select form-select-lg mb-1 h-50"  value = "{{ old('department')}}" required aria-label=".form-select-lg example">
                <option value ="" selected disabled>None</option>
                @foreach ($dep as $item)
                <option value="{{ $item->name }}"> {{$item->name}}</option>
                @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="apointment_date" class="form-label">Job title</label>
                    <input type="text"  name = "job_title"  value = "{{ old('job_title')}}" class="form-control" id="job_title" required>
                </div>
            <div class="col-md-3">
                    <label for="Name" class="form-label">Register As</label>
                    <select name = "role" class=" form-control form-select form-select-lg mb-1 h-50" value = "{{ old('role')}}" required aria-label=".form-select-lg example">
                        <option selected disabled>None</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                        <option value="department-head">Department-head</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="surname" class="form-label">Location</label>
                    <input type="text" placeHolder = "East London, Eastern Cape" name = "location"  value = "{{ old('location')}}" class="form-control" id="location"   required>
                </div>
                <div class="col-md-1">
                     <input type="checkbox" class="form-check-input" required>
               </div>
                <div class="col-md-11">
                <small class="form-check-label" for="materialIndeterminate2">To the best of my knowledge, the information I have provided is true and full. I understand that this self-declaration statement will be reviewed and verified, and that if any of the information is false, I may be fired from ICT Choice for fraud and/or perjury.</small>
                </div>
                        <div class="row" style ="margin: 5% 0% 0% -5%">
                        <div class="custom-control custom-checkbox custom-control-inline">  <button  type="submit" class="btn btn-blue text-center">Register</button> </div> <a href="{{ route('dashboard')}}"><button type="button" class="btn back">Back</button><a>
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

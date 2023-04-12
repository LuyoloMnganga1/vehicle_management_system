@extends('layouts.main')
@section('title')
Booking Entry
@endsection
@section('content')

<h3 class="display-4">Vehicle Booking</h3>

<div class="card">
    <div class="card-header text-center" style="background-color: navy; color: white">
        <h2 style="color: white">Booking Details</h2>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3 row">
              <label for="staticEmail" class="col-sm-2 col-form-label">Full Name</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="name" readonly value="{{ Auth::user()->name }} {{ Auth::user()->surname }}">
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">Email Address</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="email" readonly value="{{ Auth::user()->email }} ">
                </div> 
                
            </div>
            <div class="mb-3 row">
                
                <label for="staticEmail" class="col-sm-2 col-form-label">Booking Date </label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="date" class="form-control" id="trip_start_date" name="trip_start_date">
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">Returning Date</label>
              <div class="input-group input-group-sm col-sm-4">
                  <input type="date" class="form-control" id="return_date" name="return_date">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="staticEmail" class="col-sm-2 col-form-label">Destination</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="destination" name="destination">
                </div>
              <label for="staticEmail" class="col-sm-2 col-form-label">Available Vehicles</label>
              <select class="form-control form-control-sm col-sm-4">
                  <option>Select Available Vehicles</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
              </select>
              
          </div>
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <label for="exampleFormControlTextarea1" class="form-label">Trip Details</label>
                    <textarea type="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>

            </div>

            <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="fa fa-plus"></i> Add New</button>
        </form>

    </div>
</div>
<br>

@endsection
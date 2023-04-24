@extends('layouts.main')
@section('title')
Log  Book
@endsection
@section('content')

<h3 class="display-4">Log Book</h3>

<div class="card">
    <div class="card-header text-center" style="background-color: navy; color: white">
        <h2 style="color: white">Basic Trip Details</h2>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3 row">
               
                <label for="staticEmail" class="col-sm-2 col-form-label">Registration Number</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" name="vehicle_id" id="registration_no" readonly value="{{$reg_no}}">
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">Full Name</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="full_name" name="full_name" readonly value="{{ Auth::user()->name }} {{ Auth::user()->surname }}">
                </div>
            </div>
            <div class="mb-3 row">
               
                <label for="staticEmail" class="col-sm-2 col-form-label">Date Time Out</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="date" class="form-control" id="trip_start_date" name="trip_start_date">
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">Date Time In</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="trip_end_date" name="trip_end_date">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Odometer</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="odometer" name="odometer">
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">Kilometers</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="date" class="form-control" id="kilometers" name="kilometers">
                </div>
            </div>
           
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">From</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="inputPassword" name="destination_start">
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">To</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="inputPassword" name="destination_end">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <label for="exampleFormControlTextarea1" class="form-label">Trip Details</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="trip_details"></textarea>
                </div>

            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Petrol (L)</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="petrol" name="petrol">
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">Oil (ML)</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="oil" name="oil">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <label for="exampleFormControlTextarea1" class="form-label">Trip Comments (Remarks, Accidents etc.)</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="start_comment"></textarea>
                </div>

            </div>

            <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="fa fa-plus"></i> Add New Trip</button>
        </form>

    </div>
    <div class="card-footer text-center" style="background-color: navy; color: white">
        <h2 style=" color: white"> Return Trip Details</h2>
    </div>
    <div class="card-body">
        <form action="" method="post">
           
            <div class="mb-3 row">
               
                <label for="staticEmail" class="col-sm-2 col-form-label">Date Time Out</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="date" class="form-control" id="return_date_out" name="return_date_out">
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">Date Time In</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="return_date_in" name="return_date_in">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Odometer</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="return_odometer" name="return_odometer">
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">Kilometers</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="date" class="form-control" id="return_kilometers" name="return_kilometers">
                </div>
            </div>
           
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">From</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="inputPassword" name="return_destination_start">
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">To</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="inputPassword" name="return_destination_end">
                </div>
            </div>
           
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Petrol (L)</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="petrol" name="petrol">
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">Oil (ML)</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="return_oil" name="return_oil">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <label for="exampleFormControlTextarea1" class="form-label">Return Trip Comments (Remarks, Accidents etc.)</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="return_comment"></textarea>
                </div>

            </div>

            <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="fa fa-plus"></i>Add Trip Return </button>
        </form>
    </div>
</div>
<br>


@endsection
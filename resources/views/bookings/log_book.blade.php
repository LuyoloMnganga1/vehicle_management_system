@extends('layouts.main')
@section('title')
Log  Book
@endsection
@section('content')

<div class="card">
    <div class="card-header text-center" style="background-color: #18345D; color: white">
        <h2 style="color: white">Basic Trip Details</h2>
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
     @if($loogbook == null && $loog != null) 
    <div class="card-body">
        <form action="{{ route('add-log-book') }}" method="post">
            @csrf
            <div class="mb-3 row">
               
                <label for="staticEmail" class="col-sm-2 col-form-label">Registration Number</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" name="vehicle_id" id="registration_no" readonly value="{{$reg_no}}">
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">Full Name</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="full_name" name="full_name" readonly value="{{ $loog->full_name }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Date Time Out</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="datetime-local" class="form-control" id="trip_start_date" name="trip_start_date" required>
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label"> Destination Date Time In</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="datetime-local" class="form-control" id="trip_end_date" name="trip_end_date" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Odometer</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="number" class="form-control" id="odometer" min="0" name="start_odometer" required>
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">Estimated Kilometers</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="number" min="0" class="form-control" id="kilometers" name="kilometers" required>
                </div>
            </div>
           
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">From</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="inputPassword" name="destination_start" required>
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">To</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="inputPassword" name="destination_end" required>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <label for="exampleFormControlTextarea1" class="form-label">Trip Details</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="trip_details" required></textarea>
                </div>

            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Petrol (L)</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="number" min="0" class="form-control" id="petrol" name="petrol">
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">Oil (ML)</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="number" min="0" class="form-control" id="oil" name="oil">
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
</div>
    @elseif($loogbook != null)
    @if($loogbook->return_date_out == null) 
    <div class="card mt-5">
    <div class="card-header text-center" style="background-color: #18345D; color: white">
        <h2 style=" color: white"> Return Trip Details</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('return-log-book') }}" method="post">
            @csrf
            <div class="mb-3 row">
               <input type="hidden" name="rowID" value="{{ $loogbook->id }}">
                <label for="staticEmail" class="col-sm-2 col-form-label">Date Time Out</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="datetime-local" class="form-control" id="return_date_out" name="return_date_out">
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">Date Time In</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="datetime-local" class="form-control" id="return_date_in" name="return_date_in">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Final Odometer</label>
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
                    <input type="text" class="form-control" id="petrol" name="return_petrol">
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
@else
<h1 class="text-center mt-5 mb-5">Sorry you haven't made any vehicle booking.</h1>  
@endif
@endif
<br>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        var min = new Date().toISOString().slice(0,new Date().toISOString().lastIndexOf(":"));
        $('#return_date_out').attr('min',min);

        $('#return_date_out').on('change', function(){
            var end_min = new Date($(this).val()).toISOString().slice(0,new Date().toISOString().lastIndexOf(":"));
            $('#return_date_in').attr('min',end_min);
        });
    });
</script>
<script>
    $(document).ready(function () {
        var min = new Date().toISOString().slice(0,new Date().toISOString().lastIndexOf(":"));
        $('#trip_start_date').attr('min',min);

        $('#trip_start_date').on('change', function(){
            var end_min = new Date($(this).val()).toISOString().slice(0,new Date().toISOString().lastIndexOf(":"));
            $('#trip_end_date').attr('min',end_min);
        });
    });
</script>
@endsection
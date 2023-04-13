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
        <form action="{{route('book')}}" method="post">
          {!! csrf_field() !!}

            <div class="mb-3 row">
              <label for="staticEmail" class="col-sm-2 col-form-label">Full Name</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="name" name="full_name" readonly value="{{ Auth::user()->name }} {{ Auth::user()->surname }}">
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">Email Address</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="email" readonly value="{{ Auth::user()->email }} " name="email">
                </div> 
                
            </div>
            <div class="mb-3 row">
                
                <label for="staticEmail" class="col-sm-2 col-form-label">Booking Date </label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="datetime-local" class="form-control" id="trip_start_date" name="trip_start_date">
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">Returning Date</label>
              <div class="input-group input-group-sm col-sm-4">
                  <input type="datetime-local" class="form-control" id="return_date" name="return_date">
              </div>
            </div>
            <div class="mb-3 row">
                @php
                    $vehicle = App\Models\Vehicle::orderBy('Registration_no', 'ASC')->get();
                @endphp
              <label for="staticEmail" class="col-sm-2 col-form-label">Destination</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="destination" name="destination">
                </div>
              <label for="staticEmail" class="col-sm-2 col-form-label">Available Vehicles</label>
              <select class="form-control form-control-sm col-sm-4" name="vehicle_id">
                  <option>Select Available Vehicles</option>
                  @foreach($vehicle as $item )
                    <option value="{{ $item->id }}">{{ $item->Registration_no }}</option>
                  @endforeach
              </select>
              
          </div>
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <label for="exampleFormControlTextarea1" class="form-label">Trip Details</label>
                    <textarea type="text" name="trip_datails" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>

            </div>

            <button type="submit" class="btn btn-primary btn-sm" ><i class="fa fa-plus"></i> Add New</button>
        </form>

    </div>
</div>
<br>

@endsection
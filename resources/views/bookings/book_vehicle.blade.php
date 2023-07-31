@extends('layouts.main')
@section('title')
Booking Entry
@endsection
@section('content')
<div class="card">
    <div class="card-header text-center" style="background-color: #18345D; color: white">
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
              <label for="staticEmail" class="col-sm-2 col-form-label">Destination</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="destination" name="destination">
                </div>
              <label for="staticEmail" class="col-sm-2 col-form-label">Available Vehicles</label>
              <select class="form-control form-control-sm col-sm-4" name="vehicle_id" id="vehicle_id">
                <option value="" selected disabled>Select Available Vehicles</option>
              </select>
          </div>
          <div class="mb-3 row">
            <label for="" class="col-sm-2 col-form-label">Driver</label>
            <select class="form-control form-control-sm col-sm-4" name="driver" id="driver"  required>
                @php
                        $Drivers = App\Models\User::join('drivers', 'users.id', '=', 'drivers.user_id')->select('users.name', 'users.surname','users.id')->get();
                @endphp
                <option value="none">None</option>
                @foreach($Drivers as $driver)
                <option value="{{ $driver->name }} {{ $driver->surname }}">{{ $driver->name }} {{ $driver->surname }}</option>
                @endforeach
            </select>
          </div>
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <label for="exampleFormControlTextarea1" class="form-label">Trip Details</label>
                    <textarea type="text" name="trip_datails" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-sm" ><i class="fa fa-plus"></i> Book vehicle</button>
        </form>

    </div>
</div>
<br>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        var min = new Date().toISOString().slice(0,new Date().toISOString().lastIndexOf(":"));
        $('#trip_start_date').attr('min',min);

        $('#trip_start_date').on('change', function(){
            var end_min = new Date($(this).val()).toISOString().slice(0,new Date().toISOString().lastIndexOf(":"));
            $('#return_date').attr('min',end_min);
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#return_date').on('change', function(){
            var enddate = $(this).val();
            var startdate = $('#trip_start_date').val();
            url  = "{{ route('find_available_car',['start'=>':start','end'=>':end']) }}";
            url = url.replace(':start',startdate);
            url = url.replace(':end',enddate);
            $.get(url, function(data){
                    $('#vehicle_id').empty();
                    $('#vehicle_id').append( '<option value="" selected disabled>Select Available Vehicles</option>');
                $.each(data, function(index, value) {
                    $('#vehicle_id').append( '<option value=\"' + value.id + '\">' + value.Registration_no + '</option>' );
                });
            });
        })
    });
</script>
@endsection
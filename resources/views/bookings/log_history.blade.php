@extends('layouts.main')
@section('title')
Booking History
@endsection
@section('content')
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-header-text">
            <div class="row">
                <div class="col-md-10">
                    <h4 class="card-title">List of Vehicle Logs</h4>
                </div>
                <div class="col-md-2">
                    <a  class="btn btn-primary btn-sm" href="{{route('log-book')}}"> <i class="fa fa-plus"></i> Log Book</a>
                </div>
            </div>
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
        <div class="card-content table-responsive">
            <table class="table table-hover data-table" style="width: 100%;">
                <thead class="text-light bg bg-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Booking Date</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Vehicle</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
           
        </div>
    </div>
</div>

<!-- Update Invoice Modal -->
<div class="modal fade" id="updateBooking" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  action="" id="update_booking_form" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
    

                    <div class="mb-3 row">
                
                        <label for="staticEmail" class="col-sm-2 col-form-label">Full Name </label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="text" class="form-control" id="update_full_name" name="full_name" readonly value="{{ Auth::user()->name }} {{ Auth::user()->surname }}">
                        </div>
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email Address</label>
                      <div class="input-group input-group-sm col-sm-4">
                        <input type="text" class="form-control" id="update_email" readonly value="{{ Auth::user()->email }} " name="email">
                        </div>
                    </div>
                    <div class="mb-3 row">
            
                        <label for="staticEmail" class="col-sm-2 col-form-label">Booking Date </label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="date" class="form-control" id="update_trip_start_date" name="trip_start_date">
                        </div>
                        <label for="staticEmail" class="col-sm-2 col-form-label">Returning Date</label>
                      <div class="input-group input-group-sm col-sm-4">
                          <input type="date" class="form-control" id="update_return_date" name="return_date">
                      </div>
                    </div>
                    <div class="mb-3 row">
                        @php
                            $vehicle = App\Models\Vehicle::orderBy('Registration_no', 'ASC')->get();
                        @endphp
                      <label for="staticEmail" class="col-sm-2 col-form-label">Destination</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="text" class="form-control" id="update_destination" name="destination">
                        </div>
                      <label for="staticEmail" class="col-sm-2 col-form-label">Available Vehicles</label>
                      <input type="hidden" name="vehicle_id" id="update_vehicle_id">
                      <select  id="update_reg_no" class="form-control col-sm-4" required>
                        <option value="" disabled selected id="update_vehicle_id_placeholder"></option>
                        @foreach($vehicle as $item )
                            <option value="{{ $item->id }}">{{ $item->Registration_no }}</option>
                        @endforeach
                    </select>
                      
                  </div>
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Trip Details</label>
                        <textarea type="text"  class="form-control" id="update_trip_details" value="trip_datails" name="trip_datails" rows="3"></textarea>
                    </div>
                    <div style="margin-top: 5%">
                        <button type="submit" id="saveBtn" class="btn btn-primary">Update Booking</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
    
                </form>
              
            </div>

        </div>
    </div>
</div>
{{-- end Update modal --}}

@endsection
@extends('layouts.main')
@section('title')
Booking History
@endsection
@section('content')
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-header-text mb-2">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-title">List of Bookings</h4>
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
                        <th scope="col">Booker</th>
                        <th scope="col">Booking Date</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Vehicle</th>
                        <th scope="col">Driver</th>
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
                            <input type="text" class="form-control update_info" id="update_full_name" name="full_name" readonly>
                        </div>
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email Address</label>
                      <div class="input-group input-group-sm col-sm-4">
                        <input type="text" class="form-control update_info" id="update_email" readonly name="email">
                        </div>
                    </div>
                    <div class="mb-3 row">
            
                        <label for="staticEmail" class="col-sm-2 col-form-label">Booking Date </label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="date" class="form-control update_info" id="update_trip_start_date" name="trip_start_date">
                        </div>
                        <label for="staticEmail" class="col-sm-2 col-form-label">Returning Date</label>
                      <div class="input-group input-group-sm col-sm-4">
                          <input type="date" class="form-control update_info"  id="update_return_date" name="return_date">
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Destination</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="text" class="form-control update_info" id="update_destination" name="destination">
                        </div>
                      <label for="staticEmail" class="col-sm-2 col-form-label">Available Vehicles</label>
                      <input  type="text" id="update_vehicle_id"  name="vehicle_id" class="form-control col-sm-4 update_info" readonly>                      
                  </div>
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Trip Details</label>
                        <textarea type="text"  class="form-control update_info" id="update_trip_details"  name="trip_datails" rows="3"></textarea>
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

@section('scripts')

<script>
    $(function () {
      
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax:"{{route('booking.list')}}",
          columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                print: true,
                className: 'text-center'
            },
            {
                data: 'full_name',
                name: 'full_name',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'trip_start_date',
                name: 'trip_start_date',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'destination',
                name: 'destination',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'vehicle_plate',
                name: 'vehicle_plate',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },  
            {
                data: 'driver',
                name: 'driver',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },  
            {
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false,
            },
          ]
      });
      
    });
  </script>

<script>
    /* edit booking */
    $('body').on('click', '.edit', function () {
       var booking_id = $(this).data('id');
       var url = "{{ route('update-Booking', ['id'=> ':id' ]) }}";
        url = url.replace(':id', booking_id);
       $.get('find/booking/' + booking_id, function (data) {
           $('#booking_id').val(data.id);
           $('#update_full_name').val(data.full_name);
           $('#update_email').val(data.email);
           $('#update_trip_start_date').val(data.trip_start_date);
           $('#update_return_date').val(data.return_date);
           $('#update_destination').val(data.destination);
           $('#update_vehicle_id').val(data.vehicle_plate);
           $('textarea#update_trip_details').val(data.trip_datails);
           $('#update_booking_form').attr('action',url);
           $('#updateBooking').modal('show');
       })
   });

     /*delete  booking */
     $('body').on('click', '#delete', function() {
          $('#delete_record').modal('show');
          $('#yes').on('click',function(){
              var url= '/delete-Booking/' + $('#delete').data('id');
              location.href = url;
          })
       });



    

 </script>

@endsection
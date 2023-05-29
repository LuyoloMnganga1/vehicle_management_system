@extends('layouts.main')
@section('title')
Booking History
@endsection
@section('content')
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-header-text mb-5">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-title">List of Vehicle Logs</h4>
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
                <tfoot>
                </tfoot>
            </table>
           
        </div>
    </div>
</div>

<!-- Update Invoice Modal -->
<div class="modal fade" id="update_logbook_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Update logbook Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Basic Trip Details</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"> Return Trip Details</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active p-5" id="home" role="tabpanel" aria-labelledby="home-tab">
                <form action="{{ route('add-log-book') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <input type="hidden" name="rowID"  id="rowID_second" class="update_info">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Registration Number</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="text" class="form-control update_info" name="vehicle_id" id="registration_no" readonly>
                        </div>
                        <label for="staticEmail" class="col-sm-2 col-form-label">Full Name</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="text" class="form-control update_info" id="full_name" name="full_name" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Date Time Out</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="datetime-local" class="form-control update_info" id="trip_start_date" name="trip_start_date" required>
                        </div>
                        <label for="staticEmail" class="col-sm-2 col-form-label"> Destination Date Time In</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="datetime-local" class="form-control update_info" id="trip_end_date" name="trip_end_date" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Odometer</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="number" class="form-control update_info" id="start_odometer" min="0" name="start_odometer" required>
                        </div>
                        <label for="staticEmail" class="col-sm-2 col-form-label">Estimated Kilometers</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="number" min="0" class="form-control update_info" id="kilometers" name="kilometers" required>
                        </div>
                    </div>
                   
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">From</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="text" class="form-control update_info" id="destination_start" name="destination_start" required>
                        </div>
                        <label for="staticEmail" class="col-sm-2 col-form-label">To</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="text" class="form-control update_info" id="destination_end" name="destination_end" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-12">
                            <label for="exampleFormControlTextarea1" class="form-label">Trip Details</label>
                            <textarea class="form-control update_info" id="trip_details" rows="3" name="trip_details" required></textarea>
                        </div>
        
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Petrol (L)</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="number" min="0" class="form-control update_info" id="petrol" name="petrol">
                        </div>
                        <label for="staticEmail" class="col-sm-2 col-form-label">Oil (ML)</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="number" min="0" class="form-control update_info" id="oil" name="oil">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-12">
                            <label for="exampleFormControlTextarea1" class="form-label">Trip Comments (Remarks, Accidents etc.)</label>
                            <textarea class="form-control update_info" id="start_comment" rows="3" name="start_comment"></textarea>
                        </div>
        
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Save Changes</button>
                </form>
            </div>
            <div class="tab-pane fade p-5" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <form action="{{ route('return-log-book') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                       <input type="hidden" name="rowID"  id="rowID" class="update_info">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Date Time Out</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="datetime-local" class="form-control update_info" id="return_date_out" name="return_date_out">
                        </div>
                        <label for="staticEmail" class="col-sm-2 col-form-label">Date Time In</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="datetime-local" class="form-control update_info" id="return_date_in" name="return_date_in">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Final Odometer</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="text" class="form-control update_info" id="return_odometer" name="return_odometer">
                        </div>
                        <label for="staticEmail" class="col-sm-2 col-form-label">Kilometers</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="number" min="0" class="form-control update_info" id="return_kilometers" name="return_kilometers">
                        </div>
                    </div>
                   
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">From</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="text" class="form-control update_info" id="return_destination_start" name="return_destination_start">
                        </div>
                        <label for="staticEmail" class="col-sm-2 col-form-label">To</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="text" class="form-control update_info" id="return_destination_end" name="return_destination_end">
                        </div>
                    </div>
                   
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Petrol (L)</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="text" class="form-control update_info" id="return_petrol" name="return_petrol">
                        </div>
                        <label for="staticEmail" class="col-sm-2 col-form-label">Oil (ML)</label>
                        <div class="input-group input-group-sm col-sm-4">
                            <input type="text" class="form-control update_info" id="return_oil" name="return_oil">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-12">
                            <label for="exampleFormControlTextarea1" class="form-label">Return Trip Comments (Remarks, Accidents etc.)</label>
                            <textarea class="form-control update_info" id="return_comment" rows="3" name="return_comment"></textarea>
                        </div>
        
                    </div>
        
                    <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Save Changes</button>
                </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
          ajax:"{{route('get-log-histroy')}}",
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
                data: 'destination_end',
                name: 'destination_end',
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
        $('.update_info').empty();
       var log_id = $(this).data('id');
       $('#rowID').val(log_id);
       $('#rowID_second').val(log_id);
       $.get('findlogDetails/' + log_id, function (data) {
        console.log(data);
            // basic details
           $('#registration_no').val(data.vehicle_place);
           $('#full_name').val(data.full_name);
           $('#trip_start_date').val(data.trip_start_date);
           $('#trip_end_date').val(data.trip_end_date);
           $('#start_odometer').val(data.start_odometer);
           $('#kilometers').val(data.kilometers);
           $('#destination_start').val(data.destination_start);
           $('#destination_end').val(data.destination_end);
           $('textArea#trip_details').val(data.trip_details);
           $('#petrol').val(data.petrol);
           $('#oil').val(data.oil);
           $('textArea#start_comment').val(data.start_comment);
            //end fo base details
            //return trip details
            $('#return_date_out').val(data.return_date_out);
            $('#return_date_in').val(data.return_date_in);
            $('#return_odometer').val(data.return_odometer);
            $('#return_kilometers').val(data.return_kilometers);
            $('#return_destination_start').val(data.return_destination_start);
            $('#return_destination_end').val(data.return_destination_end);
            $('#return_petrol').val(data.return_petrol);
            $('#return_oil').val(data.return_oil);
            $('textArea#return_comment').val(data.return_comment);
            //end of return details
            $('#update_logbook_modal').modal('show');
       })
   });

     /*delete  booking */
     $('body').on('click', '#delete', function() {
          $('#delete_record').modal('show');
          $('#yes').on('click',function(){
              var url= '/ddeleloginfo/' + $('#delete').data('id');
              location.href = url;
          })
       });
 </script>

@endsection
@extends('layouts.main')
@section('title')
Dashboard
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card" style="border: 5px solid #18345D;border-radius: 10px;">
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="card-body" >
                    <span class="pull-right clickable close-icon" data-effect="fadeOut"><i class="fa fa-times"></i></span>
                    <h6 style="margin-bottom: 0.5%;" class="card-title">Welcome Back</h6>
                    <h4>{{ Auth::user()->name }} {{ Auth::user()->surname }}</h4>
                    <p style="margin-top: 1%;" class="card-text">ICT Choice strives for service excellence and being the preferred provider of choice for innovative information and communication technology solutions and services.</p>
                <a class="btn btn-sm btn-primary" href="{{ route('bookings') }}">Book Vehicle</a> <a class="btn btn-sm btn-secondary" href="{{ route('log-book') }}"> Log Book</a>
                </div>
            </div>
        </div>
        </div>

    </div>
</div>

<div class="pd-ltr-20">
    <div class="title pb-20">
        <h2 class="h3 mb-0">Data Information</h2>
    </div>
    <div class="row pb-10">

        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ $vehicles->count()}}</div>
                        <div class="font-14 text-secondary weight-500">Vehicles</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf"><i class="icon-copy dw dw-car"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ $drivers->count()}}</div>
                        <div class="font-14 text-secondary weight-500">Drivers</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#fff"><i class="icon-copy fa fa-user"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ $bookings->count() }}</div>
                        <div class="font-14 text-secondary weight-500">Bookings</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="yellow"><i class="icon-copy dw dw-book"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ $issues->count() }}</div>
                        <div class="font-14 text-secondary weight-500">Issues</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="red"><i class="icon-copy fa fa-question-circle"></i></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h2 class="text-primary"> List of Bookings </h2>
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
            <div class="card-body">
                <div class="card-content table-responsive">
                    <table class="table table-hover data-table" style="width: 100%;">
                        <thead class="text-light bg bg-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Vehicle</th>
                                <th scope="col">Booking Date</th>
                                <th scope="col">Trip Duration</th>
                                <th scope="col">Destination</th>  
                                <th scope="col">Booking Status</th>  
                                 <th>Action</th>
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
    </div>
</div>

{{-- view modal  --}}
<div class="modal fade" id="view_booking_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Booking Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Full Name :</label>
                        <span class="view_info" id="view_full_name"></span>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Email Address :</label>
                        <span class="view_info" id="view_email"></span>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Vehicle :</label>
                        <span class="view_info" id="view_vehicle"></span>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Trip Details :</label>
                        <span class="view_info" id="view_trip_details"></span>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Start Date :</label>
                        <span class="view_info" id="view_trip_start_date"></span>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">End Date :</label>
                        <span class="view_info" id="view_return_date"></span>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Destination :</label>
                        <span class="view_info" id="view_destination"></span>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Status :</label>
                        <span class="view_info" id="view_status"></span>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Comment :</label>
                        <span class="view_info" id="view_comment"></span>
                    </div>
                </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
{{-- end of view modal --}}
{{-- take action modal  --}}
<div class="modal fade" id="take_action_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Take Action</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="take_action_form">
                {!! csrf_field() !!}
            <div class="col-md-8" style="margin-left: 15%">
                <label for="Name" class="form-label">Booking Status</label>
                <select  name ="status" id="status" class="form-control form-select form-select-lg mb-1 h-50"  required autofucus>
                    <option  value ="" selected disabled>Select status</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
                </select>
                </div>
              <div class="col-md-12">
                <label for="surname" class="form-label">Comments</label>
                <textarea name="comment"  cols="30" rows="3" class="form-control" ></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
      </div>
    </div>
  </div>
{{-- end of take action modal --}}
@endsection
@section('scripts')
<script>
    $(function () {
      
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax:"{{route('booking-list')}}",
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
                data: 'email',
                name: 'email',
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
                data: 'created_at',
                name: 'created_at',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },      
            {
                data: 'duration',
                name: 'duration',
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
                data: 'status',
                name: 'status',
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
    $(document).ready(function () {
       
        /* take action */
        $('body').on('click', '.edit', function() {
            var booking_id = $(this).data('id');
            url = "{{ route('TakeAction',['id'=>':id']) }}";
            url = url.replace(':id',booking_id);
            $('#take_action_form').attr('action', url);
            $('#take_action_modal').modal('show');
        });

        /* view booking */
        $('body').on('click', '.view', function() {
            var booking_id = $(this).data('id');
            var status_data;
            $('.view_info').empty();
            $.get('find/booking/' + booking_id, function (data) {
                $('#view_full_name').append(data.full_name);
                $('#view_email').append(data.email);
                $('#view_vehicle').append(data.vehicle_plate);
                $('#view_trip_details').append(data.trip_details);
                $('#view_trip_start_date').append(data.trip_start_date);
                $('#view_return_date').append(data.return_date);
                $('#view_destination').append(data.destination);
                if(data.status == 'Pending'){
                    status_data = '<span class="badge badge-warning text-light">'+data.status+'</span>';
                }else if(data.status == 'Approved'){
                    status_data = '<span class="badge badge-success text-light">'+data.status+'</span>';
                }else{
                    status_data = '<span class="badge badge-danger text-light">'+data.status+'</span>';
                }
                $('#view_status').append(status_data);
                $('#view_comment').append(data.comment);
                $('#view_booking_modal').modal('show');
           });
        });
    });
  </script>
@endsection
 
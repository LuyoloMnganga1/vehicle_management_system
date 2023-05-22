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
                        <div class="weight-700 font-24 text-dark">0</div>
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
                        <div class="weight-700 font-24 text-dark">0</div>
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
@endsection

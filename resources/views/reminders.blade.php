@extends('layouts.main')
@section('title')
Reminders
@endsection
@section('content')

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-header-text mb-4">
            <div class="row">
                <div class="col-md-10">
                    <h4 class="card-title">List of Reminders</h4>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#add_reminder_modal"> <i class="fa fa-plus"></i> Add New reminder</button>
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
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Insurance reminder </a>
                  <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">License disc reminder</a>
                  <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Service reminder</a>
                </div>
              </nav>
              <div class="tab-content mt-5" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card-content table-responsive">
                        <table class="table table-hover data-table" style="width: 100%;" id="insurance">
                            <thead class="text-light bg bg-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Vehicle Registration No</th>
                                    <th scope="col">Vehicle Make</th>
                                    <th scope="col">Vehicle Model</th>
                                    <th scope="col">Insurance Number</th>
                                    <th scope="col">Expiry Date</th>
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
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="card-content table-responsive">
                        <table class="table table-hover data-table" style="width: 100%;" id="license">
                            <thead class="text-light bg bg-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Vehicle Registration No</th>
                                    <th scope="col">Vehicle Make</th>
                                    <th scope="col">Vehicle Model</th>
                                    <th scope="col">License Disc Number</th>
                                    <th scope="col">Expiry Date</th>
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
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-content table-responsive">
                        <table class="table table-hover data-table" style="width: 100%;" id="service">
                            <thead class="text-light bg bg-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Vehicle Registration No</th>
                                    <th scope="col">Vehicle Make</th>
                                    <th scope="col">Vehicle Model</th>
                                    <th scope="col">Service Plan Number</th>
                                    <th scope="col">Expiry Date</th>
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
</div>



{{-- Add reminder modal --}}
<div class="modal fade" id="add_reminder_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add New Reminder</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('addReminders') }}" method="POST">
                @csrf
          <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="">Vehicle</label>
                        <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                            <option value="" selected disabled>Select vehicle</option>
                            @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id}}">{{ $vehicle->Registration_no }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="">Reminder Type</label>
                        <select name="reminder_type" id="reminder_type" class="form-control" required>
                            <option value="" disabled selected>Select type</option>
                            <option value="insurance">Insurance</option>
                            <option value="license">License Disc</option>
                            <option value="service">Service</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="">Policy/Serial Number</label>
                        <input type="text" name="reminder_serial_number" id="reminder_serial_number" class="form-control" required>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="">Expiry/Due Date</label>
                        <input type="date" name="due_date" class="form-control" required>
                    </div>
                </div>
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
  {{-- end of Add reminder modal --}}

@endsection
@section('scripts')
<script>
     $(function () {
      
      var table = $('#insurance').DataTable({
          processing: true,
          serverSide: true,
          ajax:"{{route('get_insurance_reminders')}}",
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
                data: 'vehicle_plate',
                name: 'vehicle_plate',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'vehicle_make',
                name: 'vehicle_make',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'vehicle_model',
                name: 'vehicle_model',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'reminder_serial_number',
                name: 'reminder_serial_number',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },    
            {
                data: 'due_date',
                name: 'due_date',
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

      var table = $('#license').DataTable({
          processing: true,
          serverSide: true,
          ajax:"{{route('get_license_reminders')}}",
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
                data: 'vehicle_plate',
                name: 'vehicle_plate',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'vehicle_make',
                name: 'vehicle_make',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'vehicle_model',
                name: 'vehicle_model',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'reminder_serial_number',
                name: 'reminder_serial_number',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },    
            {
                data: 'due_date',
                name: 'due_date',
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


      var table = $('#service').DataTable({
          processing: true,
          serverSide: true,
          ajax:"{{route('get_service_reminders')}}",
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
                data: 'vehicle_plate',
                name: 'vehicle_plate',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'vehicle_make',
                name: 'vehicle_make',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'vehicle_model',
                name: 'vehicle_model',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'reminder_serial_number',
                name: 'reminder_serial_number',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },    
            {
                data: 'due_date',
                name: 'due_date',
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

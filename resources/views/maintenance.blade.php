@extends('layouts.main')
@section('title')
Maintenance
@endsection
@section('content')

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-header-text mb-4">
            <div class="row">
                <div class="col-md-10">
                    <h4 class="card-title">Maintenance List</h4>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#exampleModalCenter"> <i class="fa fa-plus"></i> Maintenance</button>
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
                        <!-- <th scope="col">#</th> -->
                        <th scope="col">Maintenance Date</th>
                        <th scope="col">Registration No</th>
                        <th scope="col">Service Provider</th>
                        <th scope="col">Odometer</th>
                        <th scope="col">Current Millage</th>
                        <th scope="col">Next Service Millage</th>
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
<!-- add issue modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Maintenance</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('addMaintenance') }}"  enctype="multipart/form-data" method="POST">
            @csrf
        <div class="modal-body">
         <div class="row">   
            @php
                 $vehicle = App\Models\Vehicle::orderBy('Registration_no', 'ASC')->get();
            @endphp
              <div class="col-md-6">
                <div class="form-group">
                    <label for="">Maintenance Date</label>
                    <input type="date" name="maintenance_date" id="due_date" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Registration Number</label>
                    <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                        <option value="" selected>Select Registration number</option>
                        @foreach($vehicle as $item )
                        <option value="{{ $item->id }}">{{ $item->Registration_no }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label for="">Service Provider</label>
                <input type="text" name="service_provider" id="service_provider" class="form-control" required>
            </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Odometer</label>
                    <input type="text" name="odometer" id="odometer" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" >Current Millage </label>
                    <input type="text" name="current_millage" id="current_millage " class="form-control" required>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" >Next Service Millage </label>
                        <input type="text" name="next_service_millage" id="next_service_millage " class="form-control" required>
                    </div>
                    </div>
        </div>
    </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Add</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- end of add issue modal -->

 

@endSection

@section('scripts')
<script type="text/javascript">
  $(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('maintenance') }}",
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
                data: 'maintenance_date',
                name: 'maintenance_date',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'vehicle_id',
                name: 'vehicle_id',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            
            {
                data: 'service_provider',
                name: 'service_provider',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'odometer', 
                name: 'odometer',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'current_millage', 
                name: 'current_millage',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'next_service_millage', 
                name: 'next_service_millage',
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
                print: false,
                className: 'text-center'
            }
        ]
    });
    
  });
</script>

@endsection
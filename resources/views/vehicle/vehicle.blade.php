@extends('layouts.main')
@section('title')
Vehicle
@endsection
@section('content')

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-header-text mb-4">
            <div class="row">
                <div class="col-md-10">
                    <h4 class="card-title">List of Vehicles</h4>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#exampleModalCenter"> <i class="fa fa-plus"></i> Add New Vehicle</button>
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
                        <th scope="col">Name</th>
                        <th scope="col">Model</th>
                        <th scope="col">Fuel Type</th>
                        <th scope="col">Manufacture Year</th>
                        <th scope="col">Registration No</th>
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

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Vehicle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('addVehicle')}}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Vehicle Type</label>
                            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"
                                name="vehicle_type">
                                <option selected>Choose...</option>
                                <option value="Bakkie">Bakkie</option>
                                <option value="Sedan">Sedan</option>
                                <option value="Truck">Truck</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Vehicle Name</label>
                            <input type="text" class="form-control" id="hod_fullname" name="vehicle_name" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Make/Model</label>
                            <input type="text" class="form-control" id="phone" name="vehicle_model" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Year of Manufacture</label>
                            <input type="text" class="form-control" id="hod_fullname" name="year" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Vehicle Image</label>
                            <div class="custom-file">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <input type="file" class="custom-file-input rounded-circle" id="customFile"
                                    name="vehicle_image" accept=".jpg,.jpeg,.bmp,.png,.gif,.jfif"
                                    onchange="displayImg2(this,$(this))">


                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Status</label>
                            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"
                                name="vehicle_status">
                                <option selected>Choose...</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Registration Number</label>
                            <input type="text" class="form-control" id="phone" name="Registration_no" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Engine Number</label>
                            <input type="text" class="form-control" id="hod_fullname" name="engine_no" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Chassis Number</label>
                            <input type="text" class="form-control" id="phone" name="chassis_no" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Fuel Type</label>
                            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="fuel_type">
                                <option selected>Choose...</option>
                                <option value="Petrol">Petrol</option>
                                <option value="Dessiel">Dessiel</option>
                                <option value="Electric">Electric</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Fuel Measurement In</label>
                            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"
                                name="fuel_measurement">
                                <option selected>Choose...</option>
                                <option value="Litres">Litres</option>
                                <option value="Gallons">Gallons</option>

                            </select> </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Track Usage As</label>
                            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"
                                name="vehicle_usage">
                                <option selected>Choose...</option>
                                <option value="Kilometers">Kilometers</option>
                                <option value="Miles">Miles</option>
                                <option value="Hours">Hours</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Secondary/Auxilary Meter</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="aux_meter" id="inlineRadio1"
                                    value="Yes">
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="aux_meter" id="inlineRadio2"
                                    value="No">
                                <label class="form-check-label" for="inlineRadio2">No</label>
                            </div>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<!-- end moal -->
 {{-- <!-- Modal -->
 <div class="modal fade" id="edit{{$vehicle->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('updateVehicle',$vehicle->id)}}" method="post">
                    {!! csrf_field() !!}
                    <div class="row">
                      <div class="form-group col-md-12">
                          <label for="inputEmail4">Vehicle Type</label>
                          <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"
                              name="vehicle_type">
                              <option selected>{{$vehicle->vehicle_type}}</option>
                              <option value="Bakkie">Bakkie</option>
                              <option value="Sedan">Sedan</option>
                              <option value="Truck">Truck</option>
                          </select>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Vehicle Name</label>
                          <input type="text" class="form-control" id="hod_fullname" name="vehicle_name" value="{{$vehicle->vehicle_name}}">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Make/Model</label>
                          <input type="text" class="form-control" id="phone" name="vehicle_model" value="{{$vehicle->vehicle_model}}">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Year of Manufacture</label>
                          <input type="text" class="form-control" id="hod_fullname" name="year" value="{{$vehicle->year}}">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Vehicle Image</label>
                          <div class="custom-file">
                              <label class="custom-file-label" for="customFile">Choose file</label>
                              <input type="file" class="custom-file-input rounded-circle" id="customFile"
                                  name="vehicle_image" accept=".jpg,.jpeg,.bmp,.png,.gif,.jfif"
                                  onchange="displayImg2(this,$(this))">
                          </div>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Status</label>
                          <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"
                              name="vehicle_status">
                              <option selected>{{$vehicle->vehicle_status}}</option>
                              <option value="Active">Active</option>
                              <option value="Inactive">Inactive</option>
                          </select>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Registration Number</label>
                          <input type="text" class="form-control" id="phone" name="Registration_no" value="{{$vehicle->Registration_no}}">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Engine Number</label>
                          <input type="text" class="form-control" id="hod_fullname" name="engine_no" value="{{$vehicle->engine_no}}">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Chassis Number</label>
                          <input type="text" class="form-control" id="phone" name="chassis_no" value="{{$vehicle->chassis_no}}">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Fuel Type</label>
                          <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="fuel_type">
                              <option selected>{{$vehicle->fuel_type}}</option>
                              <option value="Petrol">Petrol</option>
                              <option value="Dessiel">Dessiel</option>
                              <option value="Electric">Electric</option>
                          </select>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Fuel Measurement In</label>
                          <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"
                              name="fuel_measurement">
                              <option selected>{{$vehicle->fuel_measurement}}</option>
                              <option value="Litres">Litres</option>
                              <option value="Gallons">Gallons</option>

                          </select> </div>
                      <div class="form-group col-md-12">
                          <label for="inputEmail4">Track Usage As</label>
                          <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"
                              name="vehicle_usage">
                              <option selected>{{$vehicle->vehicle_usage}}</option>
                              <option value="Kilometers">Kilometers</option>
                              <option value="Miles">Miles</option>
                              <option value="Hours">Hours</option>
                          </select>
                      </div>

                      <div class="form-group col-md-12">
                          <label for="inputEmail4">Secondary/Auxilary Meter</label>
                          <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="aux_meter" id="inlineRadio1"
                                  value="{{$vehicle->aux_meter}}">
                              <label class="form-check-label" for="inlineRadio1">Yes</label>
                          </div>
                          <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="aux_meter" id="inlineRadio2"
                                  value="{{$vehicle->aux_meter}}">
                              <label class="form-check-label" for="inlineRadio2">No</label>
                          </div>
                      </div>
                  </div>

                  <div style="margin-top: 2%">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div> --}}
<!--end of edit modal-->
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        var table = $('.data-table').DataTable({
            buttons: [{
                text: 'My button',
                action: function(e, dt, button, config) {
                    var info = dt.buttons.exportInfo();
                }
            }],
        processing: true,
        serverSide: true,
        ajax: "{{ route('vehicle-list') }}",
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
                data: 'vehicle_type',
                name: 'vehicle_type',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'vehicle_name',
                name: 'vehicle_name',
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
                data: 'year', 
                name: 'year',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'vehicle_image', 
                name: 'vehicle_image',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'Registration_no', 
                name: 'Registration_no',
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
<script>
    function displayImg(input,_this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#timg1').attr('src',e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
function displayImg2(input,_this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#timg').attr('src',e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
@extends('layouts.main')
@section('content')

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
                <form action="{{route('addVehicle')}}" method="post">
                    {!! csrf_field() !!}
                    <!-- {!! method_field('GET') !!}  -->

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Vehicle Type</label>
                            {{-- <input type="text" class="form-control" id="hod_fullname" name="hod_fullname" value=""> --}}

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


                    <div style="margin-top: 5%">
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<!-- end moal -->


<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-header-text">
            <div class="row">
                <div class="col-md-9">
                    <h4 class="card-title">Manage Vehicle</h4>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#exampleModalCenter"> <i class="fa fa-plus"></i> Add New</button>
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
            <table class="table table-hover" id="list" cellspacing="0">
                <thead class="text-primary">
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
                    @if ($vehicle->count() == 0)
                    <tr>
                        <td colspan="5" class="text-center">No data available in table.</td>
                    </tr>
                    @endif
                    @foreach($vehicle as $vehicle )
                    <tr>
                        <td width="5%">{{$i++}}</td>
                        <td>{{ $vehicle->vehicle_name}}</td>
                        <td>{{ $vehicle->vehicle_model}}</td>
                        <td>{{ $vehicle->fuel_type}}</td>
                        <td>{{ $vehicle->year}}</td>
                        <td>{{ $vehicle->Registration_no}}</td>
                        <td>
                            <form action="{{route('deleteVehicle',$vehicle->id)}}" method="get">
                                <a class="btn bg-transparent btn-outline-info" data-toggle="modal"
                                    data-target="#edit{{$vehicle->id}}"><i style="color:#5bc0de;" class="material-icons">edit</i> </a>
                                @csrf
                                {{ method_field('GET') }}

                                <button type="submit" name="archive" onclick="archiveFunction()"
                                    class="btn bg-transparent btn-outline-danger"><i
                                        style="color:red; padding-bottom: -50%;" class="material-icons">delete</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <!-- Modal -->
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
                                    <form action="" method="post">
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
                    </div>
        </div>
        @endforeach
        </tbody>
        </table>
        <div class="d-flex">
            {{-- {{ $vehicle->links() }} --}}
        </div>
    </div>
</div>
</div>
</div>

<script>
    function displayImg2(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#timg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@stop
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
                        <th scope="col">Type</th>
                        <th scope="col">Name</th>
                        <th scope="col">Model</th>
                        <th scope="col">Manufacture Year</th>
                        <th scope="col">Fuel Type</th>
                        <th scope="col">Image</th>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<!-- end moal -->
 <!-- Modal -->
 <div class="modal fade" id="edit_vehicle" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Vehicle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  id="updade_vehicle_form" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="row">
                      <div class="form-group col-md-12">
                          <label for="inputEmail4">Vehicle Type</label>
                          <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"
                              name="vehicle_type" required>
                              <option value="" selected>Select type</option>
                              <option value="Bakkie">Bakkie</option>
                              <option value="Sedan">Sedan</option>
                              <option value="Truck">Truck</option>
                          </select>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Vehicle Name</label>
                          <input type="text" class="form-control" id="update_vehicle_name" name="vehicle_name" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Make/Model</label>
                          <input type="text" class="form-control" id="update_vehicle_model" name="vehicle_model" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Year of Manufacture</label>
                          <input type="text" class="form-control" id="update_vehicle_year" name="year"  required>
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
                      <div class="form-group col-md-12">
                        <img src="" alt="" class="form-control" id="previous_image" name="previous_image" style="width:250px;height:250px;">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Status</label>
                          <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"
                              name="vehicle_status" required>
                              <option value= "" selected>Select status</option>
                              <option value="Active">Active</option>
                              <option value="Inactive">Inactive</option>
                          </select>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Registration Number</label>
                          <input type="text" class="form-control" id="update_vehicle_plate" name="Registration_no" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Engine Number</label>
                          <input type="text" class="form-control" id="update_vehicle_engine" name="engine_no" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Chassis Number</label>
                          <input type="text" class="form-control" id="update_vehicle_chassis" name="chassis_no" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Fuel Type</label>
                          <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="fuel_type">
                              <option value="" selected>Select fuel type</option>
                              <option value="Petrol">Petrol</option>
                              <option value="Dessiel">Dessiel</option>
                              <option value="Electric">Electric</option>
                          </select>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Fuel Measurement In</label>
                          <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"
                              name="fuel_measurement">
                              <option value="" selected>Select measurement</option>
                              <option value="Litres">Litres</option>
                              <option value="Gallons">Gallons</option>

                          </select> </div>
                      <div class="form-group col-md-12">
                          <label for="inputEmail4">Track Usage As</label>
                          <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"
                              name="vehicle_usage">
                              <option value="" selected>Select Usage</option>
                              <option value="Kilometers">Kilometers</option>
                              <option value="Miles">Miles</option>
                              <option value="Hours">Hours</option>
                          </select>
                      </div>

                      <div class="form-group col-md-12">
                          <label for="inputEmail4">Secondary/Auxilary Meter</label>
                          <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="aux_meter" required>
                              <label class="form-check-label" for="inlineRadio1">Yes</label>
                          </div>
                          <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="aux_meter" required >
                              <label class="form-check-label" for="inlineRadio2">No</label>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" id="btn_update" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>

    </div>
</div>
 </div>
 
<!--end of edit modal-->
{{-- view driver moal --}}
<div class="modal fade" id="vehicle_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">View Vehicle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center h5 mb-0 view_vehicle" id="view_vehicle_name"> </h5>
                <p class="text-center text-muted font-14 view_vehicle" id="view_vehicle_reg"></p>
                <hr></hr>
                <h5 class="mb-20 h5 text-blue">Vehicle Information</h5>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>
                                <span>Engine Number :</span>
                                <p class="view_vehicle" id="view_vehicle_engine_no"></p>
                            </li>
                            <li>
                                <span>Fuel Measurement :</span>
                                <p class="view_vehicle" id="view_vehicle_fuel_measurement"></p>
                            </li>
                            <li>
                                <span>Status  :</span>
                                <p class="view_vehicle" id="view_vehicle_status"></p>
                            </li>
                            <li>
                                <span>Secondary/Auxilary Meter :</span>
                                <p class="view_vehicle" id="view_vehicle_aux_meter"></p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul>
                            <li>
                                <span>Fuel Type :</span>
                                <p class="view_vehicle" id="view_vehicle_fuel_type"></p>
                            </li>
                            <li>
                                <span>Chassis Number :</span>
                                <p class="view_vehicle" id="view_vehicle_chassis_no"></p>
                            </li>
                            <li>
                                <span>Usage :</span>
                                <p class="view_vehicle" id="view_vehicle_usage"></p>
                            </li>
                        </ul>
                    </div>

                </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Licence Image</label>
                            <img src="" alt="selected image" class="form-control" id="view_vehicle_image" style="width: 250px;height:300px">
                        </div>
                    </div>                                            
                    <div class="modal-footer">                                       
                      <button type="button" class="btn btn-secondary"
                          data-dismiss="modal">Close</button>
                  </div>

                </form>
            </div>

        </div>
    </div>
</div>
{{--  end of view driver moal --}}
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
                data: 'fuel_type', 
                name: 'fuel_type',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'vehicle_image', 
                name: 'vehicle_image',
                orderable: false,
                searchable: false,
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
    $(document).ready(function () {
        
        //edit button
        $('body').on('click', '.edit', function(){
            var id = $(this).data('id');
            $.get('/find-vehicle/'+ id, function(data){
               $('#update_vehicle_name').val(data.vehicle_name);
               $('#update_vehicle_model').val(data.vehicle_model);
               $('#update_vehicle_year').val(data.year);
               $('#previous_image').attr('src',data.vehicle_image);
               $('#update_vehicle_plate').val(data.Registration_no);
               $('#update_vehicle_engine').val(data.engine_no);
               $('#update_vehicle_chassis').val(data.chassis_no);
               var  url = "{{ route('updateVehicle',['id'=>':id'])}}";
               url = url.replace(':id', data.id);
               $('#updade_vehicle_form').attr('action',url);
               $('#edit_vehicle').modal('show');
            })
        });

         /* view driver */
         $('body').on('click', '.view', function() {
            $('.view_vehicle').empty();
            var driver_id = $(this).data('id');
           $.get('/find-vehicle/'+ driver_id, function(data){
                $('#view_vehicle_name').append(data.vehicle_model +' '+data.vehicle_name+' '+data.vehicle_type);
                $('#view_vehicle_reg').append(data.Registration_no);
                $('#view_vehicle_engine_no').append(data.engine_no);
                $('#view_vehicle_fuel_type').append(data.fuel_type);
                $('#view_vehicle_fuel_measurement').append(data.fuel_measurement);
                $('#view_vehicle_chassis_no').append(data.chassis_no);
                $('#view_vehicle_status').append(data.vehicle_status);
                $('#view_vehicle_usage').append(data.vehicle_usage);
                $('#view_vehicle_aux_meter').append(data.aux_meter);
                $('#view_vehicle_image').attr('src',data.vehicle_image);
                $('#vehicle_info').modal('show');
           });
        });


         /*delete  driver */
         $('body').on('click', '#delete', function() {
           $('#delete_record').modal('show');
           $('#yes').on('click',function(){
               var id = $('#delete').data('id');
               var url=  '/deleteVehicle/'+ id;             
               location.href = url;
           })
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
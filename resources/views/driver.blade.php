@extends('layouts.main')
@section('title')
Drivers
@endsection
@section('content')


<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-header-text mb-4">
            <div class="row">
                <div class="col-md-10">
                    <h4 class="card-title">List of Drivers</h4>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#exampleModalCenter"> <i class="fa fa-plus"></i> Add New Driver</button>
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
                        <th scope="col">Surname</th>
                        <th scope="col">Department</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Contact No.</th>
                        <th scope="col">Licence Number</th>
                        <th scope="col">Licence Expiry Date</th>
                        <th scope="col">Licence Class</th>
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

<!--Add Driver Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('addDriver')}}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    @php
                        $users = \App\Http\Controllers\DriverController::getUsers();
                    @endphp
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label"><h6>Users list</h6></label>
                                <div class="col-sm-8">
                                    <select name="user_id" id="selected_user" class="form-control">
                                        <option value="" selected>select driver</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                              </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Driver Name</label>
                            <input type="text" class="form-control"  name="name" id="driver_name" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Driver Surname</label>
                            <input type="text" class="form-control"  name="surname" id="driver_surname" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Department</label>
                            <input type="text" class="form-control" name="department" id="driver_department" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email Address</label>
                            <input type="email" class="form-control" name="email" id="driver_email" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Contact No</label>
                            <input type="text" class="form-control" name="phone" id="driver_phone" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">User Type</label>
                            <input type="text" class="form-control"  name="user_type" id="driver_role" readonly>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="inputEmail4">Licence Number</label>
                            <input type="text" class="form-control"  name="licence_no" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Licence Class</label>
                            <select class="form-control"  name="licence_class" required>
                                <option value="" selected>select licence class</option>
                                <option value="Code A">Code A</option>
                                <option value="Code A1">Code A1</option>
                                <option value="Code B">Code B</option>
                                <option value="Code EB">Code EB</option>
                                <option value="Code C">Code C</option>
                                <option value="Code C1">Code C1</option>
                                <option value="Code EC">Code EC</option>
                                <option value="Code EC1">Code EC1</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Licence Expiry Date</label>
                            <input type="date" class="form-control"  name="license_expiry_date" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Licence State/Province/Region</label>
                            <input type="text" class="form-control"  name="license_state">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Licence Image</label>
                            <div class="custom-file">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <input type="file" class="custom-file-input rounded-circle" id="customFile" required
                                    name="license_image" accept=".jpg,.jpeg,.bmp,.png,.gif,.jfif"
                                    onchange="displayImg2(this,$(this))">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <img src="images/no_image.jpg" alt="selected image" class="form-control" id="timg" style="width: 250px;height:300px">
                        </div>
                    </div>                                            
                    <div class="modal-footer">                                       
                      <button type="submit" class="btn btn-primary">Add Driver</button>
                      <button type="button" class="btn btn-secondary"
                          data-dismiss="modal">Cancel</button>
                  </div>

                </form>
            </div>

        </div>
    </div>
</div>
<!-- end add driver moal -->
<!--Edit Driver Modal -->
<div class="modal fade" id="update_driver_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('update-Driver')}}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}                  
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Driver Name</label>
                            <input type="text" class="form-control"  name="name" id="update_name" readonly>
                        </div>
                        <input type="hidden" name="id" id="record_id">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Driver Surname</label>
                            <input type="text" class="form-control"  name="surname" id="update_surname" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Department</label>
                            <input type="text" class="form-control" name="department" id="update_department" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email Address</label>
                            <input type="email" class="form-control" name="email" id="update_email" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Contact No</label>
                            <input type="text" class="form-control" name="phone" id="update_phone" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">User Type</label>
                            <input type="text" class="form-control"  name="user_type" id="update_role" readonly>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="inputEmail4">Licence Number</label>
                            <input type="text" class="form-control"  name="licence_no" id="update_licence_no" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Licence Class</label>
                            <select class="form-control"  name="licence_class" required>
                                <option value="" selected>select licence class</option>
                                <option value="Code A">Code A</option>
                                <option value="Code A1">Code A1</option>
                                <option value="Code B">Code B</option>
                                <option value="Code EB">Code EB</option>
                                <option value="Code C">Code C</option>
                                <option value="Code C1">Code C1</option>
                                <option value="Code EC">Code EC</option>
                                <option value="Code EC1">Code EC1</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Licence Expiry Date</label>
                            <input type="date" class="form-control"  name="license_expiry_date" id="update_license_expiry_date" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Licence State/Province/Region</label>
                            <input type="text" class="form-control"  name="license_state" id="update_license_state">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Licence Image</label>
                            <div class="custom-file">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <input type="file" class="custom-file-input rounded-circle" id="update_license_image" 
                                    name="license_image" accept=".jpg,.jpeg,.bmp,.png,.gif,.jfif"
                                    onchange="displayImg2(this,$(this))">
                            </div>
                        </div>
                        <input type="hidden" name="previous_image" id="previous_image">
                        <div class="form-group col-md-12">
                            <img src="" alt="selected image" class="form-control" id="timg1" style="width: 250px;height:300px">
                        </div>
                    </div>                                            
                    <div class="modal-footer">                                       
                      <button type="submit" class="btn btn-primary">Update Driver</button>
                      <button type="button" class="btn btn-secondary"
                          data-dismiss="modal">Cancel</button>
                  </div>

                </form>
            </div>

        </div>
    </div>
</div>
<!-- end edit driver moal -->
{{-- view driver moal --}}
<div class="modal fade" id="view_driver_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">View Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center h5 mb-0 view_driver" id="view_driver_name"> </h5>
                <p class="text-center text-muted font-14 view_driver" id="view_driver_department"></p>
                <hr></hr>
                <h5 class="mb-20 h5 text-blue">Driver Information</h5>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>
                                <span>Email :</span>
                                <p class="view_driver" id="view_driver_email"></p>
                            </li>
                            <li>
                                <span>Role :</span>
                                <p class="view_driver" id="view_driver_role"></p>
                            </li>
                            <li>
                                <span>Licence Number :</span>
                                <p class="view_driver" id="view_driver_licence_no"></p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul>
                            <li>
                                <span>Phone :</span>
                                <p class="view_driver" id="view_driver_phone"></p>
                            </li>
                            <li>
                                <span>licence Expiry Date :</span>
                                <p class="view_driver" id="view_driver_licence_expiry_date"></p>
                            </li>
                            <li>
                                <span>Licence State/Province/Region :</span>
                                <p class="view_driver" id="view_driver_licence_state"></p>
                            </li>
                        </ul>
                    </div>

                </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Licence Image</label>
                            <img src="" alt="selected image" class="form-control" id="timg3" style="width: 250px;height:300px">
                        </div>
                    </div>                                            
                    <div class="modal-footer">                                       
                      <button type="button" class="btn btn-secondary"
                          data-dismiss="modal">Cancel</button>
                  </div>

                </form>
            </div>

        </div>
    </div>
</div>
{{--  end of view driver moal --}}
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
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
        ajax: "{{ route('driver.list') }}",
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
                data: 'name',
                name: 'name',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'surname',
                name: 'surname',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'department',
                name: 'department',
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
                data: 'phone', 
                name: 'phone',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'licenceno', 
                name: 'licenceno',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'licenseexpirydate', 
                name: 'licenseexpirydate',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'licenceclass', 
                name: 'licenceclass',
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
        //on selected user display information
        $('#selected_user').on('change',function(){
            var user_id = $(this).val();
            $.get('/find-user/' + user_id,function(data){
                $('#driver_name').val(data.name);
                $('#driver_surname').val(data.surname);
                $('#driver_department').val(data.department);
                $('#driver_email').val(data.email);
                $('#driver_phone').val(data.phone);
                $('#driver_role').val(data.role);
            })
        });

        /* edit driver */
        $('body').on('click', '.edit', function() {
            var driver_id = $(this).data('id');
           $.get('/find-driver/'+ driver_id, function(data){
                $('#record_id').val(data.id);
                $('#update_name').val(data.name);
                $('#update_surname').val(data.surname);
                $('#update_department').val(data.department);
                $('#update_email').val(data.email);
                $('#update_phone').val(data.phone);
                $('#update_role').val(data.role);
                $('#update_license_expiry_date').val(data.license_expiry_date);
                $('#update_licence_no').val(data.licence_no);
                $('#update_license_state').val(data.license_state);
                $('#previous_image').val(data.license_image);
                $('#timg1').attr('src',data.license_image);
                $('#update_driver_info').modal('show');
           });
        });

        /* view driver */
        $('body').on('click', '.view', function() {
            $('.view_driver').empty();
            var driver_id = $(this).data('id');
           $.get('/find-driver/'+ driver_id, function(data){
                $('#view_driver_name').append(data.name +' '+data.surname);
                $('#view_driver_department').append(data.department);
                $('#view_driver_email').append(data.email);
                $('#view_driver_phone').append(data.phone);
                $('#view_driver_role').append(data.role);
                $('#view_driver_licence_expiry_date').append(new Date(data.license_expiry_date).toDateString());
                $('#view_driver_licence_no').append(data.license_no);
                $('#view_driver_licence_state').append(data.license_state);
                $('#timg3').attr('src',data.license_image);
                $('#view_driver_info').modal('show');
           });
        });

        /*delete  driver */
        $('body').on('click', '#delete', function() {
           $('#delete_record').modal('show');
           $('#yes').on('click',function(){
               var url=  $('#delete').data('href');
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

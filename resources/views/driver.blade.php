@extends('layouts.main')
@section('title')
Dashboard
@endsection
@section('content')

<!-- Modal -->
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
                <form action="{{route('addDriver')}}" method="post">
                    {!! csrf_field() !!}
                    <!-- {!! method_field('GET') !!}  -->

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Driver Name</label>
                            <select name="name" id="driver_name" class="form-control">
                                <option value="" selected>select driver</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Driver Surname</label>
                            <input type="text" class="form-control"  name="surname" id="driver_surname">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Department</label>
                            <input type="text" class="form-control" name="department" id="driver_department">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email Address</label>
                            <input type="email" class="form-control" name="email" id="driver_email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Contact No</label>
                            <input type="text" class="form-control" id="phone" name="phone" id="driver_phone">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">User Type</label>
                            <input type="text" class="form-control" id="hod_fullname" name="user_type" id="driver_role">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">License Number</label>
                            <input type="text" class="form-control" id="phone" name="licence_no" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Licenpce Class</label>
                            <input type="text" class="form-control" id="hod_fullname" name="licence_class" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">License State/Province/Region</label>
                            <input type="text" class="form-control" id="phone" name="license_state" id="driver_location">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">License Image</label>
                            <div class="custom-file">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <input type="file" class="custom-file-input rounded-circle" id="customFile"
                                    name="license_image" accept=".jpg,.jpeg,.bmp,.png,.gif,.jfif"
                                    onchange="displayImg2(this,$(this))">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <div class="modal-footer">
                                            
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
<!-- end moal -->


<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-header-text">
            <div class="row">
                <div class="col-md-9">
                    <h4 class="card-title">List of Drivers</h4>
                </div>
                <div class="col-md-3">
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
            <table class="table table-hover" id="driver_list" cellspacing="0">
                <thead class="text-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Department</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Contact No.</th>
                        <th scope="col">User Type</th>
                        <th scope="col">License Number</th>
                        <th scope="col">License Class</th>
                        <th scope="col">License State/Province/Region</th>
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
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        var table = $('#driver_list').DataTable({
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
                data: 'usertype', 
                name: 'usertype',
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
                data: 'licenceclass', 
                name: 'licenceclass',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'licensestate', 
                name: 'licensestate',
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

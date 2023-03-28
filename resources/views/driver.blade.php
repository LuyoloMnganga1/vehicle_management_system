@extends('layouts.main')
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
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Driver Name</label>
                            <input type="text" class="form-control" id="hod_fullname" name="name" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Driver Surname</label>
                            <input type="text" class="form-control" id="hod_fullname" name="surname" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Department</label>
                            <input type="text" class="form-control" name="department" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email Address</label>
                            <input type="email" class="form-control" name="email" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Contact No</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">User Type</label>
                            <input type="text" class="form-control" id="hod_fullname" name="user_type" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">License Number</label>
                            <input type="text" class="form-control" id="phone" name="licence_no" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Licenpce Class</label>
                            <input type="text" class="form-control" id="hod_fullname" name="licence_class" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">License State/Province/Region</label>
                            <input type="text" class="form-control" id="phone" name="license_state" value="">
                        </div>
                        <div class="form-group col-md-12">
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
 <!-- import staff Modal -->
 <div class="modal fade" id="importStaff" tabindex="-1" role="dialog"
 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLongTitle">Import Drivers</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <div class="modal-body">
            
             <form action="{{route('import-driver')}}" method="post" enctype="multipart/form-data">
                 <div class="col-md-12 mb-3">
                     <label for="formFile"  id = "file" name="file" class="form-label" >Excel Spreadsheet</label>
                     <input style="background: white; color:dark;" class="form-control" type="file" name="file" id="chooseFile" accept =".csv,.doc,.docs.txt,.xlx,.xls,.pdf">
                 </div>                                    
               
         </div>
         <div class="modal-footer">
             <button type="button"  type="submit" class="btn btn-primary">Import</button>
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

         </div>
        </form>
     </div>
 </div>
</div>
{{-- end import staff modal --}}


<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-header-text">
            <div class="row">
                <div class="col-md-9">
                    <h4 class="card-title">List of Drivers</h4>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#importStaff"><i
                        class="fa fa-plus"></i> Import Drivers</button>
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
            <table class="table table-hover" id="list" cellspacing="0">
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
                    @if ($driver->count() == 0)
                    <tr>
                        <td colspan="5" class="text-center">No data available in table.</td>
                    </tr>
                    @endif
                    @foreach($driver as $driver )
                    <tr>
                        <td width="5%">{{$i++}}</td>
                        <td>{{ $driver->name}} {{$driver->surname}}</td>
                        <td>{{ $driver->department}}</td>
                        <td>{{ $driver->email}}</td>
                        <td>{{ $driver->phone}}</td>
                        <td>{{ $driver->user_type}}</td>
                        <td>{{ $driver->licence_no}}</td>
                        <td>{{ $driver->licence_class}}</td>
                        <td>{{ $driver->license_state}}</td>
                        <td>
                            <form action="{{route('delete-Driver',$driver->id)}}" method="get">
                                <a class="btn bg-transparent btn-outline-info" data-toggle="modal"
                                    data-target="#edit"><i style="color:#5bc0de;" class="material-icons">edit</i> </a>
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
                    <div class="modal fade" id="edit" tabindex="-1" role="dialog"
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
                                    <form action="{{route('update-Driver', $driver->id)}}" method="post">
                                        {!! csrf_field() !!}
                                        <div class="row">
                                          <div class="form-group col-md-12">
                                            <label for="inputEmail4">Driver Name</label>
                                            <input type="text" class="form-control" id="hod_fullname" name="name"  value="{{$driver->name}}">
                                        </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Driver Surname</label>
                                                <input type="text" class="form-control" id="hod_fullname" name="surname"
                                                    value="{{$driver->surname}}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Department</label>
                                                <input type="text" class="form-control" name="department"
                                                    value="{{$driver->department}}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Email Address</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{$driver->email}}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Contact No</label>
                                                <input type="text" class="form-control" id="phone" name="phone"
                                                    value="{{$driver->phone}}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">User Type</label>
                                                <input type="text" class="form-control" id="hod_fullname"
                                                    name="user_type" value="{{$driver->user_type}}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">License Number</label>
                                                <input type="text" class="form-control" id="phone" name="licence_no"
                                                    value="{{$driver->licence_no}}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Licenpce Class</label>
                                                <input type="text" class="form-control" id="hod_fullname"
                                                    name="licence_class" value="{{$driver->licence_class}}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">License State/Province/Region</label>
                                                <input type="text" class="form-control" id="phone" name="license_state"
                                                    value="{{$driver->license_state}}">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">License Image</label>
                                                <div class="custom-file">
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                    <input type="file" class="custom-file-input rounded-circle"
                                                        id="customFile" name="license_image"
                                                        accept=".jpg,.jpeg,.bmp,.png,.gif,.jfif"
                                                        onchange="displayImg2(this,$(this))">


                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">

                                            <button type="submit" class="btn btn-primary">Update Driver</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                        </div>
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
            {{-- {{ $dep->links() }} --}}
        </div>
    </div>
</div>
</div>
</div>

@stop
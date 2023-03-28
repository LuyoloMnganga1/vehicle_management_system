@extends('layouts.main')
@section('content')



<div class="col-lg-12 col-md-12">
    <!-- Modal -->
<div class="modal fade" id="assign" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
            <form action="" method="post">
                {!! csrf_field() !!}
                <!-- {!! method_field('GET') !!}  -->

                <div class="row">
                    {{-- <div class="form-group col-md-6">
                        <label for="inputEmail4">Driver Full Name</label>
                        <input type="text" class="form-control" id="hod_fullname" name="assignee" value="{{$driver->name}}{{$driver->surname}}" readonly>
                    </div> --}}
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Driver Full Name</label>
                        <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"
                            name="assignee">
                            <option selected>Select driver</option>
                            @foreach ($driver as $item)                            
                                <option id="driver" value="{{$item->name}} {{$item->surname}}">{{$item->name}} {{$item->surname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email Address</label>
                        <input type="email" class="form-control" name="email" value="" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">License Number</label>
                        <input type="text" class="form-control"  name="licence_no" value="" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Department</label>
                        <input type="text" class="form-control" name="department" value="" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Registration Number</label>
                        <input type="text" class="form-control" name="Registration_no" value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Odometer</label>
                        <input type="text" class="form-control" name="odometer" value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Status</label>
                        <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"
                            name="assigned_status">
                            <option selected>Choose...</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Comment</label>
                        <textarea type="date" class="form-control" name="comment" value=""></textarea>
                    </div>
                    



                </div>


                <div class="modal-footer">
                                        
                  <button type="submit" class="btn btn-primary">Assign Vehicle</button>
                  <button type="button" class="btn btn-secondary"
                      data-dismiss="modal">Cancel</button>
              </div>

            </form>
        </div>

    </div>
</div>
</div>
<!-- end moal -->
    <div class="card">
        <div class="card-header card-header-text">
            <div class="row">
                <div class="col-md-9">
                    <h4 class="card-title">List of Assiged Vehicles</h4>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#assign"> <i class="fa fa-plus"></i> Assign Vehicle</button>
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
                        <th scope="col">Vehicle</th>
                        <th scope="col">Driver</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">Start Meter</th>
                        <th scope="col">End Date</th>
                        <th scope="col">End Meter</th>
                        <th scope="col">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($assigned->count() == 0)
                    <tr>
                        <td colspan="9" class="text-center">No data available in table.</td>
                    </tr>
                    @endif
                    @foreach($assigned as $assigned )
                    <tr>
                        <td width="5%">{{$i++}}</td>
                        <td>{{ $assigned->vehicle_name}}</td>
                        <td>{{ $assigned->assignee}}</td>
                        <td>{{ $assigned->start_datte}}</td>
                        <td>{{ $assigned->odometer}}</td>
                        <td></td>
                        <td></td>
                        <td>{{ $assigned->status}}</td>
                        <td>
                            <form action="" method="get" >
       <a class="btn bg-transparent btn-outline-info"  data-toggle="modal" data-target="#edit{{$assigned->id}}"  ><i style ="color:#5bc0de;" class="material-icons">edit</i> </a>
       @csrf
      {{ method_field('GET') }}

                            <button type="submit" name="archive" onclick="archiveFunction()"
                                class="btn bg-transparent btn-outline-danger"><i
                                    style="color:red; padding-bottom: -50%;" class="material-icons">delete</i> </button>
                            </form>
                        </td>
                    </tr>

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="edit{{$assigned->id}}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Assignment Management</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        {!! csrf_field() !!}
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Vehicle Name</label>
                                <input type="text" class="form-control" id="hod_fullname"
                                    name="{{ $assigned->vehicle_name}}" value="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Assignee</label>
                                <input type="text" class="form-control" id="phone" name="{{$assigned->assignee}}" value="">
                            </div>

                            <div class="form-group col-md-6">
                              <label for="inputEmail4">Due Date</label>
                              <input type="date" class="form-control" id="hod_fullname" name="{{$assigned->start_date}}"
                                  value="">
                          </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Odometer</label>
                                <input type="text" class="form-control" id="hod_fullname" name="{{$assigned->odometer}}"
                                    value="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">End Date</label>
                                <input type="text" class="form-control" id="hod_fullname" name=""
                                    value="">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="inputEmail4">End Odometer</label>
                              <input type="text" class="form-control" id="hod_fullname" name=""
                                  value="">
                          </div>

                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Status</label>
                            <input type="text" class="form-control" id="hod_fullname" name="{{$assigned->status}}"
                                value="">
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
        {{-- {{ $assigned->links() }} --}}
    </div>
</div>
</div>
</div>
</div>

@stop
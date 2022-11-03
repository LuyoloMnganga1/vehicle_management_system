@extends('layouts.main')
@section('content')



<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-header-text">
            <div class="row">
                <div class="col-md-9">
                    <h4 class="card-title">Assignment Management</h4>
                </div>
                <div class="col-md-3">
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
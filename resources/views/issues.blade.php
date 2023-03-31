@extends('layouts.main')
@section('title')
Issues
@endsection
@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Issue</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('addIssue')}}" method="post">
                    {!! csrf_field() !!}
                    <!-- {!! method_field('GET') !!}  -->

                    <div class="row">
                       
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Vehicle Name</label>
                            <input type="text" class="form-control" id="hod_fullname" name="vehicle_name" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Assignee</label>
                            <input type="text" class="form-control" id="phone" name="assignee" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Title</label>
                            <input type="text" class="form-control" id="hod_fullname" name="title" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Description</label>
                            <input type="text" class="form-control" id="hod_fullname" name="description" value="">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">File Upload</label>
                            <div class="custom-file">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <input type="file" class="custom-file-input rounded-circle" id="customFile"
                                    name="issue_image" accept=".jpg,.jpeg,.bmp,.png,.gif,.jfif"
                                    onchange="displayImg(this,$(this))">


                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center col-md-12">
							<img src="img/placeholder.jpg" alt="" id="timg1" class="img-fluid img-thumbnail">
						</div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Priority</label>
                            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"
                                name="priority">
                                <option selected>Choose...</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Due Date</label>
                            <input type="date" class="form-control" id="hod_fullname" name="due_date" value="">
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
                    <h4 class="card-title">Manage Issues</h4>
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
                        <th scope="col">Vihicle</th>
                        <th scope="col">Driver</th>
                        <th scope="col">Title</th>
                        <th scope="col">Due Date</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($issue->count() == 0)
                    <tr>
                        <td colspan="8" class="text-center">No data available in table.</td>
                    </tr>
                    @endif
                    @foreach($issue as $issue )
                    <tr>
                        <td width="5%">{{$i++}}</td>
                        <td>{{ $issue->vehicle_name}}</td>
                        <td>{{ $issue->assignee}}</td>
                        <td>{{ $issue->title}}</td>
                        <td>{{ $issue->due_date}}</td>
                        <td>{{ $issue->priority}}</td>
                        <td>{{ $issue->status}}</td>
                        <td>
                            <form action="{{route('deleteIssue',$issue->id)}}" method="get">
                                <a class="btn bg-transparent btn-outline-info" data-toggle="modal"
                                    data-target="#edit{{$issue->id}}"><i style="color:#5bc0de;" class="material-icons">edit</i> </a>
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
                    <div class="modal fade" id="edit{{$issue->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Update Issue</h5>
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
                                                <input type="text" class="form-control" id="hod_fullname" name="{{$issue->vehicle_name}}" value="">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Assignee</label>
                                                <input type="text" class="form-control" id="phone" name="{{$issue->assignee}}" value="">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Title</label>
                                                <input type="text" class="form-control" id="hod_fullname" name="{{$issue->title}}" value="">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Description</label>
                                                <input type="text" class="form-control" id="hod_fullname" name="{{$issue->description}}" value="">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">File Upload</label>
                                                <div class="custom-file">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                    <input type="file" class="custom-file-input rounded-circle" id="customFile"
                                                        name="issue_image" accept=".jpg,.jpeg,.bmp,.png,.gif,.jfif"
                                                        onchange="displayImg2(this,$(this))">
                    
                    
                                                </div>
                                            </div>
                                            <div class="form-group d-flex justify-content-center col-md-12">
                                                <img src="{{ $issue->issue_image}}"  alt="" id="timg" class="img-fluid img-thumbnail">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Priority</label>
                                                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"
                                                    name="priority">
                                                    <option selected>{{$issue->priority}}</option>
                                                    <option value="Low">Low</option>
                                                    <option value="Medium">Medium</option>
                                                    <option value="High">High</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Due Date</label>
                                                <input type="date" class="form-control" id="hod_fullname" name="{{$issue->due_date}}" value="">
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
@section('scripts')

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


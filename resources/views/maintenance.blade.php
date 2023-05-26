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
                        data-target="#exampleModalCenter"> <i class="fa fa-plus"></i> Add New Issue</button>
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
                        <th scope="col">Registration No</th>
                        <th scope="col">Assigned Driver</th>
                        <th scope="col">Evidence</th>
                        <th scope="col">Issue Subject</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Due Date</th>
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
          <h5 class="modal-title" id="exampleModalLongTitle">Add Issue</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('addIssue') }}"  enctype="multipart/form-data" method="POST">
            @csrf
        <div class="modal-body">
         <div class="row">   
            @php
                 $vehicle = App\Models\Vehicle::orderBy('Registration_no', 'ASC')->get();
            @endphp
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
            <input type="hidden" name="assignee" value="">
            <div class="col-md-6">
            <div class="form-group">
                <label for="">Issue Subject</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                <label for="">Issue Description</label>
                <textarea  name="description" id="description" cols="10" rows="3" class="form-control" required></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Issue Evidence</label>
                <input type="file" name="issue_image" id="issue_image" class="form-control" accept=".jpg,.jpeg,.bmp,.png,.gif,.jfif" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Priority</label>
                <select name="priority" id="priority" class="form-control" required>
                    <option value="" selected> Select priority</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Due Date</label>
                <input type="datetime-local" name="due_date" id="due_date" class="form-control" required>
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
<!-- edit issue modal -->
<div class="modal fade" id="update_issue_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Update Issue</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  id="update_issue_form" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
         <div class="row">   
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Registration Number</label>
                    <input type="text" id="update_reg_no" class="form-control" readonly>
                    <input type="hidden" name="vehicle_id" id="update_vehicle_id">
                </div>
            </div>
            <input type="hidden" name="assignee" value="">
            <div class="col-md-6">
            <div class="form-group">
                <label for="">Issue Subject</label>
                <input type="text" name="title" id="update_title" class="form-control" required>
            </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                <label for="">Issue Description</label>
                <textarea  name="description" id="update_description" cols="10" rows="3" class="form-control" required></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Issue Evidence</label>
                <input type="file" name="issue_image" id="issue_image" class="form-control" accept=".jpg,.jpeg,.bmp,.png,.gif,.jfif">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Priority</label>
                <select name="priority" id="priority" class="form-control" required>
                    <option value="" selected> Select priority</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Due Date</label>
                <input type="datetime-local" name="due_date" id="update_due_date" class="form-control" required>
            </div>
        </div>
        <input type="hidden" name="previous_image" id="previous_image">
         <div class="form-group">
            <div class="col-md-12">
            <label for="">Previous Evidence</label>
            <img src=""  id="update_previous_image" class="form-control" alt="previous evidence" style="max-width:350px;max-height:400px;min-width:200px;min-height:350px">
         </div>
         </div>
     </div>
    </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- end of edit issue modal -->
  {{-- view issue moal --}}
<div class="modal fade" id="issue_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">View Issue</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center h5 mb-0 text-blue">Issue Information</h5>
                <small class="text-center text-muted font-14">Bellow is the details of the issue</small>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>
                                <span>Vehicle Registration Number :</span>
                                <p class="view_issue" id="view_issue_reg_no"></p>
                            </li>
                            <li>
                                <span>Issue Subject :</span>
                                <p class="view_issue" id="view_issue_subject"></p>
                            </li>
                            <li>
                                <span>Priority  :</span>
                                <p class="view_issue" id="view_issue_priority"></p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul>
                            <li>
                                <span>Issue By :</span>
                                <p class="view_issue" id="view_issue_by"></p>
                            </li>
                            <li>
                                <span>Issue Description :</span>
                                <p class="view_issue" id="view_issue_description"></p>
                            </li>
                            <li>
                                <span>Due Date :</span>
                                <p class="view_issue" id="view_issue_due_date"></p>
                            </li>
                        </ul>
                    </div>

                </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Issue Image</label>
                            <img src="" alt="issue image" class="form-control" id="view_issue_image" style="width: 250px;height:300px">
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
{{--  end of view issue moal --}}
@endsection

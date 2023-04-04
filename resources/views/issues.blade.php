@extends('layouts.main')
@section('title')
Issue
@endsection
@section('content')

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-header-text mb-4">
            <div class="row">
                <div class="col-md-10">
                    <h4 class="card-title">List of Issues</h4>
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
            <input type="hidden" name="assignee" value="{{ Auth::user()->id }}">
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
            <input type="hidden" name="assignee" value="{{ Auth::user()->id }}">
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
                <hr></hr>
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
        ajax: "{{ route('getissues') }}",
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
                data: 'vehicle_plate',
                name: 'vehicle_plate',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'assignee',
                name: 'assignee',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'issue_image',
                name: 'issue_image',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'title', 
                name: 'title',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'priority', 
                name: 'priority',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'due_date', 
                name: 'due_date',
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
            $.get('/find-issue/'+ id, function(data){
                var url = "{{ route('updateIssue',['id'=>':id'] )}}";
                url = url.replace(':id',id);
                $('#update_reg_no').val(data.vehicle_plate);
                $('#update_vehicle_id').val(data.vehicle_id);
                $('#update_title').val(data.title);
                $('textarea#update_description').val(data.description);
                $('#update_due_date').val(data.issue_date_due);
                $('#previous_image').val(data.issue_image);
                $('#update_previous_image').attr('src',data.issue_image);
                $('#update_issue_form').attr('action',url);
                $('#update_issue_info').modal('show');
            })
        });

         /* view driver */
         $('body').on('click', '.view', function() {
            $('.view_issue').empty();
            var issue_id = $(this).data('id');
           $.get('/find-issue/'+ issue_id, function(data){
                $('#view_issue_reg_no').append(data.vehicle_plate);
                $('#view_issue_subject').append(data.title);
                $('#view_issue_description').append(data.description);
                $('#view_issue_by').append(data.assignee);
                $('#view_issue_priority').append(data.priority);
                $('#view_issue_due_date').append(data.due_date);
                $('#view_issue_image').attr('src',data.issue_image);
                $('#issue_info').modal('show');
           });
        });


         /*delete  driver */
         $('body').on('click', '#delete', function() {
           $('#delete_record').modal('show');
           $('#yes').on('click',function(){
               var id = $('#delete').data('id');
               var url=  '/deleteIssue/'+ id;             
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
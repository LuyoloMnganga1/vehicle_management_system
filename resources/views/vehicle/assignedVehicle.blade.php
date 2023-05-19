@extends('layouts.main')
@section('title')
Assigned Vehicles
@endsection
@section('content')


    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-text mb-4">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="card-title">List of Assiged Vehicles</h4>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#vehicle_assign_modal"> <i class="fa fa-plus"></i> Assign Vehicle</button>
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
                            <th scope="col">Full Name</th>
                            <th scope="col">License Number</th>
                            <th scope="col">Assigned Date</th>
                            <th scope="col">Registration Number</th>
                            <th scope="col">Status</th>
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


 
   <!-- Modal -->
   <div class="modal fade" id="vehicle_assign_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLongTitle">Assign Vehicle</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <form action="{{ route('addAssigned') }}" method="post">
                   {!! csrf_field() !!}
                   <div class="row">
                     @php
                         $driver = \App\Models\Driver::join('users','drivers.user_id','=','users.id')->latest('drivers.created_at')->get();
                     @endphp
                       <div class="form-group col-md-6">
                           <label for="inputEmail4">Driver Full Name</label>
                           <select class="custom-select my-1 mr-sm-2" id="selected_driver"
                               name="">
                               <option selected>Select driver</option>
                               @foreach ($driver as $item)                            
                                   <option  value="{{ $item->user_id }}">{{$item->name}} {{$item->surname}}</option>
                               @endforeach
                           </select>
                       </div>
                       <input type="hidden" name="assignee" id="assignee">
                       <div class="form-group col-md-6">
                           <label for="inputEmail4">Email Address</label>
                           <input type="email" class="form-control" name="email" id="driver_email"  readonly>
                       </div>
                       <div class="form-group col-md-6">
                           <label for="inputEmail4">License Number</label>
                           <input type="text" class="form-control"  name="licence_no" id="driver_licence_no"  readonly>
                       </div>
                       <div class="form-group col-md-6">
                           <label for="inputEmail4">Department</label>
                           <input type="text" class="form-control" name="department" id="driver_department"  readonly>
                       </div>
                       @php
                         $vehicles = \App\Models\Vehicle::all();
                     @endphp
                       <div class="form-group col-md-6">
                           <label for="inputEmail4">Registration Number</label>
                           <select name="Registration_no" id=""  class="custom-select my-1 mr-sm-2">
                           <option selected>Select Registration number</option>
                           @foreach ($vehicles as $item)                            
                               <option  value="{{ $item->Registration_no }}">{{$item->vehicle_name}}  {{ $item->vehicle_type }} {{$item->vehicle_model}} ({{$item->Registration_no}})</option>
                           @endforeach
                        </select>
                       </div>
                       <div class="form-group col-md-6">
                           <label for="inputEmail4">Odometer</label>
                           <input type="text" class="form-control" name="odometer" >
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
   <!-- Modal -->
   <div class="modal fade" id="view_modal" tabindex="-1" role="dialog"
   aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLongTitle">View Assigded Details</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <form action="" method="post" id="">
                   {!! csrf_field() !!}
                   <div class="row">
                       <div class="form-group col-md-6">
                           <label for="inputEmail4">Driver Full Name: </label>
                           <span id="view_assignee" class="view_info"></span>
                       </div>
                       <div class="form-group col-md-6">
                           <label for="inputEmail4">Email Address: </label>
                           <span id="view_email" class="view_info"></span>
                       </div>
                       <div class="form-group col-md-6">
                           <label for="inputEmail4">License Number: </label>
                           <span id="view_licence_no" class="view_info"></span>
                       </div>
                       <div class="form-group col-md-6">
                           <label for="inputEmail4">Department: </label>
                           <span id="view_department" class="view_info"></span>
                       </div>
                       <div class="form-group col-md-6">
                           <label for="inputEmail4">Registration Number: </label>
                           <span id="view_reg" class="view_info"></span>
                         
                       </div>
                       <div class="form-group col-md-6">
                           <label for="inputEmail4">Odometer: </label>
                           <span id="view_odometer" class="view_info"></span>
                       </div>
                       <div class="form-group col-md-6">
                           <label for="inputEmail4">Status: </label>
                           <span id="view_status" class="view_info"></span>
                       </div>
                       <div class="form-group col-md-12">
                           <label for="inputEmail4">Comment: </label>
                           <span id="view_comment" class="view_info"></span>
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
{{-- end modal  --}}
       <!-- Modal -->
       <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Assigded Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="assigne_update_form">
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Driver Full Name</label>
                                <input type="text" class="form-control update_info" name="assignee" id="update_assignee" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email Address</label>
                                <input type="email" class="form-control update_info" name="email" id="update_email"  readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">License Number</label>
                                <input type="text" class="form-control update_info"  name="licence_no" id="update_licence_no"  readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Department</label>
                                <input type="text" class="form-control update_info" name="department" id="update_department"  readonly>
                            </div>
                            @php 
                              $vehicles = \App\Models\Vehicle::all();
                          @endphp
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Registration Number</label>
                                <select name="Registration_no" id=""  class="custom-select my-1 mr-sm-2 ">
                                <option selected>Select Registration number</option>
                                @foreach ($vehicles as $item)                            
                                    <option  value="{{ $item->Registration_no }}">{{$item->vehicle_name}}  {{ $item->vehicle_type }} {{$item->vehicle_model}} ({{$item->Registration_no}})</option>
                                @endforeach
                             </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Odometer</label>
                                <input type="text" class="form-control update_info" name="odometer" id="update_odometer">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Status</label>
                                <select class="custom-select my-1 mr-sm-2 " id="inlineFormCustomSelectPref"
                                    name="assigned_status">
                                    <option selected>Choose...</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Comment</label>
                                <textarea type="date" class="form-control update_info" name="comment" id="update_comment" value=""></textarea>
                            </div>
                            
        
        
        
                        </div>
        
        
                        <div class="modal-footer">
                                                
                          <button type="submit" class="btn btn-primary">Update</button>
                          <button type="button" class="btn btn-secondary"
                              data-dismiss="modal">Cancel</button>
                      </div>
        
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- end modal  --}}

@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $('#selected_driver').on('change', function(){
            var driver_id = $(this).val();
            $.get('/find-driver/'+ driver_id, function(data){
                $('#assignee').val(data.name + ' ' + data.surname);
                $('#driver_email').val(data.email);
                $('#driver_licence_no').val(data.licence_no);
                $('#driver_department').val(data.department);
            });
        });
        
        /* edit driver */
        $('body').on('click', '.edit', function() {
            $('.update_info').empty();
            var assignment_id = $(this).data('id');
            url = "{{ route('updateVehicle',['id'=>':id']) }}";
            url = url.replace(':id', assignment_id);
           $.get('/findAssignment/'+ assignment_id, function(data){
                $('#assigne_update_form').attr('action',url)
                $('#update_assignee').val(data.assignee);
                $('#update_email').val(data.email);
                $('#update_licence_no').val(data.licence_no);
                $('#update_department').val(data.department);
                $('#update_odometer').val(data.odometer);
                $('textarea#update_comment').val(data.comment);
                $('#edit_modal').modal('show');               
           });
        });

        /* view driver */
        $('body').on('click', '.view', function() {
            $('.view_info').empty();
            var assignment_id = $(this).data('id');
           $.get('/findAssignment/'+ assignment_id, function(data){
                $('#view_assignee').append(data.assignee);
                $('#view_email').append(data.email);
                $('#view_licence_no').append(data.licence_no);
                $('#view_department').append(data.department);
                $('#view_reg').append(data.Registration_no);
                $('#view_odometer').append(data.odometer);
                if(data.status == 'Active'){
                    $('#view_status').append('<span class="badge badge-success">'+data.status+'</span>');
                }else{
                    $('#view_status').append('<span class="badge badge-danger">'+data.status+'</span>');
                }
                $('#view_comment').append(data.comment);
                $('#view_modal').modal('show');               
           });
        });

        /*delete  driver */
        $('body').on('click', '.delete', function() {
           $('#delete_record').modal('show');
           $('#yes').on('click',function(){
               var url=  $('#delete').data('href');
               location.href = url;
           })
        });

    });
</script>
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
        ajax: "{{ route('getAssignedDrivers') }}",
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
                data: 'assignee',
                name: 'assignee',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'licence_no',
                name: 'licence_no',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'updated_at',
                name: 'updated_at',
                orderable: true,
                searchable: true,
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
                data: 'assigned_status', 
                name: 'assigned_status',
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
@endsection
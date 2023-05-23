
@extends('layouts.main')
@section('content')
<div class="row ">
    @if(Auth::User()->hasRole('Admin') || Auth::User()->hasRole('SuperAdmin') || Auth::user()->hasRole('General-Manager'))
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Register User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('registerStore')}}" method="post">
                                            {!! csrf_field() !!}
                                            <!-- {!! method_field('GET') !!}  -->
                                           <div class="row">
                                                <div class="col-md-3">
                                                        <label for="Title" class="form-label">Title</label>
                                                        <select class=" form-control form-select form-select-lg mb-1 h-50" value = "{{ old('title')}}" required name = "title"  id = "title" aria-label=".form-select-lg example">
                                                            <option value="" selected >None</option>
                                                            <option value="Mr.">Mr.</option>
                                                            <option value="Mrs.">Mrs.</option>
                                                            <option value="Ms.">Ms.</option>
                                                            <option value="Dr."> Dr.</option>
                                                            <option value="Esq.">Esq.</option>
                                                            <option value="Hon.">Hon.</option>
                                                            <option value="Jr.">Jr.</option>
                                                            <option value="Msgr.">Msgr.</option>
                                                            <option value="Prof.">Prof.</option>
                                                            <option value="Rev.">Rev.</option>
                                                            <option value="Rt. Hon.">Rt. Hon.</option>
                                                            <option value="Sr.">Sr.</option>
                                                            <option value="St.">St.</option>
                                                        </select>
                                                    </div>
                                                <div class="col-md-4">
                                                    <label for="Name" class="form-label">Name</label>
                                                    <input type="text" name = "name" placeHolder = "John" class="form-control" id="name" value = "{{ old('name')}}"  required>
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="surname" class="form-label">Surname</label>
                                                    <input type="text" placeHolder = "example" name = "surname" value = "{{ old('surname')}}"  class="form-control" id="surname"  required >
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="surname" class="form-label">Id No.</label>
                                                    <input type="text" placeHolder = "2303300876089" name = "id_no"  pattern="[0-9]{13}" value = "{{ old('id_no')}}" class="form-control" id="id_no" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="Name" class="form-label">Gender</label>
                                                    <select  name ="gender" class=" form-control form-select form-select-lg mb-1 h-50" id="gender" value = "{{ old('gender')}}" required aria-label=".form-select-lg example">
                                                        <option value ="" selected >None</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="Email" class="form-label">Email</label>
                                                    <input type="email"  placeHolder = "john.example@ictchoice.co.za" value = "{{ old('email')}}" name = "email" class="form-control" id="Email" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="surname" class="form-label">Mobile Number</label>
                                                    <input type="text" placeHolder = "0123456789" name = "phone"  value = "{{ old('phone')}}" class="form-control" id="phone"  pattern="[0-9]{10}" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="Name" class="form-label">Communication</label>
                                                    <select  name ="communication" class=" form-control form-select form-select-lg mb-1 h-50" value = "{{ old('communication')}}" required aria-label=".form-select-lg example">
                                                        <option value ="" selected >None</option>
                                                        <option value="Email">Email</option>
                                                        <option value="SMS">SMS</option>
                                                        <option value="Both">Both</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="apointment_date" class="form-label">Appointment Date</label>
                                                    <input type="date"  name = "apointment_date"  value = "{{ old('apointment_date')}}" class="form-control" id="apointment_date" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="department" class="form-label">Department</label>
                                                    <select name = "department" class=" form-control form-select form-select-lg mb-1 h-50"  value = "{{ old('department')}}" required aria-label=".form-select-lg example">
                                                <option value ="" selected >None</option>
                                                @foreach ($dep as $item)
                                                <option value="{{ $item->name }}"> {{$item->name}}</option>
                                                @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="apointment_date" class="form-label">Job title</label>
                                                    <input type="text"  name = "job_title"  value = "{{ old('job_title')}}" class="form-control" id="job_title" required>
                                                </div>
                                            <div class="col-md-4">
                                                    <label for="Name" class="form-label">Register As</label>
                                                    <select name = "role" class=" form-control form-select form-select-lg mb-1 h-50" value = "{{ old('role')}}" required aria-label=".form-select-lg example">
                                                        <option selected >None</option>
                                                        <option value="Admin">Admin</option>
                                                        <option value="User">User</option>
                                                        <option value="department-head">Department-head</option>
                                                       <option value="SuperAdmin">SuperAdmin</option>
                                                       <option value="General-Manager">General Manager</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="surname" class="form-label">Location</label>
                                                    <input type="text" placeHolder = "East London, Eastern Cape" name = "location"  value = "{{ old('location')}}" class="form-control" id="location"   required>
                                                </div>
                                                <div class="col-md-1" style="margin-left: 3%;">
                                                     <input type="checkbox" class="form-check-input" required>
                                               </div>
                                                <div class="col-md-11" style="margin-left: 3%;">
                                                    <small class="form-check-label" for="materialIndeterminate2">To the best of my knowledge, the information I have provided is true and full. I understand that this self-declaration statement will be reviewed and verified, and that if any of the information is false, I may be fired from ICT Choice for fraud and/or perjury.</small>
                                                </div>

                                          </div>

                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Add</button>
                                            </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    @endif

                        <div class="col-lg-12 col-md-12">
                            <div class="card" >
                                <div class="card-header card-header-text">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h4 class="card-title">List of Staff Members</h4>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus"></i> Add Staff member</button>
                                    </div>
                                </div>
                                <br>
                                <div class="card-content table-responsive">
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
                                <div class="pb-20 table-responsive">
                                    <table class="table table-hover" >
                                        <thead class="thead-naive">
                                            <tr>
                                            <th scope ="col">#</th>
                                            <th scope ="col"> Full Name</th>
                                            <th scope ="col">Email</th>
                                            <th scope ="col">Phone</th>
                                            <th scope ="col">Department</th>
                                            <th scope ="col">Role</th>
                                            <th scope ="col">Action</th>
                                        </tr>
                                        </thead>
                                         <tbody>
                                            @if ($user->count() == 0)
                                            <tr>
                                                <td colspan="5" class="text-center">No data available in table.</td>
                                            </tr>
                                        @endif
                                        @foreach ($user as $item)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{ $item->name }} {{ $item->surname }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->department }}</td>
                                            <td>{{ $item->role }}</td>
                                                <td>
                                                <form action="{{ url('staffdestroy', $item->id) }}" method="POST">
                                                <a class="btn bg-transparent btn-outline-info btn-sm"  data-toggle="modal" data-target="#editUser{{$item->id}}"><i  style ="color:#5bc0de;" class="material-icons">edit</i> </a>
                                                @csrf
                                                {{ method_field('GET') }}

                                                <button type="submit" name="archive" onclick="return archiveFunction()" class="btn bg-transparent btn-outline-danger btn-sm"><i style ="color:red;" class="material-icons">delete</i> </button>
                                                </form>
                                                </td>
                                            </tr>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade bd-example-modal-lg" id ="editUser{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Update Staff</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <form  action ="{{ route('staffUpdate', $item->id)}}" method ="post">
                                            {!! csrf_field() !!}
                                            <div class="row">
                                            <div class="col-md-3 form-group">
                                                    <label for="Title" class="form-label">Title</label>
                                                    <select class=" form-control form-select form-select-lg mb-1 h-50"  required name = "title" id = "title" aria-label=".form-select-lg example">
                                                        <option value="" selected disabled>select title</option>
                                                        <option value="Mr.">Mr.</option>
                                                        <option value="Mrs.">Mrs.</option>
                                                        <option value="Ms.">Ms.</option>
                                                        <option value="Dr."> Dr.</option>
                                                        <option value="Esq.">Esq.</option>
                                                        <option value="Hon.">Hon.</option>
                                                        <option value="Jr.">Jr.</option>
                                                        <option value="Msgr.">Msgr.</option>
                                                        <option value="Prof.">Prof.</option>
                                                        <option value="Rev.">Rev.</option>
                                                        <option value="Rt. Hon.">Rt. Hon.</option>
                                                        <option value="Sr.">Sr.</option>
                                                        <option value="St.">St.</option>
                                                    </select>
                                                </div>
                                            <div class="col-md-4">
                                                <label for="Name" class="form-label">Name</label>
                                                <input type="text" name = "name" placeHolder = "John" class="form-control" id="name" value = "{{$item->name}}"  required>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="surname" class="form-label">Surname</label>
                                                <input type="text" placeHolder = "example" name = "surname" value = "{{$item->surname}}"  class="form-control" id="surname"  required >
                                            </div><br>
                                            <div class="col-md-4">
                                                <label for="surname" class="form-label">Id No.</label>
                                                <input type="text" placeHolder = "2303300876089" name = "id_no"   pattern="[0-9]{13}"  value = "{{$item->id_no}}" class="form-control" id="id_no" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="Name" class="form-label">Gender</label>
                                                <select  name ="gender" class=" form-control form-select form-select-lg mb-1 h-50"  id="gender" required aria-label=".form-select-lg example">
                                                    <option value ="" selected disabled>select gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="Email" class="form-label">Email</label>
                                                <input type="email"  placeHolder = "john.example@ictchoice.co.za" value = "{{ $item->email}}" name = "email" class="form-control" id="Email" required>
                                            </div>
                                            @php
                                            if (str_starts_with($item->phone, '+27')){
                                               $item->phone = "0".substr($item->phone,3);
                                           }
                                           @endphp
                                            <div class="col-md-4">
                                                <label for="surname" class="form-label">Mobile Number</label>
                                                <input type="text" placeHolder = "0123456789" name = "phone"  value = "{{ $item->phone}}" class="form-control" id="phone"  pattern="[0-9]{10}" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="Name" class="form-label">Communication</label>
                                                <select  name ="communication" class=" form-control form-select form-select-lg mb-1 h-50"  required aria-label=".form-select-lg example">
                                                    <option value ="" selected disabled> select communication</option>
                                                    <option value="Email">Email</option>
                                                    <option value="SMS">SMS</option>
                                                    <option value="Both">Both</option>
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="apointment_date" class="form-label">Appointment Date</label>
                                                <input type="date"  name = "apointment_date"  value = "{{ $item->apointment_date}}" class="form-control" id="apointment_date" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="department" class="form-label">Department</label>
                                                <select name = "department" class=" form-control form-select form-select-lg mb-1 h-50"   required aria-label=".form-select-lg example">
                                            <option value ="" selected >Select Department</option>
                                            @foreach ($dep as $deps)
                                            <option value="{{ $deps->name }}"> {{$deps->name}}</option>
                                            @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="apointment_date" class="form-label">Job title</label>
                                                <input type="text"  name = "job_title"  value = "{{$item->job_title}}" class="form-control" id="job_title" required>
                                            </div>
                                        <div class="col-md-5">
                                                <label for="Name" class="form-label">Register As</label>
                                                <select name = "role" class=" form-control form-select form-select-lg mb-1 h-50"  required aria-label=".form-select-lg example">
                                                    <option selected disabled>Select role</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="User">User</option>
                                                    <option value="department-head">Department-head</option>
                                                  <option value="SuperAdmin">SuperAdmin</option>
                                                  <option value="General-Manager">General Manager</option>
                                                </select>
                                            </div>
                                            <div class="col-md-7">
                                                <label for="surname" class="form-label">Location</label>
                                                <input type="text" placeHolder = "East London, Eastern Cape" name = "location"  value = "{{$item->location}}" class="form-control" id="location"   required>
                                            </div>


                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
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
                                        {{$user->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
</div>
<script>
    $("#title").change(function () {
        var title = $(this).val();
        if (title == 'Mr.'){
            document.getElementById("gender").value = "Male";
        }else if (title == 'Mrs.' || title == 'Ms.'){
            document.getElementById("gender").value = "Female";
        }else{
            document.getElementById("gender").value = "";
        }

    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $("#id_no").change(function(){

    var idNumber = $('#id_no').val();

    // SA ID Number have to be 13 digits, so check the length
    if (idNumber.length != 13 || !isNumber(idNumber)) {
            swal({
                    title: "ID number!",
                    text: "ID number does not appear to be authentic - input not a valid number!",
                    icon: "error",
                    button: "Okay",
                });
        document.getElementById("id_no").value = "";
    }

    // get first 6 digits as a valid date
    var tempDate = new Date(idNumber.substring(0, 2), idNumber.substring(2, 4) - 1, idNumber.substring(4, 6));

    var id_date = tempDate.getDate();
    var id_month = tempDate.getMonth();
    var id_year = tempDate.getFullYear();

    var fullDate = id_date + "-" + (id_month + 1) + "-" + id_year;

    if (!((tempDate.getYear() == idNumber.substring(0, 2)) && (id_month == idNumber.substring(2, 4) - 1) && (id_date == idNumber.substring(4, 6)))) {
        swal({
                    title: "ID number!",
                    text: "ID number does not appear to be authentic - date part not valid!",
                    icon: "error",
                    button: "Okay",
            });
        document.getElementById("id_no").value = "";
    }

    // get the gender
    var genderCode = idNumber.substring(6, 10);
    var gender = parseInt(genderCode) < 5000 ? "Female" : "Male";

    var genderField = document.getElementById("gender").value;

    if (genderField !== null){
        if(gender !== genderField){
            swal({
                        title: "Gender!",
                        text: "Gender must must match your ID Number and Title!",
                        icon: "error",
                        button: "Okay",
                });
            document.getElementById("title").value = "";
            document.getElementById("gender").value = "";
            document.getElementById("id_no").value = "";
        }
    }

    // get country ID for citzenship
    var citzenship = parseInt(idNumber.substring(10, 11)) == 0 ? "Yes" : "No";

    // apply Luhn formula for check-digits
    var tempTotal = 0;
    var checkSum = 0;
    var multiplier = 1;
    for (var i = 0; i < 13; ++i) {
        tempTotal = parseInt(idNumber.charAt(i)) * multiplier;
        if (tempTotal > 9) {
            tempTotal = parseInt(tempTotal.toString().charAt(0)) + parseInt(tempTotal.toString().charAt(1));
        }
        checkSum = checkSum + tempTotal;
        multiplier = (multiplier % 2 == 0) ? 1 : 2;
    }
    if ((checkSum % 10) != 0) {
        swal({
                    title: "ID  number!",
                    text: "ID number does not appear to be authentic - check digit is not valid!",
                    icon: "error",
                    button: "Okay",
            });
        document.getElementById("id_no").value = "";
    };
});
</script>
<script>
function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}
</script>
@stop

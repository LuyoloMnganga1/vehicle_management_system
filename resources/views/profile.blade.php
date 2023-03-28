
    @extends('layouts.main')
        @section('content')
        <style>

           fieldset.scheduler-border {
            border: 2px groove #ddd !important;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow: 0px 0px 0px 0px #000;
            box-shadow: 0px 0px 0px 0px #000;
           }

           legend.scheduler-border{
            font-size: 1.2em !important;
            font-weight: bold !important;
            text-align: left !important;
            width: auto;
            padding: 0 10px;
            border-bottom: none;
           }

           fieldset, legend {
            all: revert;
            }
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
.flex-row {
    display: flex;
}
.wrapper {
    border: 1px solid #18345D;
    border-right: 0;
}
canvas#signature-pad {
    background: #fff;
    width: 100%;
    height: 100%;
    cursor: crosshair;
}
button#clear {
    height: 100%;
    background: #18345D;
    border: 1px solid transparent;
    color: #fff;
    font-weight: 600;
    cursor: pointer;
}
button#clear span {
    transform: rotate(90deg);
    display: block;
}
        </style>
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
@if ($error = Session::get('error'))
    <div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p>{{ $error }}</p>
            </div>
@endif
<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
        <div class="pd-20 card height-100-p">
            <div class="card-body">
           <div class="profile-photo">
            <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i  style="margin-top:30%;" class="fa fa-pencil"></i></a>
                <img class="img-md rounded-circle" src="{{Auth::user()->profile}}" style="width:90%;hieght:100%;" alt="Profile image">
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Profile Image Update</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form method="post" action="{{route('image/update')}}" enctype="multipart/form-data">
                                @csrf
                            <div class="modal-body">
                                <div class="weight-500 col-md-12 pd-5">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input name="image" id="file" type="file" class="custom-file-input" accept=".jpg,.jpeg,.bmp,.png,.gif,.jfif" required>
                                            <label class="custom-file-label" for="file" id="selector">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                          </div>
                        </div>
                      </div>
            </div>
            <h5 class="text-center h5 mb-0">{{Auth::user()->name}} {{Auth::user()->surname}}</h5>
            <p class="text-center text-muted font-14">{{Auth::user()->department}}</p>
            <div class="profile-info">
                <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                <ul>
                    <li>
                        <span>Email Address:</span>
                        {{Auth::user()->email}}
                    </li>
                    <li>
                        <span>Phone Number:</span>
                        {{Auth::user()->phone}}
                    </li>
                    <li>
                        <span>My Role:</span>
                        {{Auth::user()->role}}
                    </li>
                    <li>
                        <span>Location:</span>
                        {{Auth::user()->location}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
        <div class="card height-100-p overflow-hidden">
            <div class="card-header">
                <h1>Password Reset</h1>
            </div>
            <div class="card-body height-100-p">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border" >Update Password</legend>
                    <div class="row">

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible" >
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($message = Session::get('message'))
                            <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <p>{{ $message }}</p>
                                    </div>
                        @endif
                        <small style="margin-top: 0.5%;">Ensure you follow this secure way in creating your password. <br>
                            <span style= "color:red;" id="rule1">-	At least be 8 characters long.</span><br>
                            <span style= "color:red;" id="rule2">-	At least have one lower case letter.</span><br>
                            <span style= "color:red;" id="rule3">-	At least have one upper case letter.</span><br>
                            <span style= "color:red;" id="rule4">- At least have one number.</span><br>
                            <span style= "color:red;" id="rule5">- At least have one special character.</span><br>
                        </small>
                        <form  class="row g-3" action="{{route('reset-PasswordByUser') }}"  method="post">

                            {!! csrf_field() !!}
                            <input type="hidden" name="email" id="email" value = "{{Auth::User()->email}}">
                            <div class="col-md-6">
                                <label for="Name" class="form-label">Current Password</label>
                                <input type="password" name = "current_password" placeHolder = "************" class="form-control" id="password" value = "{{ old('current_password')}}"  required>
                            </div><br>
                            <div class="col-md-6">
                                <label for="surname" class="form-label">New Password</label>
                                <input type="password" name = "password" placeHolder = "**************" value = "{{ old('password')}}"   class="form-control" id="new_password"   required >
                            </div><br>

                            <div class="col-md-6">
                                <label for="Email" class="form-label">Confirm Password</label>
                                <input type="password"  placeHolder = "**************" value = "{{ old('password_confirmation')}}"  name = "password_confirmation" class="form-control"  id="conform_password" required>
                                <div class="text-danger" style="margin-left: 2%;" id="error_message"></div>
                            </div>


                                <div class="col-md-6" style="margin:5% 0% 0% 40%;">
                                    <div class="custom-control custom-checkbox custom-control-inline">  <button  type="submit" class="btn btn-info text-center">Update</button> </div>
                                </div>
                    </form>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.3.5/signature_pad.min.js" integrity="sha512-kw/nRM/BMR2XGArXnOoxKOO5VBHLdITAW00aG8qK4zBzcLVZ4nzg7/oYCaoiwc8U9zrnsO9UHqpyljJ8+iqYiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div class="col-md-12 col-sm-12 mb-30">
       <div class="card">
            <div class="card-header">
                <h1>Signature</h1>
            </div>
        <div class="card-body">
            {{-- <form action="{{route('signature')}}" method="POST" enctype="multipart/form-data">
                @csrf --}}
            <div class="row">
                <div class="col-md-6">
                    <label for="" class="form-label">Your Signature :</label>
                    @if (Auth::user()->signature == null)
                     <img src="{{Auth::user()->signature}}" alt="Signature" style="display: none">
                    @else
                        <img src="{{Auth::user()->signature}}" alt="Signature">
                    @endif

                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Draw your Signature :</label>
                    <div class="flex-row">
                        <div class="wrapper">
                            <canvas id="signature-pad" width="400" height="200" required> </canvas>
                        </div>
                        <div class="clear-btn">
                            <button id="clear"><span> Clear </span></button>
                        </div>
                     </div>
                </div>
            </div>
            <div class="col-md-6" style="margin:5% 0% 0% 40%;">
                <div class="custom-control custom-checkbox custom-control-inline">  <button id="save"  type="submit" class="btn btn-success text-center">Save</button> </div>
            </div>
        </div>
       </div>
    </div>
</div>
<script type="text/javascript">
    var loader = function(e) {
        let file = e.target.files;

        let show = "<span>Selected file : </span>" + file[0].name;
        let output = document.getElementById("selector");
        output.innerHTML = show;
        output.classList.add("active");
    };

    let fileInput = document.getElementById("file");
    fileInput.addEventListener("change", loader);
</script>
<script>
    var canvas = document.getElementById("signature-pad");

function resizeCanvas() {
    var ratio = Math.max(window.devicePixelRatio || 1, 1);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
}
window.onresize = resizeCanvas;
resizeCanvas();

var signaturePad = new SignaturePad(canvas, {
 backgroundColor: 'rgb(250,250,250)'
});

document.getElementById("clear").addEventListener('click', function(){
 signaturePad.clear();
})

document.getElementById("save").addEventListener("click", function post (event) {

if (signaturePad.isEmpty()) {
    alert("Please provide signature first.");
} else {
    document.body.innerHTML += '<form id="form" action="{{route('signature')}}" method="post"  enctype="multipart/form-data"> @csrf<input type="hidden" name="signature" value="'+signaturePad.toDataURL()+'"></form>';
    document.getElementById("form").submit();

}
});
</script>
<script>
    $(document).ready(function(){
        var upperCase= new RegExp('[A-Z]');
        var lowerCase= new RegExp('[a-z]');
        var numbers = new RegExp('[0-9]');
        var specail_character = new RegExp('[@$!%*#?&]');
        $("#new_password").on("input", function(){
            if( $(this).val().length >= 8){
                document.getElementById("rule1").style.color = 'green';
            }else{
                document.getElementById("rule1").style.color = 'red';
            }
            if($(this).val().match(upperCase)){
                document.getElementById("rule3").style.color = 'green';
            }else{
                document.getElementById("rule3").style.color = 'red';
            }
            if($(this).val().match(lowerCase)){
                document.getElementById("rule2").style.color = 'green';
            }else{
                document.getElementById("rule2").style.color = 'red';
            }
            if($(this).val().match(numbers)){
                document.getElementById("rule4").style.color = 'green';
            }else{
                document.getElementById("rule4").style.color = 'red';
            }
            if($(this).val().match(specail_character)){
                document.getElementById("rule5").style.color = 'green';
            }else{
                document.getElementById("rule5").style.color = 'red';
            }

        });
        $("#conform_password").on("input", function(){
            var new_password =  $("#new_password").val();
            if ($(this).val() != new_password){
                $("#error_message").text('New Password and Confirm Password do not match!');
            }else{
                $("#error_message").text('');
            }
        });

    });
    </script>
@stop

<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Site favicon -->
    <link rel="icon" href="{{asset('images/logo.png')}}" sizes="16x16" type="{{asset('images/logo.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>

    	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/core.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/style.css')}}">

    <script type="text/javascript">
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
      </script>
</head>
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
       color: white !important;
       background-color: transparent !important;
       border-color: #18345D !important;

}
   .thead-naive{
       color: white !important;
       background-color: #18345D !important;
       border: 5px solid #C3bE5C !important;
   }
   .btn-naive{
       color: white !important;
       background-color: #18345D !important;
   }

.loader-wrapper{
width:100%;
height: 100%;
position: absolute;
top: 0;
left: 0;
background-color: #fff;
display: flex;
justify-content: center;
align-items: center;
z-index: 999;
}

.ring{
width: 200px;
height: 200px;
border: 0px solid #18345d;
border-radius: 50%;
position: absolute;
}

.ring:nth-child(1){
border-bottom-width: 8px;
border-color: #18345d;
animation: rotate1 2s linear infinite;
}
.ring:nth-child(2){
border-right-width: 8px;
border-color: #C3bE5C;
animation: rotate2 2s linear infinite;
}
.ring:nth-child(3){
border-top-width: 8px;
border-color: #8689a1;
animation: rotate3 2s linear infinite;
}

.loading{
color: black;
}

@keyframes rotate1 {
0% {  transform: rotateX(35deg) rotateY(-45deg) rotateZ(0deg);  }

100% { transform: rotateX(35deg) rotateY(-45deg) rotateZ(360deg); }
}
@keyframes rotate2 {
0% {  transform: rotateX(50deg) rotateY(10deg) rotateZ(0deg);  }

100% { transform: rotateX(50deg) rotateY(10deg) rotateZ(360deg); }
}
@keyframes rotate3 {
0% {  transform: rotateX(35deg) rotateY(55deg) rotateZ(0deg);  }

100% { transform: rotateX(35deg) rotateY(55deg) rotateZ(360deg); }
}
.menu-block .sidebar-menu ul .active {
     color: white !important;
     background-color: #C3bE5C !important;
     border: 5px solid #C3bE5C !important;
 }
 .left-side-bar{
     border-right: 5px solid #C3bE5C !important;
 }
 .systemname
{
   font-size:2.5vw !important;
}
</style>

<body class="d-flex flex-column min-vh-100">
   <div class="loader-wrapper">
       <div class="ring"></div>
       <div class="ring"></div>
       <div class="ring"></div>
       <span class="loading">Loading...</span>
       </div>

       @include('layouts.navbar')
       @include('layouts.right_bar')
       @include('layouts.left_bar')

   <div class="mobile-menu-overlay"></div>
   <div class="main-container">
       @yield('content')
   </div>
</body>
@include('layouts.footer')

<!--delete Modal -->
<div class="modal fade" id="delete_record" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <h6>Are you sure you want to delete this record?</h6>
                    </div>
                    <div class="modal-footer">
                      <button id="yes" class="btn btn-danger">Yes</button>
                      <button type="button" class="btn btn-secondary"
                          data-dismiss="modal">No</button>
                  </div>

                </form>
            </div>

        </div>
    </div>
</div>
<!-- end delete driver moal -->
</html>

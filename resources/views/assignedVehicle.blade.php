@extends('layouts.main')
@section('content')




<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-header-text">
            <div class="row">
                <div class="col-md-9">
                    <h4 class="card-title">Vehicle List</h4>
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
        <br>
        <div class="card-content ">
            <form action="{{route('addAssigned')}}" method="post">
                {!! csrf_field() !!}
                <!-- {!! method_field('GET') !!}  -->
<br>
                <div class="row">
                    
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Vehicle Name</label>
                        <input type="text" class="form-control" id="hod_fullname" name="vehicle_name" value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Driver</label>
                        <input type="text" class="form-control" id="phone" name="assignee" value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Start Date</label>
                        <input type="date" class="form-control" id="hod_fullname" name="start_datte" value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Start Odometer</label>
                        <input type="text" class="form-control" id="phone" name="odometer" value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Comment</label>
                        <input type="text" class="form-control" id="phone" name="comment" value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Status</label>
                        <input type="text" class="form-control" id="hod_fullname" name="status" value="">
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

@stop
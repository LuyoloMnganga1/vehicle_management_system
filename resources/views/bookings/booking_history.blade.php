@extends('layouts.main')
@section('title')
Booking History
@endsection
@section('content')

<h3 class="display-4">Trip Entry</h3>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-header-text">
            <div class="row">
                <div class="col-md-10">
                    <h4 class="card-title">List of Bookings</h4>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-sm" href="{{route('bookings')}}"> <i class="fa fa-plus"></i> Add New</button>
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
                        <th scope="col">Vehicle Registration Number</th>
                        <th scope="col">Fill Up Date</th>
                        <th scope="col">Odometer</th>
                        <th scope="col">Volume (L) </th>
                        <th scope="col">Partial Fuel Up</th> 
                        <th scope="col">Price</th>
                        <th scope="col">Vendor</th>
                        <th scope="col">Invoice</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
           
        </div>
    </div>
</div>

<!-- Update Invoice Modal -->
<div class="modal fade" id="updateInvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  id="update_fuel_form" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
    
                    <div class="row">
    
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Vehicle Registration Number</label>
                            <input type="text" class="form-control" id="update_vehicle_name" name="vehicle_name" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Fill Up Date</label>
                            <input type="date" class="form-control" id="update_date" name="start_datte" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Odometer</label>
                            <input type="text" class="form-control" id="update_odometer" name="odometer" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Volume (L)</label>
                            <input type="text" class="form-control" id="update_volume" name="volume" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Partial Fuel Up</label> <br>
    
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="partial_fuel" id="update_partial_fuel"
                                    value="Yes">
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="partial_fuel" id="update_partial_fuel"
                                    value="No">
                                <label class="form-check-label" for="inlineRadio2">No</label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Price/Unit</label>
                            <input type="text" class="form-control" id="update_price" name="price" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Vendor</label>
                            <input type="text" class="form-control" id="update_vendor" name="vendor" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Invoice Number</label>
                            <input type="text" class="form-control" id="update_invoice_no" name="invoice_no" value="">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Invoice Upload</label>
                            <div class="custom-file">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <input type="file" class="custom-file-input rounded-circle" id=""
                                    name="invoice_upload" accept=".jpg,.jpeg,.bmp,.png,.gif,.jfif"
                                    onchange="displayImg(this,$(this))">
    
    
                            </div>
                        </div>
                        <input type="hidden" name="previous_invoice_upload" id="previous_invoice_upload">
                        <div class="form-group d-flex justify-content-center col-md-12">
                            <img src=""  alt="selected image" name="invoice_upload" id="timg1" class="img-fluid img-thumbnail" style="width: 250px;height:300px">
                        </div>
    
                    </div>
                    <div style="margin-top: 5%">
                        <button type="submit" id="saveBtn" class="btn btn-primary">Update Invoice</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
    
                </form>
              
            </div>

        </div>
    </div>
</div>
{{-- end Update modal --}}

@endsection
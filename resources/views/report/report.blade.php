@extends('layouts.main')
@section('title')
Fuel Entry
@endsection
@section('content')

<style>
    fieldset.scheduler-border {
        border: 2px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width: auto;
        padding: 0 10px;
        border-bottom: none;
    }

    fieldset,
    legend {
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
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="card height-100-p overflow-hidden">
            <div class="card-header">
                <h3></h3>
                <div class="row">
                    <div class="col-md-10">
                        <h3 class="card-title">Manage Report</h3>
                    </div>
                </div>
            </div>
            
            <div class="card-body ">

                <fieldset class="scheduler-border border border-primary">
                    <legend class="scheduler-border">Report Filtering</legend>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Report From</label>
                                <input type="date" name="position" class="custom-select browser-default">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="" class="control-label">Report To</label>
                            <input type="date" name="gender" id="gender" class="custom-select browser-default filter_item">
                               
                        </div>
                        <div class="col-lg-4">
                            <label for="" class="control-label">Vehicle</label>
                            <select name="education_level" id="education_level" class="custom-select browser-default filter_item" >
                                <option value="none"> Select Vehicle</option>
                                <option value="NQF Level 1">Grade 9 </option>
                               
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="" class="control-label">Driver</label>
                            <select name="licence" id="licence" class="custom-select browser-default filter_item" required>
                                <option value="not_selected" selected> Select Driver</option>
                                <option value="None">None</option>
                                
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="" class="control-label">Maintenance</label>
                            <select name="process_id" id="process_id" class="custom-select browser-default " >
                                <option value="none"> Select progress status</option>
                                <option value="new">New</option>
                               
                                    <option value=""></option>
                              
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="" class="control-label">Fuel Cost</label>
                            <select name="process_id" id="process_id" class="custom-select browser-default " >
                                <option value="none"> Select progress status</option>
                                <option value="new">New</option>
                               
                                    <option value=""></option>
                              
                            </select>
                        </div>

                        <div class="col-lg-4">
                            <label for="" class="control-label">Mechanical repairs</label>
                            <select name="process_id" id="process_id" class="custom-select browser-default " >
                                <option value="none"> Select progress status</option>
                                <option value="new">New</option>
                               
                                    <option value=""></option>
                              
                            </select>
                        </div>
                       
                    </div>
                </fieldset>

                <div class="card-content table-responsive">
                    <table class="table table-hover data-table" style="width: 100%;">
                        <thead class="text-light bg bg-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Full Name(s) </th>
                                <th scope="col">Vehicle</th>
                                <th scope="col">Date From</th>
                                <th scope="col">Date To</th>
                                <th scope="col">fuel Cost</th>
                                <th scope="col">Maintenance Cost</th>
                                <th scope="col">Criminal Record?</th>
                                <th scope="col">NQF Level</th>
                                <th scope="col">Institution</th>
                                <th scope="col">Qualification</th>
                                <th scope="col">Progress Status</th>
                                
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

</div>

@endsection
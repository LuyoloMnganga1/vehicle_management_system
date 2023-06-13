@extends('layouts.main')
@section('title')
Report
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
                     
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Vehicle</label>
                                <select name="vehicle_id" id="vehicle_id" class="form-control filter_item" required>
                                    @php
                                        $vehicle = App\Models\Vehicle::orderBy('Registration_no', 'ASC')->get();
                                    @endphp
                                    <option value="none" selected>None</option>
                                    @foreach($vehicle as $item )
                                    <option value="{{ $item->id }}">{{ $item->Registration_no }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="" class="control-label">Driver</label>
                            <select name="licence" id="licence" class="custom-select browser-default filter_item" required>
                                @php
                                        $Drivers = App\Models\User::join('drivers', 'users.id', '=', 'drivers.user_id')->select('users.name', 'users.surname','users.id')->get();
                                @endphp
                                <option value="none">None</option>
                                @foreach($Drivers as $driver)
                                <option value="{{ $driver->name }} {{ $driver->surname }}">{{ $driver->name }} {{ $driver->surname }}</option>
                                @endforeach
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
                            <th scope="col">Full Name</th>
                            <th scope="col">Booking Date</th>
                            <th scope="col">Destination</th>
                            <th scope="col">Vehicle</th>
                            <th scope="col">Destination</th>
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

@section('scripts')
<script>
    $(document).ready(function () {
       var  url = "{{route('Report.list')}}";
       loadDataTable(url);
    });
</script>
<script>
    $(document).ready(function () {
        $('.filter_item').on('change',function () {
            var vehicle_id = $('#vehicle_id').val();
            // var gender = $('#gender').val();
            // var education_level = $('#education_level').val();
            // var licence = $('#licence').val();
            // var process_id = $('#process_id').val();
            // var institution = $('#institution').val();

            // var routing =  "{{ route('Report_filtered', ['vehicle_plate' => ':vehicle_id']) }}";
            // routing = routing.replace(':position', position);
            // routing = routing.replace(':gender', gender);
            // routing = routing.replace(':education_level', education_level);
            // routing = routing.replace(':licence', licence);
            // routing = routing.replace(':process_id', process_id);
            // routing = routing.replace(':institution', institution);
                $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url:  routing,
                dataType: "json",
                success: function(response) {
                    $('.data-table').DataTable().destroy();
                    loadDataTable(routing);
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        })
    });
</script>
<script>
    function loadDataTable (url) { 
        var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: url,
          dom: 'Bfrtip',
          buttons: [
                { extend: 'csv', text:'<i class="fa fa-file"> CSV</i>', className: 'bg bg-success text-light border border-succces',
                customize: function(csv){
                    return 'Vehicle Management System\n\n'+ csv;
                }
            },
                { extend: 'pdf',text:'<i class="fa fa-file-pdf-o"> PDF</i>', className: 'bg bg-danger text-light border border-danger',
                customize : function (doc) {
						//Remove the title created by datatTables
						doc.content.splice(0,1);
						//Create a date string that we use in the footer. Format is dd-mm-yyyy
						var now = new Date();
						var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
						                       

						doc.pageMargins = [20,60,20,30];
						doc.defaultStyle.fontSize = 7;
						doc.styles.tableHeader.fontSize = 7;

						doc['header']=(function() {
							return {
								columns: [
									{
										alignment: 'center',
										italics: true,
										text: 'Vehicle Management System',
										fontSize: 18,
									}
								],
								margin: 20
							}
						});
						// Create a footer object with 2 columns
						// Left side: report creation date
						// Right side: current page and total pages
						doc['footer']=(function(page, pages) {
							return {
								columns: [
									{
										alignment: 'left',
										text: ['Created on: ', { text: jsDate.toString() }]
									},
									{
										alignment: 'right',
										text: ['page ', { text: page.toString() },	' of ',	{ text: pages.toString() }]
									}
								],
								margin: 20
							}
						});
						// Change dataTable layout (Table styling)
						// To use predefined layouts uncomment the line below and comment the custom lines below
						// doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
						var objLayout = {};
						objLayout['hLineWidth'] = function(i) { return .5; };
						objLayout['vLineWidth'] = function(i) { return .5; };
						objLayout['hLineColor'] = function(i) { return '#aaa'; };
						objLayout['vLineColor'] = function(i) { return '#aaa'; };
						objLayout['paddingLeft'] = function(i) { return 4; };
						objLayout['paddingRight'] = function(i) { return 4; };
						doc.content[0].layout = objLayout;
				}},
            ],
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
                data: 'full_name',
                name: 'full_name',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'trip_start_date',
                name: 'trip_start_date',
                orderable: true,
                searchable: true,
                print: true,
                className: 'text-center'
            },
            {
                data: 'destination',
                name: 'destination',
                orderable: true,
                searchable: true,
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
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false,
            },
          ]
      });
     }
  </script>

@endsection
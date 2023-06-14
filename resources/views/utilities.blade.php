@extends('layouts.main')
@section('title')
Utilities
@endsection
@section('content')
<div class="card">
    <dv class="card-header">
        Utilities
    </dv>
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
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card p-4 my-2 mx-2 bg-light text-dark">
                    <h3>Upload Tender Submition Register from Excel file</h3><br>
                    <a href="#" class="btn btn-sm btn-naive" data-toggle="modal" data-target="#exampleModalCenter">Upload Excel</a>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"><b>Upload Excel Spreadsheet for Vehicle Bookings</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <ul>
                <li>The provide file by Business Development look as follows:</li>
            </ul>
            <br>
           <div class="row">
                <div class="col-lg-12">
                   <div class="table table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Submition Date</th>
                            <th scope="col">Client</th>
                            <th scope="col">Tender Description</th>
                            <th scope="col">Tender Value</th>
                            <th scope="col">Closing Time</th>
                            <th scope="col">KM</th>
                            <th scope="col">Rate per KM</th>
                            <th scope="col">Fuel Amount</th>
                          </tr>
                        <tbody>
                          <tr>
                            <th colspan="8" class="text-center bg bg-dark text-light">The Tenders for this week as follows:</th>
                          </tr>
                          <tr>
                            <td>5-Jun-23</td>
                            <td>Dedea</td>
                            <td>Procurement of wireless access points</td>
                            <td>R12 345</td>
                            <td>12:OOPM</td>
                            <td>126.6</td>
                            <td>7.10</td>
                            <td>R898.86</td>
                          </tr>
                        </tbody>
                      </table>
                   </div>
                </div>
                <br>
               <div class="col-lg-12">
                <ul>
                  <li class="text-bold text-danger">Remove all the headers on the file.</li>
                  <li class="text-bold text-danger">Change the Submition Date column to date format (YYYY-MM-DD)</li>
                  <li class="text-bold text-danger">The file should look something like this before uploading it:</li>
              </ul>
              <br>
               </div>
                <div class="col-lg-12">
                  <div class="table table-responsive">
                   <table class="table table-sm table-bordered">
                       <tbody>
                         <tr>
                          <td>2023-06-05</td>
                           <td>Dedea</td>
                           <td>Procurement of wireless access points</td>
                           <td>R12 345</td>
                           <td>12:OOPM</td>
                           <td>126.6</td>
                           <td>7.10</td>
                           <td>R898.86</td>
                         </tr>
                       </tbody>
                     </table>
                  </div>
               </div>
              <div class="col-lg-12">
                <form action="{{ route('import_bookings') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Upload Excel File</label>
                        <input name="file" class="form-control" type="file" id="formFile">
                      </div>
                      <input type="submit" class="btn btn-sm btn-naive" value="Upload file">
                    </form>
              </div>
           </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')

@endsection
@extends('layouts.main')
@section('title')
Log  Book
@endsection
@section('content')

<h3 class="display-4">Log Book</h3>

<div class="card">
    <div class="card-header text-center" style="background-color: navy; color: white">
        <h2 style="color: white">Basic Trip Details</h2>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Trip type</label>
                <select class="input-group input-group-sm col-sm-4 form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <label for="staticEmail" class="col-sm-2 col-form-label">Date</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="date" class="form-control" id="trip_start_date" name="trip_start_date">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Registration Number</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="text" class="form-control" id="registration_no">
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">Full Name</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="password" class="form-control" id="inputPassword">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">From</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="password" class="form-control" id="inputPassword">
                </div>
                <label for="staticEmail" class="col-sm-2 col-form-label">To</label>
                <div class="input-group input-group-sm col-sm-4">
                    <input type="password" class="form-control" id="inputPassword">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <label for="exampleFormControlTextarea1" class="form-label">Trip Comment</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>

            </div>

            <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="fa fa-plus"></i> Add New</button>
        </form>

    </div>
    <div class="card-footer text-center" style="background-color: navy; color: white">
        <h2 style=" color: white"> Return Trip Details</h2>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Trip type</label>
            <select class="input-group input-group-sm col-sm-4 form-select" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <label for="staticEmail" class="col-sm-2 col-form-label">Date</label>
            <div class="input-group input-group-sm col-sm-4">
                <input type="date" class="form-control" id="trip_start_date" name="trip_start_date">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Registration Number</label>
            <div class="input-group input-group-sm col-sm-4">
                <input type="text" class="form-control" id="registration_no">
            </div>
            <label for="staticEmail" class="col-sm-2 col-form-label">Full Name</label>
            <div class="input-group input-group-sm col-sm-4">
                <input type="password" class="form-control" id="inputPassword">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">From</label>
            <div class="input-group input-group-sm col-sm-4">
                <input type="password" class="form-control" id="inputPassword">
            </div>
            <label for="staticEmail" class="col-sm-2 col-form-label">To</label>
            <div class="input-group input-group-sm col-sm-4">
                <input type="password" class="form-control" id="inputPassword">
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-sm-12">
                <label for="exampleFormControlTextarea1" class="form-label">Trip Comment</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

        </div>

        <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
            <i class="fa fa-plus"></i> Add New</button>
    </form>
    </div>
</div>
<br>


@endsection
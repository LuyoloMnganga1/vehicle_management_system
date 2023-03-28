@extends('layouts.main')
@section('title')
Dashboard
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card" style="border: 5px solid #18345D;border-radius: 10px;">
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="card-body" >
                    <span class="pull-right clickable close-icon" data-effect="fadeOut"><i class="fa fa-times"></i></span>
                    <h6 style="margin-bottom: 0.5%;" class="card-title">Welcome Back</h6>
                    <h4>{{ Auth::user()->name }} {{ Auth::user()->surname }}</h4>
                    <p style="margin-top: 1%;" class="card-text">ICT Choice strives for service excellence and being the preferred provider of choice for innovative information and communication technology solutions and services.</p>
                </div>
            </div>
        </div>
        </div>

    </div>
</div>
@endsection
@section('scripts')
@endsection

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

<div class="pd-ltr-20">
    <div class="title pb-20">
        <h2 class="h3 mb-0">Data Information</h2>
    </div>
    <div class="row pb-10">

        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ $vehicles->count()}}</div>
                        <div class="font-14 text-secondary weight-500">Vehicles</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf"><i class="icon-copy dw dw-car"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ $drivers->count()}}</div>
                        <div class="font-14 text-secondary weight-500">Drivers</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#fff"><i class="icon-copy fa fa-user"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">0</div>
                        <div class="font-14 text-secondary weight-500">Bookings</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="yellow"><i class="icon-copy dw dw-book"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">0</div>
                        <div class="font-14 text-secondary weight-500">Issues</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="red"><i class="icon-copy fa fa-question-circle"></i></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('scripts')
@endsection

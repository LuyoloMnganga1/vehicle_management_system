@extends('layouts.main')
@section('title')
Councillors
@endsection
@section('content')

    <div class="row">
        <div class="col-8">
            <div class="card" style="  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
                <div class="row">
                    <div class="col-2">
                        <img  style="margin:20% 0% 0% 15%; width:70px; height:70px;" class="card-img-top text-center" src="{{url('/images/img/anc.png')}}" alt="Card image cap">
                    </div>
                    <div class="col-3">
                        <img style="margin-top:10%;" class="card-img-top" src="{{url('/images/img/cllr.jpg')}}" alt="Card image cap">
                    </div>
                    <div class="col-7">                        <div class="card-body">
                            <h5 class="card-title">Ward No - Cllr Name</h5>
                            <p class="card-text"> <strong>Duncan Village,</strong>East London</p>
                            <p class="card-text"> <strong>Phone:</strong> 078 212 9876 <br><strong> Email Address: </strong>bingo@gmail.com<br> <strong>Areas:</strong> <br>
                               <strong>BRAELYN:</strong> Braelyn Hills and Heights, Milner Estate, Stoneydrift, Milner Lennock and Panmure, Chiselhurst, Braelynn Ext 10 <br><strong>DUNCAN VILLAGE:</strong> Bashe, Florence, Sandile, Tappa, Mahlangeni, Sofute, Gxabanisa, Bokwe, Lujiza, Petswa, Ntsenyero, Mathuntutha,Ventshu, Gavi, Gwijana, Keswa, Dunga, Mzonyana,Ndee, Majombosi, Mekeni, Mazwi, Jongilanga, Mdaka, Ngqibisa and Xabanisa  <br><strong>PEFFERVILLE: </strong> Newsane, Lanaark, Serlkirk, Hewitt, Canning, CApston, Bromley, Piston</p>
                            
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-4"></div>
    </div>

    @endsection
    @section('scripts')
    @endsection
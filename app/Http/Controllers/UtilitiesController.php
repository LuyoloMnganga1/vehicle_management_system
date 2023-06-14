<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\BookingImport;
use Maatwebsite\Excel\Facades\Excel;

class UtilitiesController extends Controller
{
    public function index(){
        return view('utilities');
    }
    public function import_bookings(Request $request){
        Excel::import(new BookingImport, $request->file);
        return redirect()->back()->with('success','Bookings imported successfully');
    }
}

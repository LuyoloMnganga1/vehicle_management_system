<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\User;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //

    public function report()
    {
        
        return view('report.report');
    }
    public function getRecords(Request $request){
        if ($request->ajax()) {
            
                $data = Booking::orderBy('created_at', 'DESC')->get();
            return Datatables::of($data)
                    //**********INDEX COLUMN ************/
                  
                    ->addIndexColumn()
                    //**********END OF INDEX COLUMN ************/
                     //**********FULL NAME COLUMN ************/
                    ->addColumn('full_name', function($row){
                    $full_name = $row->full_name;
                    return $full_name;
                    })
                    //**********END OF FULL NAME COLUMN ************/
                    //**********FULL NAME COLUMN ************/
                    ->addColumn('email', function($row){
                        $email = $row->email;
                        return $email;
                        })
                    //**********END OF FULL NAME COLUMN ************/
                    //**********BOOKING DATE COLUMN ************/
                    ->addColumn('duration', function($row){
                        $duration =  Carbon::parse($row->trip_start_date)->formatLocalized('%d, %B %Y') . ' - ' . Carbon::parse($row->return_date)->formatLocalized('%d, %B %Y');
                        return $duration;
                        })
                    /**********END OF BOOKING DATE COLUMN ************/
                   
                    //**********BOOKING DATE COLUMN ************/
                    ->addColumn('status', function($row){
                        if($row->status == 'Rejected'){
                            $status = '<span class="badge badge-danger">'.$row->status.'</span>';
                         }else{
                            $status = '<span class="badge badge-success">'.$row->status.'</span>';
                         }
                        return $status;
                        })
                    /**********END OF BOOKING DATE COLUMN ************/
                    ->addColumn('vehicle_plate', function($row){
                        $vehicle_plate = Vehicle::where('id', $row->vehicle_id)->value('Registration_no');
                        return $vehicle_plate;
                        })
                    //**********END OF PLATE COLUMN ************/
                     /**********END OF BOOKING DATE COLUMN ************/
                     ->addColumn('created_at', function($row){
                        $created_at = Carbon::parse($row->created_at)->formatLocalized('%d, %B %Y');
                        return $created_at;
                        })
                    //**********END OF PLATE COLUMN ************/
                    
                    
                    ->rawColumns(['full_name','duration','destination','vehicle_plate','status','driver','comment','trip_datails','created_at'])
                    ->make(true);
        }
       
        return view('report.report');
    }

    public function getReport_filtered(Request $request , $vehicle_id ,$driver,$status){
        if ($request->ajax()) {
            $data = Booking::orderBy('created_at','DESC');

            if($vehicle_id != 'none'){
                $data = $data->where('vehicle_id',$vehicle_id);
            }

            if($driver != 'none'){
                $data = $data->where('full_name',$driver);
            }

            if($status != 'none'){
                $data = $data->where('status',$status);
            }

            $data = $data->get();

            return Datatables::of($data)
                    //**********INDEX COLUMN ************/
                  
                    ->addIndexColumn()
                    //**********END OF INDEX COLUMN ************/
                     //**********FULL NAME COLUMN ************/
                    ->addColumn('full_name', function($row){
                    $full_name = $row->full_name;
                    return $full_name;
                    })
                    //**********END OF FULL NAME COLUMN ************/
                    //**********FULL NAME COLUMN ************/
                    ->addColumn('email', function($row){
                        $email = $row->email;
                        return $email;
                        })
                    //**********END OF FULL NAME COLUMN ************/
                    //**********BOOKING DATE COLUMN ************/
                    ->addColumn('duration', function($row){
                        $duration =  Carbon::parse($row->trip_start_date)->formatLocalized('%d, %B %Y') . ' - ' . Carbon::parse($row->return_date)->formatLocalized('%d, %B %Y');
                        return $duration;
                        })
                    /**********END OF BOOKING DATE COLUMN ************/
                   
                    //**********BOOKING DATE COLUMN ************/
                    ->addColumn('status', function($row){
                        if($row->status == 'Rejected'){
                            $status = '<span class="badge badge-danger">'.$row->status.'</span>';
                         }else{
                            $status = '<span class="badge badge-success">'.$row->status.'</span>';
                         }
                        return $status;
                        })
                    /**********END OF BOOKING DATE COLUMN ************/
                    ->addColumn('vehicle_plate', function($row){
                        $vehicle_plate = Vehicle::where('id', $row->vehicle_id)->value('Registration_no');
                        return $vehicle_plate;
                        })
                    //**********END OF PLATE COLUMN ************/
                     /**********END OF BOOKING DATE COLUMN ************/
                     ->addColumn('created_at', function($row){
                        $created_at = Carbon::parse($row->created_at)->formatLocalized('%d, %B %Y');
                        return $created_at;
                        })
                    //**********END OF PLATE COLUMN ************/
                    
                    
                    ->rawColumns(['full_name','duration','destination','vehicle_plate','status','driver','comment','trip_datails','created_at'])
                    ->make(true);
        }
        return view('report.report');
    }
}

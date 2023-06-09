<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\User;
use DataTables;

class ReportController extends Controller
{
    //

    public function report()
    {
        
        return view('report.report');
    }
    public function getRecords(Request $request){
        if ($request->ajax()) {
            // if(Auth::user()->hasRole('Admin')){
                $data = Booking::orderBy('created_at', 'DESC')->get();
            // }else{
            //     $data = Booking::where('email',Auth::user()->email)->orderBy('created_at', 'DESC')->get();
            // }
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
                    ->addColumn('trip_start_date', function($row){
                        $trip_start_date = $row->trip_start_date;
                        return $trip_start_date;
                        })
                    /**********END OF BOOKING DATE COLUMN ************/
                   
                    //**********BOOKING DATE COLUMN ************/
                    ->addColumn('destination', function($row){
                        $destination = $row->destination;
                        return $destination;
                        })
                    /**********END OF BOOKING DATE COLUMN ************/
                    ->addColumn('vehicle_plate', function($row){
                        $vehicle_plate = Vehicle::where('id', $row->vehicle_id)->value('Registration_no');
                        return $vehicle_plate;
                        })
                    //**********END OF PLATE COLUMN ************/
                    
                    
                    ->addColumn('action', function($row){
                        $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-warning btn-sm" data-id = "'.$row->id.'"><i class="fa fa-pencil text-light"></i></a> 
                        <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="delete" data-id ="'.$row->id.'"><i class="fa fa-trash text-light"></i></a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['full_name','trip_start_date','destination','vehicle_plate','action'])
                    ->make(true);
        }
       
        return view('report.report');
    }

    public function getReport_filtered(Request $request , $vehicle_plate){
        if ($request->ajax()) {
            $data = Booking::orderBy('created_at','DESC');

            if($vehicle_plate){
                if($vehicle_plate == 'all'){
                    $data = $data;
                }else{
                    $data = $data->where('vehicle_plate',$vehicle_plate);
                }
            }
            
            // if($gender != 'none'){
            //     $data = $data->where('gender',$gender);
            // }
            // if($education_level != 'none'){
            //     $data = $data->where('education_level',$education_level);
            // }
            // if($licence != 'not_selected'){
            //     $data = $data->where('licence',$licence);
            // }
            // if($process_id != 'none'){
            //     if($process_id =='new'){
            //         $data = $data->where('process_id',0);
            //     }else{
            //         $data = $data->where('process_id',$process_id);
            //     }
            // }
            // if($institution != 'none'){
            //     $data = $data->where('institution',$institution);
            // }

            $data = $data->get();

            return Datatables::of($data)
                    //**********INDEX COLUMN ************/
                    ->addIndexColumn()
                    //**********END OF INDEX COLUMN ************/
                     //**********Registration Number COLUMN ************/
                     ->addColumn('vehicle_plate', function($row){
                        $vehicle_plate = $row->vehicle_plate ;
                       return $vehicle_plate;
                   })
                       /**********END OF Registration Number COLUMN ************/                 
                   
                    ->rawColumns(['vehicle_plate'])
                    ->make(true);
        }
        return view('report.report');
    }
}

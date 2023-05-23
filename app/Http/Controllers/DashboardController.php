<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use DB;
use DateTime;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Booking;
use App\Models\feeds;
use App\Models\Issue;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Services\sendSMS;
use App\Mail\AccountUpdated;
use Illuminate\Support\Str;
use DataTables;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $bookings = Booking::all();
        $issues = Issue::all();
        return view('dashboard')->with([
            'vehicles' => $vehicles,
            'drivers' => $drivers,
            'bookings' => $bookings,
            'issues' => $issues,
        ]);
    }
    public function booking_list(Request $request){
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
                        //**********PLATE DATE COLUMN ************/
                        ->addColumn('vehicle_plate', function($row){
                            $vehicle_plate = Vehicle::where('id', $row->vehicle_id)->value('Registration_no');
                            return $vehicle_plate;
                            })
                        //**********END OF PLATE COLUMN ************/
                         //**********BOOKING DATE COLUMN ************/
                         ->addColumn('created_at', function($row){
                            $created_at = Carbon::parse($row->created_at)->toDayDateTimeString();
                            return $created_at;
                            })
                        /**********END OF BOOKING DATE COLUMN ************/
                        //**********BOOKING DURATION DATE COLUMN ************/
                        ->addColumn('duration', function($row){
                            $trip_duration = Carbon::parse($row->trip_start_date)->toDayDateTimeString()  .' - '. Carbon::parse($row->trip_start_date)->toDayDateTimeString();
                            return $trip_duration;
                            })
                        /**********END OF BOOKING DURATION DATE COLUMN ************/
                       
                        //**********BOOKING DATE COLUMN ************/
                        ->addColumn('destination', function($row){
                            $destination = $row->destination;
                            return $destination;
                            })
                        /**********END OF BOOKING DATE COLUMN ************/      
                        //**********STATUS  COLUMN ************/
                        ->addColumn('status', function($row){
                            if($row-> status == 'Pending'){
                                $status = '<span class="badge badge-warning text-light">'.$row->status.'</span>';
                            }elseif($row-> status == 'Approved'){
                                $status = '<span class="badge badge-success text-light">'.$row->status.'</span>';
                            }else{
                                $status = '<span class="badge badge-danger text-light">'.$row->status.'</span>';
                            }
                          
                            return $status;
                            })
                        /**********END OF STATUS  COLUMN ************/                    
                            ->addColumn('action', function($row){
                                $actionBtn = '';
                                if(Auth::user()->hasRole('Admin')){
                                $actionBtn = '<a href="javascript:void(0)" class="view btn btn-info btn-sm" data-id = "'.$row->id.'"><i class="fa fa-eye text-light"></i></a>';
                                 if($row->status == 'Pending'){
                                    $actionBtn = $actionBtn .' <a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-id = "'.$row->id.'"><i class="fa fa-pencil text-light"></i></a>';
                                 }
                                }
                                return $actionBtn;
                            })
                        ->rawColumns(['full_name','email','created_at','duration','destination','status','vehicle_plate','action'])
                        ->make(true);
            }
            return redirect()->route('dashboard');
    }
    public static function update_feed($task, $event,  $person, $date)
    {
        feeds::create(
            [
                'task'=> $task,
                'event'=> $event,
                'person'=> $person,
                'date'=> $date,
            ]
        );
        return true;
    }
    public function profile()
    {
     $user = User::all();
     return view('profile')->with('user',$user);
    }

}

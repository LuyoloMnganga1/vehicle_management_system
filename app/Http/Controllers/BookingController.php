<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
Use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use App\Models\Booking;

use App\Models\Vehicle;
use App\Models\User;
use App\Models\LogBook;
use DataTables;

use Carbon\Carbon;
use App\Http\Controllers\EmailGatewayController;
use App\Http\Controllers\EmailBodyController;

class BookingController extends Controller
{
    public function bookings(){
        return view('bookings.book_vehicle');
    }

    public function bookVehicle(Request $request){
        $validator = Validator::make($request->all(), [
            
            'full_name' => ['required', 'string' , 'max:225'],
            'email' => ['required', 'string' , 'max:100000'],
            'trip_start_date' => ['required', 'string' , 'max:225'],
            'return_date' => ['required', 'string' , 'max:225'],
            'destination' => ['required', 'string' , 'max:225'],
            'vehicle_id' => ['required', 'string' , 'max:100000'],
            'trip_datails' => ['required', 'string' , 'max:100000'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            
            'full_name' => $request->full_name,
            'email' => $request->email,
            'trip_start_date' => $request->trip_start_date,
            'return_date' => $request->return_date,
            'destination' => $request->destination,
            'vehicle_id' => $request->vehicle_id,
            'trip_datails' => $request->trip_datails,
            'status' => 'Pending',
            'comment' => 'N/A',
            
        ];
        Booking::create($data);

        $mail = new EmailGatewayController();
        $booker = User::where('email',$request->email)->first();
        $admin = User::where('role','Admin')->first();
        $mail->sendEmail($admin->email,'ICT Choice | Vehicle Manangement System - Vehicle booking',EmailBodyController::vehiclebooking($booker, $admin));

        return redirect()->back()->with('success','Vehicle  has been booked successfully');
    }

    public function updateBooking(Request $request,$id){
        $validator = Validator::make($request->all(), [
            
            'full_name' => ['required', 'string' , 'max:225'],
            'email' => ['required', 'string' , 'max:100000'],
            'trip_start_date' => ['required', 'string' , 'max:225'],
            'return_date' => ['required', 'string' , 'max:225'],
            'destination' => ['required', 'string' , 'max:225'],
            'trip_datails' => ['required', 'string' , 'max:100000'],            
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'trip_start_date' => $request->trip_start_date,
            'return_date' => $request->return_date,
            'destination' => $request->destination,
            'trip_datails' => $request->trip_datails,
            
        ];
        Booking::whereId($id)->update($data);
        return redirect()->back()->with('success','Booking  has been updated successfully');

    }
    public function bookingAction(Request $request,$id) {
        $validator = Validator::make($request->all(), [
            'status' => ['required','string'],
            'comment' =>['max:50000'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = [
            'status' =>$request->status,
            'comment'=>$request->comment ? $request->comment : 'N/A',
        ];

        Booking::whereId($id)->update($data);

        $mail = new EmailGatewayController();
        $booker = Booking::join('vehicles','bookings.vehicle_id','=','vehicles.id')->select('bookings.*','vehicles.Registration_no')->where('bookings.id',$id)->first();
        $mail->sendEmail($booker->email,'ICT Choice | Vehicle Manangement System - Vehicle booking update',EmailBodyController::vehiclebookingupdate($booker));
        return redirect()->back()->with('success','Status has been updated successfully');
    }

    public function bookHistory(){
        return view('bookings.booking_history');
    }

    public function getBookings(Request $request){
        if ($request->ajax()) {
            if(Auth::user()->hasRole('Admin')){
                $data = Booking::orderBy('created_at', 'DESC')->get();
            }else{
                $data = Booking::where('email',Auth::user()->email)->orderBy('created_at', 'DESC')->get();
            }
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
        return view('bookings.booking_history');
    }



    public function findBooking($id){
        $booking = Booking::find($id);
        $vehicle_plate = Vehicle::where('id', $booking->vehicle_id)->value('Registration_no');

        $data = [
            
            'full_name' => $booking->full_name,
            'email' => $booking->email,
            'trip_start_date' => $booking->trip_start_date,
            'return_date' => $booking->return_date,
            'destination' => $booking->destination,
            'vehicle_plate' => $vehicle_plate,
            'trip_datails' => $booking->trip_datails,
            'status' => $booking->status,
            'comment' => $booking->comment,
            
        ];


        return response()->json($data);

    }

    public function deleteBooking($id)
    {
        Booking::destroy($id);
        return redirect()->back()->with('success','Booking has been deleted successfully');
    }

    public function logBook(){

        $fullname = Auth::user()->name . " ". Auth::user()->surname;
        $email = Auth::user()->email;
        $today = Carbon::today()->format('Y-m-d');
        $loog = Booking::where('email',$email)->where('trip_start_date', $today)->where('status','Approved')->first();
        $loogbook = LogBook::where('full_name',$fullname)->where('trip_start_date', $today)->first();
        if($loog){
            $reg_no = Vehicle::where('id', $loog->vehicle_id)->value('Registration_no');
        }else{
            $reg_no = null;
        }
       
        return view('bookings.log_book')->with(
            [
                'loog'=>$loog,
                'loogbook'=>$loogbook,
                'reg_no'=> $reg_no
            ]);
    }

    public function addLogBook(Request $request){
        $validator = Validator::make($request->all(), [
            'vehicle_id' => ['required',  'max:100000'],
            'full_name' => ['required',  'max:225'],
            'trip_start_date' => ['required',  'max:225'],
            'trip_end_date' => ['required',  'max:225'],
            'start_odometer' => ['required',  'max:225'],
            'kilometers' => ['required',  'max:100000'],
            'destination_start' => ['required',  'max:100000'],
            'destination_end' => ['required',  'max:225'],
            'trip_details' => ['required',  'max:100000'],
            'petrol' => ['max:225'],
            'oil' => ['max:225'],
            'start_comment' => ['max:225'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $vehicle_id = Vehicle::where('Registration_no',$request->vehicle_id)->value('id');
        $data = [
            'vehicle_id' => $vehicle_id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'trip_start_date' => $request->trip_start_date,
            'trip_end_date' => $request->trip_end_date,
            'start_odometer' => $request->start_odometer,            
            'kilometers' => $request->kilometers,
            'destination_start' => $request->destination_start,
            'destination_end' => $request->destination_end,
            'trip_details' => $request->trip_details,
            'petrol' => $request->petrol,            
            'oil' => $request->oil,
            'start_comment' => $request->start_comment,
            
        ];
        
        LogBook::create($data);
        return redirect()->back()->with('success','Details  has been logged successfully');
    }

    public function returnLogBook(Request $request){
        $validator = Validator::make($request->all(), [
            'return_date_out' => ['required',  'max:100000'],
            'return_date_in' => ['required',  'max:100000'],
            'return_odometer' => ['required',  'max:225'],
            'return_kilometers' => ['required',  'max:225'],
            'return_petrol' => ['max:225'],
            'return_oil' => [ 'max:225'],
            'return_comment' => ['max:225'],         
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $id = $request->rowID;
        $data = [
            'return_date_out' => $request->return_date_out,
            'return_date_in' => $request->return_date_in,
            'return_odometer' => $request->return_odometer,  
            'return_kilometers' => $request->return_kilometers,  #
            'return_petrol' => $request->return_petrol,          
            'return_oil' => $request->return_oil,
            'return_comment' => $request->return_comment,            
        ];
        LogBook::where('id',$id)->update($data);
        return redirect()->back()->with('success','Vehicle  has been booked successfully');
    }



    public function logHistory(){
        return view('bookings.log_history');
    }

    public function getLogBook(Request $request){
        if ($request->ajax()) {
            $data = Booking::orderBy('created_at', 'DESC')->get();
            return Datatables::of($data)
                    //**********INDEX COLUMN ************/
                    ->addIndexColumn()
                    //**********END OF INDEX COLUMN ************/
                   
                    
                    
                    ->addColumn('action', function($row){
                        $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-warning btn-sm" data-id = "'.$row->id.'"><i class="fa fa-pencil text-light"></i></a> 
                        <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="delete" data-id ="'.$row->id.'"><i class="fa fa-trash text-light"></i></a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['full_name','trip_start_date','destination','vehicle_plate','action'])
                    ->make(true);
        }
        return view('bookings.log_history');
    }
    public function find_available_car($start,$end){
        $bookings = Booking::whereBetween('trip_start_date', [$start, $end])
            ->whereBetween('return_date', [$start, $end])->select('vehicle_id')->get();
         $available_cars = Vehicle::whereNotIn('id',$bookings)->get();
        return response()->json($available_cars);
    }
}

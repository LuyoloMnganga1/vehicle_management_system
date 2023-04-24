<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
Use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use App\Models\Booking;

use App\Models\Vehicle;

use DataTables;

use Carbon\Carbon;

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
            'status' => ['max:100000'],
            'comment' => ['max:100000'],
            

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
            'status' => 'N/A',
            'comment' => 'N/A',
            
        ];
        Booking::create($data);
        return redirect()->back()->with('success','Vehicle  has been booked successfully');
    }

    public function updateBooking(Request $request,$id){
        $validator = Validator::make($request->all(), [
            
            'full_name' => ['required', 'string' , 'max:225'],
            'email' => ['required', 'string' , 'max:100000'],
            'trip_start_date' => ['required', 'string' , 'max:225'],
            'return_date' => ['required', 'string' , 'max:225'],
            'destination' => ['required', 'string' , 'max:225'],
            'vehicle_id' => ['required', 'string' , 'max:100000'],
            'trip_datails' => ['required', 'string' , 'max:100000'],
            'status' => ['max:100000'],
            'comment' => ['max:100000'],
            

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
            'status' => 'N/A',
            'comment' => 'N/A',
            
        ];
        Booking::whereId($id)->update($data);
        return redirect()->back()->with('success','Booking  has been updated successfully');

    }


    public function bookHistory(){
        return view('bookings.booking_history');
    }

    public function getBookings(Request $request){
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
        $today = Carbon::today()->format('Y-m-d');
        $loog = Booking::where('full_name','LIKE', '%'.$fullname.'%')->where('trip_start_date', $today)->first();
        if($loog){
            $reg_no = Vehicle::where('id', $loog->vehicle_id)->value('Registration_no');
        }else{
            $reg_no = null;
        }
       
        return view('bookings.log_book')->with('reg_no', $reg_no);
    }

    public function addLogBook(Request $request){
        $validator = Validator::make($request->all(), [
            'vehicle_id' => ['required', 'string' , 'max:100000'],
            'full_name' => ['required', 'string' , 'max:225'],
            'trip_start_date' => ['required', 'string' , 'max:225'],
            'trip_end_date' => ['required', 'string' , 'max:225'],
            'start_odometer' => ['required', 'string' , 'max:225'],
            'kilometers' => ['required', 'string' , 'max:100000'],
            'destination_start' => ['required', 'string' , 'max:100000'],
            'destination_end' => ['required', 'string' , 'max:225'],
            'trip_datails' => ['required', 'string' , 'max:100000'],
            'petrol' => ['required', 'string' , 'max:225'],
            'oil' => ['required', 'string' , 'max:225'],
            'start_comment' => ['required', 'string' , 'max:225'],
            'return_date_out' => ['required', 'string' , 'max:100000'],
            'return_date_in' => ['required', 'string' , 'max:100000'],
            'petrol' => ['required', 'string' , 'max:225'],
            'oil' => ['required', 'string' , 'max:225'],
            'start_comment' => ['required', 'string' , 'max:225'],
            'return_date_out' => ['required', 'string' , 'max:100000'],
            'return_date_in' => ['required', 'string' , 'max:100000'],
            'return_odometer' => ['required', 'string' , 'max:225'],
            'return_oil' => ['required', 'string' , 'max:225'],
            'start_comment' => ['required', 'string' , 'max:225'],
            'return_date_out' => ['required', 'string' , 'max:100000'],
            'return_date_in' => ['required', 'string' , 'max:100000'],
            

        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'vehicle_id' => $request->vehicle_id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'trip_start_date' => $request->trip_start_date,
            'trip_end_date' => $request->trip_end_date,
            'start_odometer' => $request->start_odometer,            
            'kilometers' => $request->kilometers,
            'destination_start' => $request->destination_start,
            'destination_end' => $request->destination_end,
            'trip_datails' => $request->trip_datails,
            'petrol' => $request->petrol,            
            'oil' => $request->oil,
            'start_comment' => $request->start_comment,
            'return_date_out' => $request->return_date_out,
            'return_date_in' => $request->return_date_in,
            'return_odometer' => $request->return_odometer,            
            'return_oil' => $request->return_oil,
            'start_comment' => $request->start_comment,
            'return_date_out' => $request->return_date_out,            
            'return_date_in' => $request->return_date_in,
            
        ];
        Booking::create($data);
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
}

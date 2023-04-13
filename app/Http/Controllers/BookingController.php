<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
Use Illuminate\Support\Facades\DB;

use App\Models\Booking;

use App\Models\Vehicle;

use DataTables;

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
        return view('bookings.log_book');
    }
}

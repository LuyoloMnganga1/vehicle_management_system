<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
Use Illuminate\Support\Facades\DB;

use App\Models\Booking;

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
            'Registration_no' => ['required', 'string' , 'unique:vehicles,Registration_no'],
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
            'Registration_no' => $request->Registration_no,
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
            'Registration_no' => ['required', 'string' , 'unique:vehicles,Registration_no'],
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
            'Registration_no' => $request->Registration_no,
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
            $data = Booking::latest()->get();
            return Datatables::of($data)
                    //**********INDEX COLUMN ************/
                    ->addIndexColumn()
                    //**********END OF INDEX COLUMN ************/
                    
                    ->addColumn('action', function($row){
                        $actionBtn = ' <a href="javascript:void(0)" class="view btn btn-info btn-sm" data-id = "'.$row->id.'"><i class="fa fa-eye text-light"></i></a> 
                        <a href="javascript:void(0)" class="edit btn btn-warning btn-sm" data-id = "'.$row->id.'"><i class="fa fa-pencil text-light"></i></a> 
                        <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="delete" data-id ="'.$row->id.'"><i class="fa fa-trash text-light"></i></a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['full_name','trip_start_date','destination','Registration_no','action'])
                    ->make(true);
        }
        return view('bookings.booking_history');
    }

    public function findBooking($id){
        $booking = Booking::find($id);
            return response()->json($booking);

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

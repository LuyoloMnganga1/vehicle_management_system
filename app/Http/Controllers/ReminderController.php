<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use App\Models\Reminder;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Validator;

class ReminderController extends Controller
{
    //

    public function reminders()
    {
        $vehicles = Vehicle::all();
        return view('reminders')->with('vehicles', $vehicles);
    }
    public function addReminders(Request $request){
        $validator = Validator::make($request->all(), [
            'reminder_type'=>['required'],
            'reminder_serial_number' => ['required'],
            'due_date' => ['required'],
        ],
        [
            'reminder_serial_number.required' => 'Policy/Serial Number is required',
            'due_date.required' => 'Expiry/Due Date  is required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        if($request->vehicle_id == null){
            return redirect()->back()->withErrors('Vehicle is required')->withInput();
        }

        $vehicle = Vehicle::find($request->vehicle_id);
        $selected_vehicle = Reminder::where('vehicle_plate',$vehicle->Registration_no)->where('reminder_type',$request->reminder_type)->first();

        if($selected_vehicle != null){
            return redirect()->back()->withErrors('This vehicle has been already captured for this type of reminder.')->withInput();
        }

        $data=[
            'vehicle_plate'=>$vehicle->Registration_no,
            'vehicle_make'=>$vehicle->vehicle_type,
            'vehicle_model'=>$vehicle->vehicle_model,
            'reminder_type'=>$request->reminder_type,
            'reminder_serial_number'=>$request->reminder_serial_number,
            'due_date'=>$request->due_date,
        ];

        Reminder::create($data);
        return redirect()->back()->with('success','Reminder created successfully');
    }
    public function get_insurance_reminders(Request $request){
        if ($request->ajax()) {
            $data = Reminder::where('reminder_type','insurance')->orderBy('created_at', 'DESC')->get();
        return Datatables::of($data)
                //**********INDEX COLUMN ************/
              
                ->addIndexColumn()
                //**********END OF INDEX COLUMN ************/
                 //**********FULL NAME COLUMN ************/
                ->addColumn('due_date', function($row){
                    if (Carbon::parse($row->due_date)->isPast()){
                        $due_date = '<badge badge-danger>'.$row->due_date.'</badge>';
                    }else{
                        $due_date = '<badge badge-success>'.$row->due_date.'</badge>';
                    }
               
                return $due_date;
                })
                //**********END OF FULL NAME COLUMN ************/
                             
                
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-warning btn-sm" data-id = "'.$row->id.'"><i class="fa fa-pencil text-light"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id = "'.$row->id.'"><i class="fa fa-trash text-light"></i></a>';                    
                    return $actionBtn;  
                })
                ->rawColumns([ 'vehicle_plate','vehicle_make','vehicle_model','reminder_serial_number','due_date','action'])
                ->make(true);
    }
    return view('reminders');
    }
    public function get_license_reminders(Request $request){
        if ($request->ajax()) {
            $data = Reminder::where('reminder_type','license')->orderBy('created_at', 'DESC')->get();
        return Datatables::of($data)
                //**********INDEX COLUMN ************/
              
                ->addIndexColumn()
                //**********END OF INDEX COLUMN ************/
                 //**********FULL NAME COLUMN ************/
                ->addColumn('due_date', function($row){
                    if (Carbon::parse($row->due_date)->isPast()){
                        $due_date = '<badge badge-danger>'.$row->due_date.'</badge>';
                    }else{
                        $due_date = '<badge badge-success>'.$row->due_date.'</badge>';
                    }
               
                return $due_date;
                })
                //**********END OF FULL NAME COLUMN ************/
                             
                
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-warning btn-sm" data-id = "'.$row->id.'"><i class="fa fa-pencil text-light"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id = "'.$row->id.'"><i class="fa fa-trash text-light"></i></a>';                    
                    return $actionBtn;
                })
                ->rawColumns([ 'vehicle_plate','vehicle_make','vehicle_model','reminder_serial_number','due_date','action'])
                ->make(true);
    }
    return view('reminders');
    }
    public function get_service_reminders(Request $request){
        if ($request->ajax()) {
            $data = Reminder::where('reminder_type','service')->orderBy('created_at', 'DESC')->get();
        return Datatables::of($data)
                //**********INDEX COLUMN ************/
              
                ->addIndexColumn()
                //**********END OF INDEX COLUMN ************/
                 //**********FULL NAME COLUMN ************/
                ->addColumn('due_date', function($row){
                    if (Carbon::parse($row->due_date)->isPast()){
                        $due_date = '<badge badge-danger>'.$row->due_date.'</badge>';
                    }else{
                        $due_date = '<badge badge-success>'.$row->due_date.'</badge>';
                    }
               
                return $due_date;
                })
                //**********END OF FULL NAME COLUMN ************/
                             
                
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-warning btn-sm" data-id = "'.$row->id.'"><i class="fa fa-pencil text-light"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id = "'.$row->id.'"><i class="fa fa-trash text-light"></i></a>';                    
                    return $actionBtn;
                })
                ->rawColumns([ 'vehicle_plate','vehicle_make','vehicle_model','reminder_serial_number','due_date','action'])
                ->make(true);
    }
    return view('reminders');
    }
}

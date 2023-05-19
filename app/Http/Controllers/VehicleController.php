<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
Use Illuminate\Support\Facades\DB;

use App\Models\Vehicle;
use DataTables;
use App\Models\Assign;
use App\Models\Driver;
use App\Http\Controllers\EmailGatewayController;
use App\Http\Controllers\EmailBodyController;

class VehicleController extends Controller
{
    public function getvehicles(Request $request)
    {
       if($request->ajax()){
            $data = Vehicle::orderBy('created_at','DESC')->get();
            return DataTables::of($data)
             //**********INDEX COLUMN ************/
             ->addIndexColumn()
             //**********END OF INDEX COLUMN ************/
              //**********TYPE COLUMN ************/
              ->addColumn('vehicle_type', function($row){
                $vehicle_type = $row->vehicle_type;
                return $vehicle_type;
             })
             //**********END OF TYPE COLUMN ************/
                //**********NAME COLUMN ************/
                ->addColumn('vehicle_name', function($row){
                    $vehicle_name = $row->vehicle_name;
                    return $vehicle_name;
                 })
                 //**********END OF NAME COLUMN ************/
                   //**********MODEL COLUMN ************/
                ->addColumn('vehicle_model', function($row){
                    $vehicle_model = $row->vehicle_model;
                    return $vehicle_model;
                 })
                 //**********END OF MODEL COLUMN ************/
                    //**********YEAR COLUMN ************/
                ->addColumn('year', function($row){
                    $year = $row->year;
                    return $year;
                 })
                 //**********END OF YEAR COLUMN ************/
             //**********IMAGE COLUMN ************/
             ->addColumn('vehicle_image', function($row){
                $vehicle_image = '<img src="'.$row->vehicle_image.'" alt="vehicle image" style="width: 70px;height: 70px;"/>';
                return $vehicle_image;
             })
             //**********END OF IMAGE COLUMN ************/
               //**********FUEL COLUMN ************/
               ->addColumn('fuel_type', function($row){
                $fuel_type = $row->fuel_type;
                return $fuel_type;
             })
             //**********END OF FUEL COLUMN ************/
                 //**********PLATE NO COLUMN ************/
                 ->addColumn('Registration_no', function($row){
                    $Registration_no = $row->Registration_no;
                    return $Registration_no;
                 })
                 //**********END OF PLATE NO COLUMN ************/
                //**********ACTION COLUMN ************/
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" class="view btn btn-info btn-sm" data-id = "'.$row->id.'"><i class="fa fa-eye text-light"></i></a> <a href="javascript:void(0)" class="edit btn btn-warning btn-sm" data-id="'.$row->id.'"><i class="fa fa-pencil text-light"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="delete" data-id ="'.$row->id.'"><i class="fa fa-trash text-light"></i></a>';
                return $actionBtn;
            })
              //**********END OF ACTION COLUMN ************/
            ->rawColumns(['vehicle_type','vehicle_name','vehicle_model','year','fuel_type','vehicle_image','Registration_no','action'])
            ->make(true);
       }
       return view('vehicle.vehicle');
    }
    public function findvehicle(Request $request,$id){
        if($request->ajax()){
            $vehicle = Vehicle::find($id);
            return response()->json($vehicle);
        }
    }

    public function addVehicle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_type' => ['required', 'string' , 'max:225'],
            'vehicle_name' => ['required', 'string' , 'max:100000'],
            'vehicle_model' => ['required', 'string' , 'max:225'],
            'year' => ['required', 'string' , 'max:225'],
            'vehicle_status' => ['required', 'string' , 'max:225'],
            'Registration_no' => ['required', 'string' , 'unique:vehicles,Registration_no'],
            'engine_no' => ['required', 'string' ,'unique:vehicles,engine_no'],
            'chassis_no' => ['required', 'string' ,'unique:vehicles,chassis_no'],
            'fuel_type' => ['required', 'string' , 'max:225'],
            'fuel_measurement' => ['required', 'string' , 'max:100000'],
            'vehicle_usage' => ['required', 'string' , 'max:225'],
            'aux_meter' => ['required', 'string' , 'max:225']

        ]);
        $img ='';
        if ($request->vehicle_image == null){
            return redirect()->back()
            ->withErrors("Image iimages required")
            ->withInput();
        }else{
            if($request->hasFile('vehicle_image')){
                $fileName = auth()->id() . '_' . time() . '.'. $request->vehicle_image->extension();
                $request->vehicle_image->move('files/img', $fileName);
                $img = 'files/img/'.$fileName;
            }
        }
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'vehicle_type' => $request->vehicle_type,
            'vehicle_name' => $request->vehicle_name,
            'vehicle_model' => $request->vehicle_model,
            'vehicle_image' => $img,
            'year' => $request->year,
            'vehicle_status' => $request->vehicle_status,
            'Registration_no' => $request->Registration_no,
            'engine_no' => $request->engine_no,
            'chassis_no' => $request->chassis_no,
            'fuel_type' => $request->fuel_type,
            'fuel_measurement' => $request->fuel_measurement,
            'vehicle_usage' => $request->vehicle_usage,
            'aux_meter' => $request->aux_meter,
        ];
        Vehicle::create($data);
        return redirect()->back()->with('success','Vehicle  has been added');
    }

    public function updateVehicle(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_type' => ['required', 'string' , 'max:225'],
            'vehicle_name' => ['required', 'string' , 'max:100000'],
            'vehicle_model' => ['required', 'string' , 'max:225'],
            'year' => ['required', 'string' , 'max:225'],
            'vehicle_status' => ['required', 'string' , 'max:225'],
            'Registration_no' => ['required', 'string' , 'unique:vehicles,Registration_no,'.$id],
            'engine_no' => ['required', 'string' ,'unique:vehicles,engine_no,'.$id],
            'chassis_no' => ['required', 'string' ,'unique:vehicles,chassis_no,'.$id],
            'fuel_type' => ['required', 'string' , 'max:225'],
            'fuel_measurement' => ['required', 'string' , 'max:100000'],
            'vehicle_usage' => ['required', 'string' , 'max:225'],
            'aux_meter' => ['required', 'string' , 'max:225']

        ]);
        $img ='';
        if ($request->vehicle_image == null){
            $img = $request->previous_image;
        }else{
            if($request->hasFile('vehicle_image')){
                $fileName = auth()->id() . '_' . time() . '.'. $request->vehicle_image->extension();
                $request->vehicle_image->move('files/img', $fileName);
                $img = 'files/img/'.$fileName;
            }
        }
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'vehicle_type' => $request->vehicle_type,
            'vehicle_name' => $request->vehicle_name,
            'vehicle_model' => $request->vehicle_model,
            'vehicle_image' => $img,
            'year' => $request->year,
            'vehicle_status' => $request->vehicle_status,
            'Registration_no' => $request->Registration_no,
            'engine_no' => $request->engine_no,
            'chassis_no' => $request->chassis_no,
            'fuel_type' => $request->fuel_type,
            'fuel_measurement' => $request->fuel_measurement,
            'vehicle_usage' => $request->vehicle_usage,
            'aux_meter' => $request->aux_meter,
        ];
        Vehicle::whereId($id)->update($data);
        return redirect()->back()->with('success','Vehicle has been updated');
    }

    public function deleteVehicle($id)
    {
        Vehicle::destroy($id);
        return redirect()->back()->with('success','Vehicle has been deleted');
    }

    public function assigned()
    {
        $driver = DB::table('drivers')->get();
        $assigned = Assign::all();
        $i =1;
        return view('vehicle.assignedVehicle')->with(["assigned"=>$assigned, 'i'=>$i, 'driver' => $driver]);
    }

    public function addAssigned(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'assignee' => ['required', 'string' , 'max:225'],
            'email' => ['required', 'string' , 'max:225'],
            'licence_no' => ['required', 'string' , 'max:225'],
            'department' => ['required', 'string' , 'max:225'],
            'Registration_no' => ['required', 'string' , 'max:225'],
            'odometer' => ['required', 'string' , 'max:225'],
            'assigned_status' => ['required', 'string' , 'max:100000'],
            'comment' => ['required', 'string' , 'max:100000'],
        ]);
       
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $driver = Assign::where('email',$request->email)->count();
        $vehicle = Assign::where('Registration_no',$request->Registration_no)->count();
        if($driver > 0){
            return redirect()->back()->withErrors('Oops! the driver has already been assigned to another vehicle.')->withInput();
        }
        if($vehicle > 0){
            return redirect()->back()->withErrors('Oops! the vehicle has already been assigned to another driver.')->withInput();
        }
        $data = [
            
            'assignee' => $request->assignee,
            'email' => $request->email,
            'licence_no' => $request->licence_no,
            'department' => $request->department,
            'Registration_no' => $request->Registration_no,
            'odometer' => $request->odometer,
            'status' => $request->assigned_status,
            'comment' => $request->comment,
    
        ];
        Assign::create($data);
        $mail = new EmailGatewayController();
        $mail->sendEmail($request->email,'ICT Choice | Vehicle Manangement System - Driver Assigned To Vehicle',EmailBodyController::driverAssignedToVehicle($data));

        return redirect()->back()->with('success','Vehicle has been assigned successfully');
    }

    public function updateAssigned(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'assignee' => ['required', 'string' , 'max:225'],
            'email' => ['required', 'string' , 'max:225'],
            'licence_no' => ['required', 'string' , 'max:225'],
            'department' => ['required', 'string' , 'max:225'],
            'Registration_no' => ['required', 'string' , 'max:225'],
            'odometer' => ['required', 'string' , 'max:225'],
            'assigned_status' => ['required', 'string' , 'max:100000'],
            'comment' => ['required', 'string' , 'max:100000'],
           
           

        ]);
       
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'assignee' => $request->assignee,
            'email' => $request->email,
            'licence_no' => $request->licence_no,
            'department' => $request->department,
            'Registration_no' => $request->Registration_no,
            'odometer' => $request->odometer,
            'assigned_status' => $request->assigned_status,
            'comment' => $request->comment,
        ];
        Assign::whereId($id)->update($data);
        return redirect()->back()->with('success','Assignment vehicle has been updated successfully');
    }
    public function findAssignment($id){
        $data = Assign::where('id',$id)->first();
        return response()->json($data);
    }
    public function deleteAssigned($email){
        $data = Assign::where('email',$email)->first();
        Assign::where('email',$email)->delete();
        $mail = new EmailGatewayController();
        $mail->sendEmail($data->email,'ICT Choice | Vehicle Manangement System - Driver Removed To Vehicle',EmailBodyController::RemovedriverAssignedToVehicle($data));
        return redirect()->back()->with('success','Assignment vehicle has been deleted successfully');
    }

    public function assigedhistory()
    {
        $assigned = Assign::all();
        $i =1;
        return view('vehicle.VehicleHistory')->with(["assigned"=>$assigned, 'i'=>$i]);
    }

    public function councillors()
    {
        
        return view('councillors');
    }
    public function getAssignedDrivers(Request $request){
        if($request->ajax()){
            $data = Assign::latest('created_at')->get();
            return Datatables::of($data)
            //**********INDEX COLUMN ************/
            ->addIndexColumn()
              //**********END OF INDEX COLUMN ************/
               //**********NAME COLUMN ************/
            ->addColumn('assignee', function($row){
                $assignee = $row->assignee;
                return $assignee;
            })
             //**********END OF NAME COLUMN ************/
               //**********LICENCE COLUMN ************/
            ->addColumn('licence_no', function($row){
                $licence_no = $row->licence_no;
                return $licence_no;
            })
             //**********END OF LICENCE COLUMN ************/
               //**********DATE COLUMN ************/
            ->addColumn('updated_at', function($row){
                $updated_at = $row->updated_at;
                return $updated_at;
            })
             //**********END OF DATE COLUMN ************/
             //**********REG COLUMN ************/
            ->addColumn('Registration_no', function($row){
                $Registration_no = $row->Registration_no;
                return $Registration_no;
            })
             //**********END OF REG COLUMN ************/
              //**********STATUS COLUMN ************/
            ->addColumn('assigned_status', function($row){
                 if($row->status == 'Inactive'){
                    $status = '<span class="badge badge-danger">'.$row->status.'</span>';
                 }else{
                    $status = '<span class="badge badge-success">'.$row->status.'</span>';
                 }
                return $status;
            })
             //**********END OF STATUS COLUMN ************/
                //**********ACTION COLUMN ************/
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" class="view btn btn-info btn-sm" data-id = "'.$row->id.'"><i class="fa fa-eye text-light"></i></a> <a href="javascript:void(0)" class="edit btn btn-warning btn-sm" data-id = "'.$row->id.'"><i class="fa fa-pencil text-light"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="delete" data-href ="/delete-assigment/'.$row->email.'"><i class="fa fa-trash text-light"></i></a>';
                return $actionBtn;
            })
              //**********END OF ACTION COLUMN ************/
            ->rawColumns(['assignee','licence_no','updated_at','Registration_no','assigned_status','action'])
            ->make(true);

        }
        return view('vehicle.assignedVehicle');
    }

}

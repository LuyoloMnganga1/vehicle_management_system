<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
Use Illuminate\Support\Facades\DB;

use App\Models\Vehicle;
use DataTables;
use App\Models\Assign;
use App\Models\Driver;

class VehicleController extends Controller
{
    public function getvehicles(Request $request)
    {
       if($request->ajax()){
            $data = Vehicle::all()->latest();
            return DataTables::of($data)
             //**********INDEX COLUMN ************/
             ->addIndexColumn()
             //**********END OF INDEX COLUMN ************/
             //**********IMAGE COLUMN ************/
             ->addColumn('vehicle_image', function($row){
                $vehicle_image = '<img src="'.$row->vehicle_image.'" alt="vehicle image" style="width: 70px;height: 100px;"/>';
                return $vehicle_image;
             })
             //**********END OF IMAGE COLUMN ************/
                //**********ACTION COLUMN ************/
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" class="view btn btn-info btn-sm" data-id = "'.$row->id.'"><i class="fa fa-eye text-light"></i></a> <a href="javascript:void(0)" class="edit btn btn-warning btn-sm" data-id = "'.$row->id.'"><i class="fa fa-pencil text-light"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="delete" data-href ="/deleteVehicle/'.$row->id.'"><i class="fa fa-trash text-light"></i></a>';
                return $actionBtn;
            })
              //**********END OF ACTION COLUMN ************/
            ->rawColumns(['vehicle_type','vehicle_name','vehicle_model','year','vehicle_image','Registration_no','action'])
            ->make(true);
       }
       return view('vehicle.vehicle');
    }

    public function addVehicle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_type' => ['required', 'string' , 'max:225'],
            'vehicle_name' => ['required', 'string' , 'max:100000'],
            'vehicle_model' => ['required', 'string' , 'max:225'],
            'year' => ['required', 'string' , 'max:225'],
            'vehicle_status' => ['required', 'string' , 'max:225'],
            'Registration_no' => ['required', 'string' , 'max:225'],
            'engine_no' => ['required', 'string' , 'max:100000'],
            'chassis_no' => ['required', 'string' , 'max:225'],
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
            'Registration_no' => ['required', 'string' , 'max:225'],
            'engine_no' => ['required', 'string' , 'max:100000'],
            'chassis_no' => ['required', 'string' , 'max:225'],
            'fuel_type' => ['required', 'string' , 'max:225'],
            'fuel_measurement' => ['required', 'string' , 'max:100000'],
            'vehicle_usage' => ['required', 'string' , 'max:225'],
            'aux_meter' => ['required', 'string' , 'max:225']

        ]);
        $img ='';
        if ($request->vehicle_image == null){
            return redirect()->back()
            ->withErrors("Car image required")
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
        Assign::create($data);
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

    public function deleteAssigned(){

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

   


}

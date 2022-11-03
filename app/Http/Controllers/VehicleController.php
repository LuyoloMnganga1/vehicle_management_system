<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Vehicle;

use App\Models\Assign;

use App\Models\Fuel;

class VehicleController extends Controller
{
    public function Vehicle()
    {
        $vehicle = Vehicle::all();
        $i =1;
        return view('Vehicle')->with(['vehicle'=>$vehicle, 'i'=>$i]);
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
        return view('assignedVehicle');
    }

    public function addAssigned(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_name' => ['required', 'string' , 'max:100000'],
            'assignee' => ['required', 'string' , 'max:225'],
            'start_datte' => ['required', 'string' , 'max:225'],
            'odometer' => ['required', 'string' , 'max:225'],
            'comment' => ['required', 'string' , 'max:225'],
            'status' => ['required', 'string' , 'max:100000'],
           

        ]);
       
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'vehicle_name' => $request->vehicle_name,
            'assignee' => $request->assignee,
            'start_datte' => $request->start_datte,
            'odometer' => $request->odometer,
            'comment' => $request->comment,
            'status' => $request->status,
        ];
        Assign::create($data);
        return redirect()->back()->with('success','Vehicle  has been assigned successfully');
    }

    public function updateAssigned(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_name' => ['required', 'string' , 'max:100000'],
            'assignee' => ['required', 'string' , 'max:225'],
            'start_datte' => ['required', 'string' , 'max:225'],
            'odometer' => ['required', 'string' , 'max:225'],
            'comment' => ['required', 'string' , 'max:225'],
            'status' => ['required', 'string' , 'max:100000'],
           

        ]);
       
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'vehicle_name' => $request->vehicle_name,
            'assignee' => $request->assignee,
            'start_datte' => $request->start_datte,
            'odometer' => $request->odometer,
            'comment' => $request->comment,
            'status' => $request->status,
        ];
        Assign::whereId($id)->update($data);
        return redirect()->back()->with('success','Assignment has been updated');
    }

    public function deleteAssigned(){

    }

    public function assigedhistory()
    {
        $assigned = Assign::all();
        $i =1;
        return view('VehicleHistory')->with(["assigned"=>$assigned, 'i'=>$i]);
    }

    public function fuelEntry()
    {
        // $assigned = Assign::all();
        // $i =1; ->with(["assigned"=>$assigned, 'i'=>$i])
        return view('fuelEntry');
    }

    public function addFuel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_name' => ['required', 'string' , 'max:100000'],
            'start_datte' => ['required', 'string' , 'max:225'],
            'odometer' => ['required', 'string' , 'max:225'],
            'partial_fuel' => ['required', 'string' , 'max:225'],
            'price' => ['required', 'double' , 'max:100000'],
            'vendor' => ['required', 'string' , 'max:100000'],
            'invoice_no' => ['required', 'string' , 'max:100000'],
           

        ]);
        $file ='';
        if ($request->vehicle_image == null){
            return redirect()->back()
            ->withErrors("File upload required")
            ->withInput();
        }else{
            if($request->hasFile('invoice_upload')){
                $fileName = auth()->id() . '_' . time() . '.'. $request->invoice_upload->extension();
                $request->invoice_upload->move('files/img', $fileName);
                $file = 'files/img/'.$fileName;
            }
        }
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'vehicle_name' => $request->vehicle_name,
            'start_datte' => $request->start_datte,
            'odometer' => $request->odometer,
            'partial_fuel' => $request->partial_fuel,
            'price' => $request->price,
            'vendor' => $request->vendor,
            'invoice_no' => $request->invoice_no,
            'invoice_upload' => $file,
        ];
        Fuel::create($data);
        return redirect()->back()->with('success','Vehicle  has been assigned successfully');
    }


}

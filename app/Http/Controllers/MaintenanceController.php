<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use App\Models\Maintenance;

class MaintenanceController extends Controller
{
    //
    public function maintenance()
    {
        
        return view('maintenance');
    }

    public function addMaintenance(Request $request){
        $validator = Validator::make($request->all(), [
            'maintenance_date' => ['required', 'string' , 'max:225'],
            'vehicle_id' => ['required', 'string' , 'max:100000'],
            'service_provider' => ['required', 'string' , 'max:225'],
            'odometer' => ['required', 'string' , 'max:225'],
            'current_millage' => ['required', 'string' , 'max:225'],
            'next_service_millage' => ['required', 'string' , 'max:225'],
            // 'due_date' => ['required', 'string' , 'max:100000'],

        ]);
      
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'maintenance_date' => $request->maintenance_date,
            'vehicle_id' => $request->vehicle_id,
            'service_provider' => $request->service_provider,
            'odometer' => $request->odometer,
            'current_millage' => $request->current_millage,
            'next_service_millage' => $request->next_service_millage,
        ];
        Maintenance::create($data);
        return redirect()->back()->with('success','Maintenance has been added');

    }

    public function updateMaintenance(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'maintenance_date' => ['required', 'string' , 'max:225'],
            'vehicle_id' => ['required', 'string' , 'max:100000'],
            'service_provider' => ['required', 'string' , 'max:225'],
            'odometer' => ['required', 'string' , 'max:225'],
            'current_millage' => ['required', 'string' , 'max:225'],
            'next_service_millage' => ['required', 'string' , 'max:225'],
            // 'due_date' => ['required', 'string' , 'max:100000'],

        ]);
      
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'maintenance_date' => $request->maintenance_date,
            'vehicle_id' => $request->vehicle_id,
            'service_provider' => $request->service_provider,
            'odometer' => $request->odometer,
            'current_millage' => $request->current_millage,
            'next_service_millage' => $request->next_service_millage,
        ];
        Maintenance::whereId($id)->update($data);
        return redirect()->back()->with('success','Maintenance has been updated');
    }

    public function deleteMaintenance($id)
    {
        Maintenance::destroy($id);
        return redirect()->back()->with('success','Issue has been deleted');
    }
}

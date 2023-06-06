<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use App\Models\Maintenance;
use DataTables;

class MaintenanceController extends Controller
{
    //
    public function maintenance(Request $request)
    {
        
        if($request->ajax()){
            $data = Maintenance::latest()->get();
            dd($data);
            return Datatables::of($data)
            //**********INDEX COLUMN ************/
            ->addIndexColumn()
              //**********END OF INDEX COLUMN ************/
                //**********Maintenance date COLUMN ************/
                ->addColumn('maintenance_date', function($row){
                    $maintenance_date = $row->maintenance_date;
                    return $maintenance_date;
                    })
                    //**********END OF TITLE COLUMN ************/
                //**********PLATE COLUMN ************/
                ->addColumn('vehicle_plate', function($row){
                    $vehicle_plate = Vehicle::where('id', $row->vehicle_id)->value('Registration_no');
                    return $vehicle_plate;
                    })
                    //**********END OF PLATE COLUMN ************/
                       //**********Maintenance date COLUMN ************/
                ->addColumn('service_provider', function($row){
                    $service_provider = $row->service_provider;
                    return $service_provider;
                    })
                    //**********END OF TITLE COLUMN ************/
                      //**********Maintenance date COLUMN ************/
                ->addColumn('service_provider', function($row){
                    $service_provider = $row->service_provider;
                    return $service_provider;
                    })
                    //**********END OF TITLE COLUMN ************/
             //**********Maintenance date COLUMN ************/
             ->addColumn('current_millage', function($row){
                $current_millage = $row->current_millage;
                return $current_millage;
                })
                //**********END OF TITLE COLUMN ************/
                 //**********Maintenance date COLUMN ************/
             ->addColumn('next_service_millage', function($row){
                $next_service_millage = $row->next_service_millage;
                return $next_service_millage;
                })
              
                //**********ACTION COLUMN ************/
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-warning btn-sm" data-id = "'.$row->id.'"><i class="fa fa-pencil text-light"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id = "'.$row->id.'"><i class="fa fa-trash text-light"></i></a>';                    
                    return $actionBtn;
                })
              //**********END OF ACTION COLUMN ************/
            ->rawColumns(['maintenance_date','vehicle_plate','service_provider','odometer','current_millage','next_service_millage','action'])
            ->make(true);

        }

        return view('maintenance');
    }

    // public function getMaintenance(Request $request){
    //     if($request->ajax()){
    //         $data = Maintenance::latest()->get();
    //         return Datatables::of($data)
    //         //**********INDEX COLUMN ************/
    //         ->addIndexColumn()
    //           //**********END OF INDEX COLUMN ************/
              
    //             //**********ACTION COLUMN ************/
    //             ->addColumn('action', function($row){
    //                 $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-warning btn-sm" data-id = "'.$row->id.'"><i class="fa fa-pencil text-light"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id = "'.$row->id.'"><i class="fa fa-trash text-light"></i></a>';                    
    //                 return $actionBtn;
    //             })
    //           //**********END OF ACTION COLUMN ************/
    //         ->rawColumns(['maintenance_date','vehicle_plate','service_provider','odometer','current_millage','next_service_millage','action'])
    //         ->make(true);

    //     }

    //     return view('maintenance');

    // }

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

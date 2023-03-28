<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Driver;

use Excel;

use App\Imports\ImportDriver;

class DriverController extends Controller
{
    public function driver()
    {
        $driver = Driver::all();
        $i =1;
        return view('driver')->with(['driver'=>$driver, 'i'=> $i]);
    }


    public function addDriver(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string' , 'max:100000'],
            'surname' => ['required', 'string' , 'max:225'],
            'department' => ['required', 'string' , 'max:225'],
            'email' => ['required', 'string' , 'max:225'],
            'phone' => ['required', 'string' , 'max:225'],
            'user_type' => ['required', 'string' , 'max:100000'],
            'licence_no' => ['required', 'string' , 'max:225'],
            'licence_class' => ['required', 'string' , 'max:225'],
            'license_state' => ['required', 'string' , 'max:100000'],

        ]);
        $img ='';
        if ($request->license_image == null){
            return redirect()->back()
            ->withErrors("License images required")
            ->withInput();
        }else{
            if($request->hasFile('license_image')){
                $fileName = auth()->id() . '_' . time() . '.'. $request->license_image->extension();
                $request->license_image->move('files/img', $fileName);
                $img = 'files/img/'.$fileName;
            }
        }
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'name' => $request->name,
            'surname' => $request->surname,
            'department' => $request->department,
            'email' => $request->email,
            'phone' => $request->phone,
            'user_type' => $request->user_type,
            'licence_no' => $request->licence_no,
            'licence_no' => $request->licence_no,
            'fuel_type' => $request->fuel_type,
            'licence_class' => $request->licence_class,
            'license_state' => $request->license_state,
            'license_image' => $img,
        ];
        Driver::create($data);
        return redirect()->back()->with('success','Driver  has been added successfully');
    }

    public function importDriver (Request $request){
        
        Excel::import(new ImportDriver($request->file));

        return redirect('/')->with('success', 'Drivers successfully added !');
    }
 
    public function updateDriver(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string' , 'max:100000'],
            'surname' => ['required', 'string' , 'max:225'],
            'department' => ['required', 'string' , 'max:225'],
            'email' => ['required', 'string' , 'max:225'],
            'phone' => ['required', 'string' , 'max:225'],
            'user_type' => ['required', 'string' , 'max:100000'],
            'licence_no' => ['required', 'string' , 'max:225'],
            'licence_class' => ['required', 'string' , 'max:225'],
            'license_state' => ['required', 'string' , 'max:100000'],

        ]);
        $img ='';
        if ($request->vehicle_image == null){
            return redirect()->back()
            ->withErrors("License images required")
            ->withInput();
        }else{
            if($request->hasFile('license_image')){
                $fileName = auth()->id() . '_' . time() . '.'. $request->license_image->extension();
                $request->license_image->move('files/img', $fileName);
                $img = 'files/img/'.$fileName;
            }
        }
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'name' => $request->name,
            'surname' => $request->surname,
            'department' => $request->department,
            'email' => $request->email,
            'phone' => $request->phone,
            'user_type' => $request->user_type,
            'licence_no' => $request->licence_no,
            'licence_class' => $request->licence_class,
            'license_state' => $request->license_state,
            'license_image' => $img,
        ];
        Driver::whereId($id)->update($data);
        return redirect()->back()->with('success','Vehicle has been updated');
    }

    public function deleteDriver($id)
    {
        Driver::destroy($id);
        return redirect()->back()->with('success','Driver has been deleted successfully');
    }
}

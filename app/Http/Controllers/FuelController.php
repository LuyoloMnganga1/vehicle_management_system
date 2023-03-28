<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Fuel;

class FuelController extends Controller
{
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
            'price' => ['required'],
            'vendor' => ['required', 'string' , 'max:100000'],
            'invoice_no' => ['required', 'string' , 'max:100000']           

        ]);
        $file ='';
        if ($request->invoice_upload == null){
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
            'invoice_upload' => $file
        ];
        Fuel::create($data);
        return redirect()->back()->with('success','Vehicle  has been assigned successfully');
    }

    public function updateFuel(Request $request, $id)
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
        Fuel::whereId($id)->update($data);
        return redirect()->back()->with('success','Vehicle  has been assigned successfully');
    }

    public function deleteFuel($id)
    {
        Fuel::destroy($id);
        return redirect()->back()->with('success','Record has been deleted');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Fuel;

use DataTables;

class FuelController extends Controller
{
    public function fuelEntry()
    {
       
        return view('fuelEntry');
    }

    public function getFuel(Request $request)
    {
       
        if ($request->ajax()) {
            $data = Fuel::latest()->get();
            return Datatables::of($data)
                    //**********INDEX COLUMN ************/
                    ->addIndexColumn()
                    //**********END OF INDEX COLUMN ************/
                    //**********IMAGE COLUMN ************/
                    ->addColumn('invoice_image', function($row){
                        $invoice_upload = '<img src="'.$row->invoice_upload.'" alt="vehicle image" style="width: 70px;height: 70px;"/>';
                        return $invoice_upload;
                    })
                //**********END OF IMAGE COLUMN ************/
                    ->addColumn('action', function($row){
                        $actionBtn = ' <a href="javascript:void(0)" class="edit btn btn-warning btn-sm" data-id = "'.$row->id.'"><i class="fa fa-pencil text-light"></i></a> 
                        <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="delete" data-id ="'.$row->id.'"><i class="fa fa-trash text-light"></i></a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['vehicle_name','start_datte','odometer','volume','partial_fuel','price','vendor','invoice_no','invoice_image','action'])
                    ->make(true);
        }
        return view('fuelEntry');
    }



   

    public function addFuel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_name' => ['required', 'string' , 'max:100000'],
            'start_datte' => ['required', 'string' , 'max:225'],
            'odometer' => ['required', 'string' , 'max:225'],
            'volume' => ['required', 'string' , 'max:225'],
            'partial_fuel' => ['required', 'string' , 'max:225'],
            'price' => ['required'],
            'vendor' => ['required', 'string' , 'max:100000'],
            'invoice_no' => ['required', 'string' , 'max:100000']           

        ]);
      
        $file ='';
        if ($request->invoice_upload == null){
            return redirect()->back()
            ->withErrors("File upload is required")
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
            'volume' => $request->volume,
            'partial_fuel' => $request->partial_fuel,
            'price' => $request->price,
            'vendor' => $request->vendor,
            'invoice_no' => $request->invoice_no,
            'invoice_upload' => $file
        ];
        Fuel::create($data);
        return redirect()->back()->with('success','Fuel  has been captured successfully');
    }

    public function find_invoice($id){
            $fuel = Fuel::find($id);
            return response()->json($fuel);
    }

    public function updateFuel(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_name' => ['required', 'string' , 'max:100000'],
            'start_datte' => ['required', 'string' , 'max:225'],
            'odometer' => ['required', 'string' , 'max:225'],
            'volume' => ['required', 'string' , 'max:225'],
            'partial_fuel' => ['required', 'string' , 'max:225'],
            'price' => ['required'],
            'vendor' => ['required', 'string' , 'max:100000'],
            'invoice_no' => ['required', 'string' , 'max:100000'],
           

        ]);
        $file ='';
        if ($request->vehicle_image == null){
            $file = $request->previous_invoice_upload;
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
            'volume' => $request->volume,
            'partial_fuel' => $request->partial_fuel,
            'price' => $request->price,
            'vendor' => $request->vendor,
            'invoice_no' => $request->invoice_no,
            'invoice_upload' => $file,
        ];
        Fuel::whereId($id)->update($data);
        return redirect()->back()->with('success','Fuel  has been updated successfully');
    }

    public function deleteFuel($id)
    {
        Fuel::destroy($id);
        return redirect()->back()->with('success','Fuel has been deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Driver;
use App\Models\User;
use DataTables;

class DriverController extends Controller
{
    public function driver()
    {
        $users = User::orderBy('name', 'ASC')->get();
        return view('driver')->with('users',$users);
    }
    public function getdrivers(Request $request){
        if($request->ajax()){
            $data = Driver::latest()->get();
            return Datatables::of($data)
            //**********INDEX COLUMN ************/
            ->addIndexColumn()
              //**********END OF INDEX COLUMN ************/
               //**********NAME COLUMN ************/
            ->addColumn('name', function($row){
                $name = $row->name;
                return $name;
            })
             //**********END OF NAME COLUMN ************/
               //**********SURNAME COLUMN ************/
            ->addColumn('surname', function($row){
                $surname = $row->surname;
                return $surname;
            })
             //**********END OF SURNAME COLUMN ************/
               //**********EMAIL COLUMN ************/
            ->addColumn('email', function($row){
                $email = $row->email;
                return $email;
            })
             //**********END OF EMAIL COLUMN ************/
             //**********PHONE COLUMN ************/
            ->addColumn('phone', function($row){
                $phone = $row->phone;
                return $phone;
            })
             //**********END OF PHONE COLUMN ************/
              //**********USERTYPE COLUMN ************/
            ->addColumn('usertype', function($row){
                $user_type = $row->user_type;
                return $user_type;
            })
             //**********END OF USERTYPE COLUMN ************/
            //**********LICENCE COLUMN ************/
            ->addColumn('licenceno', function($row){
                $licence_no = $row->licence_no;
                return $licence_no;
            })
             //**********END OF LICENCE COLUMN ************/
             //**********LICENCE COLUMN ************/
            ->addColumn('licenceclass', function($row){
                $licence_class = $row->licence_class;
                return $licence_class;
            })
             //**********END OF LICENCE COLUMN ************/
             //**********LICENCE COLUMN ************/
            ->addColumn('licensestate', function($row){
                $license_state = $row->license_state;
                return $license_state;
            })
             //**********END OF LICENCE COLUMN ************/
               //**********LICENCE COLUMN ************/
            ->addColumn('licenseimage', function($row){
                $license_image = '<img src="'.$row->license_image.'" style="width: 50px;height: 50px;" class="border-3 border border-secondary" alt="licence image">';
                return $license_image;
            })
             //**********END OF LICENCE COLUMN ************/
                //**********ACTION COLUMN ************/
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
              //**********END OF ACTION COLUMN ************/
            ->rawColumns(['name','surname','department','email','phone', 'usertype', 'licenceno','licenceclass','licensestate','action'])
            ->make(true);

        }
        return view('driver');
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

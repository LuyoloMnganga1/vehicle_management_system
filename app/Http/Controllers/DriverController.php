<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Driver;
use App\Models\User;
use DataTables;
use Carbon\Carbon;

use Excel;

use App\Imports\ImportDriver;
use App\Http\Controllers\EmailGatewayController;
use App\Http\Controllers\EmailBodyController;

class DriverController extends Controller
{
  
    public static function getUsers(){
        $users = User::orderBy('name', 'ASC')->get();
        return $users;
    }
    public function finduser(Request $request,$id){
        if($request->ajax()){
            $user = User::find($id);
            return response()->json($user);
        }
    }
    public function finddriver(Request $request,$id){
        if($request->ajax()){
            $driver = Driver::join('users','drivers.user_id','=','users.id')->where('drivers.user_id',$id)->select('users.*','drivers.*')->first();
            return  response()->json($driver);
        }
    }
    public function getdrivers(Request $request){
        if($request->ajax()){
            $data = Driver::join('users','drivers.user_id','=','users.id')->latest('drivers.created_at')->get();
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
              //**********DEPARTMENT COLUMN ************/
            ->addColumn('department', function($row){
                $department = $row->department;
                return $department;
            })
             //**********END OF DEPARTMENT COLUMN ************/
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
            ->addColumn('licenseexpirydate', function($row){
                $licenseexpirydate = Carbon::parse($row->license_expiry_date)->formatLocalized('%d, %B %Y');
                return $licenseexpirydate;
            })
             //**********END OF LICENCE COLUMN ************/
                //**********ACTION COLUMN ************/
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" class="view btn btn-info btn-sm" data-id = "'.$row->id.'"><i class="fa fa-eye text-light"></i></a> <a href="javascript:void(0)" class="edit btn btn-warning btn-sm" data-id = "'.$row->id.'"><i class="fa fa-pencil text-light"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="delete" data-href ="/delete-Driver/'.$row->email.'"><i class="fa fa-trash text-light"></i></a>';
                return $actionBtn;
            })
              //**********END OF ACTION COLUMN ************/
            ->rawColumns(['name','surname','department','email','phone','licenceno','licenceclass','licenseexpirydate','action'])
            ->make(true);

        }
        return view('driver.driver');
    }

    public function addDriver(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'string' , 'unique:drivers,user_id'],
            'licence_no' => ['required', 'string' , 'unique:drivers,licence_no'],
            'licence_class' => ['required', 'string' , 'max:225'],
            'license_state' => ['required', 'string' , 'max:100000'],
            'license_expiry_date'=>['required', 'string']
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
            'user_id' => $request->user_id,
            'licence_no' => $request->licence_no,
            'licence_class' => $request->licence_class,
            'license_state' => $request->license_state,
            'license_image' => $img,
            'license_expiry_date'=>$request->license_expiry_date,
        ];
        
        Driver::create($data);
        $mail = new EmailGatewayController();
        $user = User::where('id',$request->user_id)->first();
        $mail->sendEmail($user->email,'ICT Choice | Vehicle Manangement System - Driver Add Confirmation',EmailBodyController::driveradd($user));

        return redirect()->back()->with('success','Driver  has been added successfully');
    }

    public function importDriver (Request $request){
        
        Excel::import(new ImportDriver($request->file));

        return redirect('/')->with('success', 'Drivers successfully added !');
    }
 
    public function updateDriver(Request $request, $id)
    {
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'licence_no' => ['required', 'string' , 'unique:drivers,licence_no,'.$id],
            'license_state' => ['required', 'string' , 'max:100000'],
            'license_expiry_date'=>['required', 'string']
        ]);
        $img ='';
        if ($request->license_image == null){
            $img = $request->previous_image;
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
            'licence_no' => $request->licence_no,
            'licence_class' => $request->licence_class,
            'license_state' => $request->license_state,
            'license_image' => $img,
            'license_expiry_date'=>$request->license_expiry_date,
        ];
        Driver::whereId($id)->update($data);
        return redirect()->back()->with('success','Vehicle has been updated');
    }

    public function deleteDriver($email)
    {
        $id = User::where('email',$email)->value('id');
        Driver::where('user_id','=',$id)->delete();

        $mail = new EmailGatewayController();
        $user = User::where('id',$id)->first();
        $mail->sendEmail($user->email,'ICT Choice | Vehicle Manangement System - Driver Removed Confirmation',EmailBodyController::driverremoved($user));
        
        return redirect()->back()->with('success','Driver has been deleted successfully');
    }
}

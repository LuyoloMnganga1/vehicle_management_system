<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\DashboardController;
use App\Services\sendSMS;
use App\Http\Controllers\EmailGatewayController;
use App\Http\Controllers\EmailBodyController;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
   public function staff(){
    $user = User::orderBy('name','asc')->paginate(7);
     $dep = Department::all();
    return view('staff')->with('user',$user)->with('dep',$dep);
}
public function staffUpdate(Request $request, $id){

 $request->validate([
     'title' => ['required', 'string', 'max:255'],
     'name' => ['required', 'string', 'max:255'],
     'surname' => ['required', 'string', 'max:255'],
     'id_no' => ['required', 'string', 'max:13', 'min:13','unique:users,id_no,'.$id],
     'gender' => ['required', 'string', 'max:255'],
     'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id, 'ends_with:@ictchoice.com,@ictchoice.co.za'],
     'phone' => ['required', 'string','min:10', 'max:10','unique:users,phone,'.$id],
     'communication'=> ['required', 'string', 'max:255'],
     'apointment_date' =>['required', 'string', 'max:255'],
     'department' => ['required', 'string', 'max:255'],
     'job_title' =>['required', 'string', 'max:255'],
     'role' => ['required', 'string', 'max:255'],
     'location' => ['required', 'string', 'max:255'],
 ]);

 if (str_starts_with($request->phone, '0')){
     $phone = "+27".substr($request->phone,1);
 }else{
     return redirect()->back()->withErrors('Ooops! mobile number must start with 0')->withInput();
 }
     $data = User::find($id);
     $role = DB::table('role_user')->where('user_id',$id)->delete();
     User::whereId($id)->update([
         'title' => $request->title,
         'name' =>  ucfirst(strtolower($request->name)),
         'surname' =>  ucfirst(strtolower($request->surname)),
         'id_no' =>$request->id_no,
         'gender' => $request->gender,
         'email' => $request->email,
         'phone' => $phone,
         'communication'=> $request->communication,
         'apointment_date' =>$request->apointment_date,
         'department' => $request->department,
         'job_title' =>$request->job_title,
         'role' => $request->role,
         'location' => $request->location,
     ]);
     $task = "Staff Member : $request->name $request->surname,";
     $event ="Updated";
     $person = "" . Auth::user()->name ." ". Auth::user()->surname . "";
     $date = Carbon::now();
     DashboardController::update_feed($task, $event,  $person, $date );
     $user = User::find($id);
     $role = $user->role;
     $user->attachRole($role);
     $name = User::where('email',$request->email)->value('name');
     $surname = User::where('email',$request->email)->value('surname');

     $sms = new  sendSMS();
     $phone = User::where('email',$request->email)->value('phone');;
     $mesg = "Good day $request->name  $request->surname,\n\nYour account details for  Leave System has been updated.\nAdministrator ";

     $mail = new EmailGatewayController();

     if ($request->communication == 'Email'){
        $mail->sendEmail($request->email,'ICT Choice | Leave Management System - User Account Updated',EmailBodyController::accountupdated($name,$surname));
     }else if($request->communication == 'SMS') {
         $results = $sms->sendSMS($phone,$mesg);
     }else{
         $results = $sms->sendSMS($phone,$mesg);
         $mail->sendEmail($request->email,'ICT Choice | Leave Management System - User Account Updated',EmailBodyController::accountupdated($name,$surname));
     }
 return redirect()->back()->with('success','User deatails updated successfully');
}
public function staffdestroy($id){
     $email = User::where('id',$id)->value('email');
     $user= User::where('id',$id)->first();
     User::destroy($id);
     $task = "Staff Member : $user->name $user->surname,";
     $event ="Deleted";
     $person = "" . Auth::user()->name ." ". Auth::user()->surname . "";
     $date = Carbon::now();
     DashboardController::update_feed($task, $event,  $person, $date );
     $task = "leave Per Staff";
     $event ="Deleted";
     $person = "" . Auth::user()->name ." ". Auth::user()->surname . "";
     $date = Carbon::now();
     DashboardController::update_feed($task, $event,  $person, $date );
 return redirect()->back()->with('success', 'User is successfully deleted');
}

}

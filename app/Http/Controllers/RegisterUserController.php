<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\user_passwords;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\EmailGatewayController;
use App\Http\Controllers\EmailBodyController;
use App\Mail\UserAccount;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use App\Services\sendSMS;
use Carbon\Carbon;
use App\Http\Controllers\DashboardController;

class RegisterUserController extends Controller
{

    public function create()
    {
        $department = Department::all();
        $date = Carbon::now();
        return view('auth.register')->with('dep',$department)->with('date',$date);
    }

    public function store(Request $request)
    {
        $request->name = Str::lower($request->name);
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'id_no' => ['required', 'string', 'max:13','min:13','unique:users'],
            'gender' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'ends_with:@ictchoice.com,@ictchoice.co.za'],
            'phone' => ['required', 'string','min:10', 'max:10','unique:users'],
            'communication'=> ['required', 'string', 'max:255'],
            'apointment_date' =>['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'job_title' =>['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        if (str_starts_with($request->phone, '0')){
            $phone = "+27".substr($request->phone,1);
        }else{
            return redirect()->back()->withErrors('Ooops! mobile number must start with 0')->withInput();
        }

        $validated = $validator->validated();
        $user = User::create([
            'title' => $request->title,
            'name' => $request->name,
            'surname' => $request->surname,
            'id_no' => $request->id_no,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $phone,
            'communication'=> $request->communication,
            'apointment_date' => $request->apointment_date,
            'department' => $request->department,
            'job_title' => $request->job_title,
            'role' => $request->role,
            'location' => $request->location,
        ]);
               

        $name = User::where('email',$request->email)->value('name');
        $surname = User::where('email',$request->email)->value('surname');
        $id = User::where('email',$request->email)->value('id');
        $token = Str::random(20);
        $user->attachRole($request->role);
        $mail = new EmailGatewayController();

        $sms = new  sendSMS();
        $phone = User::where('email',$request->email)->value('phone');;
        $mesg = "Good day $request->name  $request->surname, \n
        Your account for Vehicle System has been created.\n
        Use the link to set password :  http://127.0.0.1:8000/passwordCreate/{$id}/{$token} \n
        Adminstrator ";

        if ($request->communication == 'Email'){
            $mail->sendEmail($request->email,'ICT Choice | Vehicle Management System - User Account Created',EmailBodyController::useraccount($name,$surname,$id,$token));
        }else if($request->communication == 'SMS') {
            $results = $sms->sendSMS($phone,$mesg);
        }else{
            $results = $sms->sendSMS($phone,$mesg);
            $mail->sendEmail($request->email,'ICT Choice | Vehicle Management System - User Account Created',EmailBodyController::useraccount($name,$surname,$id,$token));
        }
        $task = "Staff Member : $request->name  $request->surname";
        $event ="registered";
        $person = "" . Auth::user()->name ." ". Auth::user()->surname . "";
        $date = Carbon::now();
        $feeds = DashboardController::update_feed($task, $event,  $person, $date );
        return redirect()->back()->with('success','New user created successfully');
    }
    public function passwordCreate($id,$token){
        $date = Carbon::now();
        $data = User::where('id', $id)->get();
        return view('auth.password')->with('data', $data)->with('token',$token)->with('date',$date);
    }
    public function password(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required',
            'regex:/[a-z]/',      // must contain at least one lowercase letter
            'regex:/[A-Z]/',      // must contain at least one uppercase letter
            'regex:/[0-9]/',      // must contain at least one digit
            'regex:/[@$!%*#?&]/', // must contain a special character
            'min: 8',
            'confirmed',],
            'token' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect('passwordCreate/'.$id.'/'.$request->token)
                        ->withErrors($validator)
                        ->withInput();
        }
        $validated = ['password' => Hash::make($request->password)];
        $user_password = User::where('id',$id)->value('password');
        if(!($user_password == null)){
            return redirect()->route('login')->withErrors('Password has already been created');
        }
        User::whereId($id)->update($validated);
        user_passwords::create([
            'user_id'=> $id,
            'old_password'=> Hash::make($request->password),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user =User::where('id',$id)->first();
        $task = "Password";
        $event ="created";
        $person = "" . $user->name ." ". $user->surname . "";
        $date = Carbon::now();
        $feeds = DashboardController::update_feed($task, $event,  $person, $date );
        return redirect()->back()->with('success','Your password created successfully');
    }
    public function staffdestroy($id){
        User::destroy($id);
        return redirect()->back()->with("success","User deleted!");
    }
    public function profile_image(Request $request){
        $id = Auth::user()->id;
        $path='';
            if($request->hasFile('image')){
                $img = auth()->id() . '_' . time() . '_profile_image.'. $request->image->extension();
                $request->image->move(public_path('images/profiles'), $img);
                $path = 'images/profiles/'.$img;
            }
        User::whereId($id)->update(['profile'=>$path]);
        return redirect()->back()->with('success', 'Image updated successfully');
    }
    public function signature(Request $request){
        $id = Auth::user()->id;
        User::whereId($id)->update(['signature'=>$request->signature]);
        return redirect()->back()->with('success', 'Signature captured successfully');

    }
}

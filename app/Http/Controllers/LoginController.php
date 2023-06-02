<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\sendSMS;
use Carbon\Carbon;
use App\Models\user_passwords;
use App\Http\Controllers\EmailGatewayController;
use App\Http\Controllers\EmailBodyController;

class LoginController extends Controller
{

    public function create()
    {
        $date = Carbon::now();
       return view('auth.login')->with("date",$date);
    }
    
    public function auth_by_portal($email){
        
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        
        $user = User::where('email',$email)->first();
        
        if ($user == null){
            if(str_ends_with($email,".com")){
                
               $email = str_replace(".com",".co.za",$email);
                
            }else{
                $email = str_replace(".co.za",".com",$email);
            }
            
            $user = User::where('email',$email)->first();
        }
       
       if($user == null){
            return redirect()->route('login')->withErrors('Invalid credentials please contact the administrator for assistance.');
        }
       
        if ( Auth::loginUsingId($user->id)) {
        //   Auth::logoutOtherDevices(request('password'));
            $password_d = user_passwords::where('user_id',Auth::user()->id)->orderBy('updated_at', 'desc')->value('updated_at');
            $now = Carbon::now();
            $password_date = new Carbon($password_d);
            if( $password_date->diffInDays($now) >= 90){
                Auth::logout();
                return redirect('forgetPassword')->withErrors('Ooops! Password has expired, request for new link to reset your password');
            }else{
                $results = $this->sendOTP();
                if($results == true){
                    return redirect()->route('verify')->with('success','OTP has been sent.');
                }else {
                    Auth::logout();
                    return redirect('login')
                            ->withErrors('Sorry we couldn\'t send the OTP via SMS, the number registered under your account doesn\'t exits contact the  System Administrator for help');
                }
            }

        }
        return redirect('login')->withErrors([
            'email' => 'Invalid credentials, please try again.',
        ]);
    }

    public function authenticate(Request $request)
    {


        $credentials = $request->validate([
            'email' => ['required', 'email', ],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $password_d = user_passwords::where('user_id',Auth::user()->id)->orderBy('updated_at', 'desc')->value('updated_at');
            $now = Carbon::now();
            $password_date = new Carbon($password_d);
            if( $password_date->diffInDays($now) >= 90){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('forgetPassword')->withErrors('Ooops! Password has expired, request for new link to reset your password');
            }else{
                $results = $this->sendOTP();
                if($results == true){
                    return redirect()->route('verify')->with('success','OTP has been sent.');
                }else {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect('login')
                            ->withErrors('Sorry we couldn\'t send the OTP via SMS, the number registered under your account doesn\'t exits contact the  System Administrator for help');
                }
            }

        }
        return redirect('login')->withErrors([
            'email' => 'Invalid credentials, please try again.',
        ]);
    }
    public function verifyOTP(Request $request){

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'otp' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect('verify')
                        ->withErrors($validator)
                        ->withInput();
        }

        $otp = User::where('email',Auth::user()->email)->value('one_time_pin');
        $dt = User::where('email',Auth::user()->email)->value('one_time_pin_date');
        $otp_date = new Carbon($dt);
        $now = Carbon::now();

        if($otp == $request->otp){
            if($otp_date->diffInMinutes($now) <= 2){
                User::where('email',Auth::user()->email)->update(['user_one_time_pin'=>$request->otp]);
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }else{
                return redirect('verify')->withErrors('Ooops! OTP expired, request for new OTP')->withInput();
            }
        }
        return redirect('verify')->withErrors('Incorrect OTP. Enter the correct OTP');
    }
    public function verify(){
        $date = Carbon::now();
        return view('auth.otp')->with('date',$date);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function resendOTP(){
        $send = $this->sendOTP();
        if($send == true){
            return redirect()->route('verify')->with('success','OTP has been re-sent.');
        }
    }
    public function sendOTP(){
        $name = Auth::user()->name;
        $surname = Auth::user()->surname;
        $email = Auth::user()->email;;
        $phone = User::where('email',$email )->value('phone');
        $id = User::where('email',$email )->value('id');
        $one_time_pin = $this->genOTP();
        $one_time_pin_date =Carbon::now()->toDateTimeString();
        User::whereId($id)->update(['one_time_pin'=>$one_time_pin,'one_time_pin_date'=>$one_time_pin_date,]);
        $mesg = "Vehicle Management System OTP: ". $one_time_pin . " . This OTP will expire in 2 minutes";
        $sms = new  sendSMS();
        $mail = new EmailGatewayController();
        if (Auth::user()->communication == 'Email'){
            $mail->sendEmail($email,'ICT Choice | Vehicle Manangement System - OTP verification',EmailBodyController::sendotp($name,$surname,$mesg));
            $results = true;
        }else if(Auth::user()->communication == 'SMS') {
            $results = $sms->sendSMS($phone,$mesg);
        }else{
            $results = $sms->sendSMS($phone,$mesg);
            $mail->sendEmail($email,'ICT Choice | Vehicle Manangement System - OTP verification',EmailBodyController::sendotp($name,$surname,$mesg));
        }
        return $results;
    }
    public function genOTP(){
        $otp =  rand(1,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
        return $otp;
    }
}

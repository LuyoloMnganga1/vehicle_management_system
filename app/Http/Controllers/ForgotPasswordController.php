<?php 

namespace App\Http\Controllers; 

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\User; 
use Carbon\Carbon; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Mail\forgotPassword;


class ForgotPasswordController extends Controller
{
  public function getEmail()
  {
    $date = Carbon::now();
     return view('auth.forgotPassword')->with("date",$date);
  }

 public function postEmail(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|exists:users',
    ]);
    if ($validator->fails())
    {
      return redirect('forgetPassword')
                  ->withErrors($validator)
                  ->withInput();
    }
    $token = Str::random(25);
    
      DB::table('password_resets')->insert(
          ['email' => $request->email,
           'token' => $token, 
           'created_at' => Carbon::now()]
      );
      $id = User::where('email',$request->email)->value('id');
      Mail::to($request->email)->send( new forgotPassword($id,$token));

      return back()->with('message', 'A fresh verification link has been sent to your email address!');
  }
 
}

<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\user_passwords;

class ResetPasswordController extends Controller {

  public function getPassword($id,$token) {
    $email = User::where('id',$id)->value('email');
    $dd = DB::table('password_resets')->where('email',$email)->orderBy('created_at', 'desc')->first();
    $tken = $dd->token;
    if ($tken !== $token){
      return redirect()->route('login');
    }

    if (!$token || !$email){
      return redirect()->route('login');
    }

    $dt = $dd->created_at;
    $tkdate = new Carbon($dt);
    $now = Carbon::now();


      if($tkdate->diffInMinutes($now) <= 3){
        return view('auth.resetPassword', ['token' => $token])->with('email',$email)->with('date',$now);
      }else{
          return redirect('forgetPassword')->withErrors('Ooops! link expired, request for new link');
      }

  }

  public function updatePassword(Request $request)
  {

    $request->validate([
      'email' => 'required|email|exists:users',
      'password' => ['required',
            'regex:/[a-z]/',      // must contain at least one lowercase letter
            'regex:/[A-Z]/',      // must contain at least one uppercase letter
            'regex:/[0-9]/',      // must contain at least one digit
            'regex:/[@$!%*#?&]/', // must contain a special character
            'min: 8',
            'confirmed'],
      'password_confirmation' => 'required',

  ]);


  $updatePassword = DB::table('password_resets')
                      ->where(['email' => $request->email, 'token' => $request->token])
                      ->first();

  if(!$updatePassword)
      return back()->withInput()->with('error', 'Invalid token!');

  $id = User::where('email', $request->email)->value('id');
  $user_passwords = user_passwords::where('user_id',$id)->orderBy('updated_at', 'desc')->pluck('old_password');


  $count = 0;
    foreach($user_passwords as $pass)
    {
      if((Hash::check($request->password, $pass)))
      {
        $count ++;
      }
    }

   if($count > 5){
        return back()->withInput()->withErrors('Ooops!, The password has been used 5 times, please generate a new password!');
    }


  $user = User::where('email', $request->email)
          ->update(['password' => Hash::make($request->password)]);

  $id = User::where('email', $request->email)->value('id');
  user_passwords::create([
      'user_id'=> $id,
      'old_password'=> Hash::make($request->password),
      'updated_at' => Carbon::now(),
  ]);

  return redirect()->back()->with('success', 'Your password has been changed successfully!');

  }
  public function updatePasswordbyUser(Request $request)
  {
    $request->validate([
      'email' => 'required|email|exists:users',
      'current_password'=> ['required'],
      'password' => ['required',
            'regex:/[a-z]/',      // must contain at least one lowercase letter
            'regex:/[A-Z]/',      // must contain at least one uppercase letter
            'regex:/[0-9]/',      // must contain at least one digit
            'regex:/[@$!%*#?&]/', // must contain a special character
            'min: 8',
            'confirmed'],
      'password_confirmation' => 'required',

  ]);
  $user_password = User::where('email',$request->email)->value('password');
  if (!(Hash::check($request->current_password, $user_password))){
    return back()->withInput()->withErrors('Ooops!, Current password don\'t match our records!');
  }

  $id = User::where('email', $request->email)->value('id');
  $user_passwords = user_passwords::where('user_id',$id)->orderBy('updated_at', 'desc')->pluck('old_password');

  $count = 0;
    foreach($user_passwords as $pass)
    {
      if((Hash::check($request->password, $pass)))
      {
        $count ++;
      }
    }

   if($count > 5){
        return back()->withInput()->withErrors('Ooops!, The password has been used 5 times, please generate a new password!');
    }


  $user = User::where('email', $request->email)
          ->update(['password' => Hash::make($request->password)]);

  $id = User::where('email', $request->email)->value('id');
  user_passwords::create([
      'user_id'=> $id,
      'old_password'=> Hash::make($request->password),
      'updated_at' => Carbon::now(),
  ]);

  return redirect()->back()->with('message', 'Your password has been Updated successfully!');

  }
}

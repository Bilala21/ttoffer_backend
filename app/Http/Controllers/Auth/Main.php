<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Hash;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mail;
use Illuminate\Support\Str;
use App\Mail\Reset;
class Main extends Controller
{

    public function forgot_pass(){
        return view("auth.forget-pass");
    }

    public function new_password_view()
    {
        return view('auth.new-password');
    }
    public function reset_code_view()
    {
        return view('auth.reset-code');
    }

    public function reset_code(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);
        $user_id = session('user_id');
        $sql = DB::select("SELECT * FROM users where code=$request->otp AND id=$user_id");
        if (count($sql) > 0) {
            session(['new_password' => 'allow']);
            session(['id_user' => $user_id]);
            $sql = DB::select("UPDATE `users` SET code=0 WHERE id=$user_id");
            $response = array(
                'status' => 'success',
                'msg' => 'OTP verified, Redirecting...',
                'url' => url('new-password'), 
              );
              return response()->json($response);
        } else {
            $response = array(
                'status' => 'error',
                'msg' =>"You've entered incorrect code!",
            );
            return response()->json($response);
        }

    }

    public function new_password(Request $request)
    {
        if (session()->has('new_password')) {
            $user_id = session('id_user');
            $validator_a = Validator::make($request->all(), [
                'pass' => 'required',
            ]);
            if ($validator_a->fails()) {
                $response = array(
                    'status' => 'error',
                    'msg' => $validator_a->errors()->first(),
                );
                return response()->json($response);
            }
            DB::table('users')
                ->where('id', $user_id)
                ->update(['password' => Hash::make($request->pass)]);
            session()->forget('new_password');
            $response = array(
                'status' => 'success',
                'msg' => 'Your password has been updated. You can now log in using your new password, Redirecting...',
                'url' => url('/'), 
              );
              return response()->json($response);

        } else {
            $response = array(
                'status' => 'error',
                'msg' => 'Un-Authorized Access, Redirecting...',
                'url' => url('/'), 
              );
              return response()->json($response);
        }

    }

      // Forgot Pass
      public function forgot_pass_p(Request $request)
      {
          $validator_a = Validator::make($request->all(), [
              'email' => 'required|email',
          ]);
          if ($validator_a->fails()) {
              $response = array(
                  'status' => 'error',
                  'msg' => $validator_a->errors()->first(),
              );
              return response()->json($response);
          }
          if (User::where('email', $request->email)->exists()) {
              $data = User::where('email', $request->email)
                  ->first();
                  if($data->provider!=='site'){
                        $response = array(
                  'status' => 'error',
                  'msg' => "This email utilizes a different login method!",
              );
              return response()->json($response);
                  }
              session(['user_id' => $data->id]);
              session(['user_email' => $data->email]);
              $code = rand(100000, 999999);
              User::where('id', $data->id)
                  ->update(['code' => $code]);
              $mailData = [
                  'title' => 'Password Reset Code',
                  'body' => $code,
              ];
              Mail::to($request->email)->send(new Reset($mailData));
              session(['reset_code' => 'allow']);
              $response = array(
                  'status' => 'success',
                  'msg' => 'We have sent a password reset otp code to your email',
                  'url' => url('/reset-code'), 
                );
                return response()->json($response);
          } else {
              $response = array(
                  'status' => 'error',
                  'msg' => "Email doesn't exist!",
              );
              return response()->json($response);
          }
      }
      
    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return redirect('/')->withSuccess('You are logged out!');
    }
    public function login_p_username(Request $request){
        $validator_a = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator_a->fails()) {
            $response = array(
                'status' => 'error',
                'msg' => $validator_a->errors()->first(),
            );
            return response()->json($response);
        }
        if (User::where('username', $request->username)->exists()) {
            $user_email = $request->username;
            $user = User::where('username', $user_email)->first();
            if ($user->provider !== 'site') {
                $response = array(
                    'status' => 'error',
                    'msg' => 'This account utilizes a different login method!',
                );
                return response()->json($response);
            }
        } else {
            $response = array(
                'status' => 'error',
                'msg' => 'Login details are not valid!',
            );
            return response()->json($response);
        }
        
        $user_data = User::where('username', $user_email)->first();
        if (intval($user_data->status) !== 1) {
              $response = array(
                    'status' => 'error',
                    'msg' => 'Your account is blocked by admin!',
                );
                return response()->json($response);
        }
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $response = array(
                'status' => 'success',
                'msg' => 'You are logged in successfully, Redirecting...',
              );
              return response()->json($response);
        }
        $response = array(
            'status' => 'error',
            'msg' => 'Login details are not valid!',
        );
        return response()->json($response);
    }
    public function login_p(Request $request){
        $validator_a = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator_a->fails()) {
            $response = array(
                'status' => 'error',
                'msg' => $validator_a->errors()->first(),
            );
            return response()->json($response);
        }
        if (User::where('email', $request->email)->exists()) {
            $user_email = $request->email;
            $user = User::where('email', $user_email)->first();
            if ($user->provider !== 'site') {
                $response = array(
                    'status' => 'error',
                    'msg' => 'This email utilizes a different login method!',
                );
                return response()->json($response);
            }
        } else {
            $response = array(
                'status' => 'error',
                'msg' => 'Login details are not valid!',
            );
            return response()->json($response);
        }
        
        $user_data = User::where('email', $user_email)->first();
        if (intval($user_data->status) !== 1) {
              $response = array(
                    'status' => 'error',
                    'msg' => 'Your account is blocked by admin!',
                );
                return response()->json($response);
        }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $response = array(
                'status' => 'success',
                'msg' => 'You are logged in successfully, Redirecting...',
              );
              return response()->json($response);
        }
        $response = array(
            'status' => 'error',
            'msg' => 'Login details are not valid!',
        );
        return response()->json($response);
    }

    public function signup_p(Request $request){
        $validator_a = Validator::make($request->all(), [
            'name'=>'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:3',
        ]);
        if ($validator_a->fails()) {
            $response = array(
                'status' => 'error',
                'msg' => $validator_a->errors()->first(),
            );
            return response()->json($response);
        }
        $user = User::create([
            'name' => $request->name,
            'user_type' => 'user',
            'username' => $request->username,
            'email' => $request->email,
            'status' => 1,
            'provider' => 'site',
            'src' => 'site',
            'password' => Hash::make($request->password)
        ]);
        $user_id = $user->id;
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $response = array(
                'status' => 'success',
                'msg' => 'Account Regsitered, Redirecting...',
              );
              return response()->json($response);
        } else {
            $response = array(
                'status' => 'success',
                'msg' => 'Account Regsitered, Please Login',
              );
              return response()->json($response);
        }
    }
}

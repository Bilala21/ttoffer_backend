<?php

namespace App\Http\Controllers\APi\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Hash;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Illuminate\Support\Str;
use Mail;
use App\Mail\Reset;
use Twilio\Rest\Client;


class Main extends Controller
{
    public function reset_code(Request $request)
    {
        $validator_a = Validator::make($request->all(), [
            'email' => 'required',
            'otp' => 'required',
        ]);
        if ($validator_a->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator_a->errors(),
            ], 401);
        }
        $email = $request->email;
        $sql = DB::select("SELECT * FROM users where code=$request->otp AND email='$email'");
        if (count($sql) > 0) {
            $sql = DB::select("UPDATE `users` SET code=0 WHERE email='$email'");
            $data = User::where('email',$email)->first();
              return response()->json([
                'status' => 'success',
                'msg' => 'OTP verified, Redirecting...',
                'data' => $data,
              ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'msg' =>"You've entered incorrect code!",
            ], 401);
        }

    }

    public function new_password(Request $request)
    {
        $validator_a = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator_a->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator_a->errors(),
            ], 401);
        }
        $email = $request->email;
        $data = User::where('email',$email)->first();
        if(!$data){
            return response()->json([
                'status' => 'error',
                'msg' => 'User not found!',
            ], 401);
        }
        if($data->social_login == 1 ) {
            return response()->json([
                'status' => 'error',
                'msg' => "You can't update your password, as you are loggedIn using Social Account!",
            ], 403);
        }
            DB::table('users')
                ->where('email', $email)
                ->update(['password' => Hash::make($request->password)]);
              return response()->json([
                'status' => 'success',
                'msg' => 'Your password has been updated.',
                'data' => $data,
              ], 200);

    }

    public function new_password_phone(Request $request)
    {
        $validator_a = Validator::make($request->all(), [
            'phone' => 'required|regex:/^\+[0-9]+$/',
            'password' => 'required',
        ]);
        if ($validator_a->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator_a->errors(),
            ], 401);
        }
        $phone = $request->phone;
        $data = User::where('phone',$phone)->first();
        if(!$data){
            return response()->json([
                'status' => 'error',
                'msg' => 'User not found!',
            ], 401);
        }

        DB::table('users')
        ->where('phone', $phone)
        ->update(['password' => Hash::make($request->password)]);

        return response()->json([
            'status' => 'success',
            'msg' => 'Your password has been updated.',
            'data' => $data,
        ], 200);

    }

    public function forgot_pass_p(Request $request)
    {
        $validator_a = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator_a->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator_a->errors(),
            ], 401);
        }
        $data = User::where('email', $request->email)
            ->first();
        if ($data) {
            if($data->provider!=='site') {
                return response()->json([
                    'status' => 'error',
                    'msg' => "This   email utilizes a different login method!",
                ], 401);
            }
            if($data->social_login == 1 ) {
                return response()->json([
                    'status' => 'error',
                    'msg' => "You can't update your password, as you are loggedIn using Social Account!",
                ], 403);
            }
            $code = rand(100000, 999999);
            $data->code = $code;
            $data->save();
            $mailData = [
                'title' => 'Password Reset Code',
                'body' => $code,
            ];
            Mail::to($data->email)->send(new Reset($mailData));
            return response()->json([
                'status' => 'success',
                'msg' => 'We have sent a password reset otp code to your email',
                'otp' => $code,
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
            'status' => 'error',
            'msg' => "Email doesn't exist!",
            ], 401);
        }
    }

    public function forgot_pass_phone(Request $request)
    {      
        $validator_a = Validator::make($request->all(), [
            'phone' => 'required|regex:/^\+[0-9]+$/',
        ]);
        if ($validator_a->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator_a->errors(),
            ], 401);
        }
        $data = User::where('phone', $request->phone)
            ->first();
        if ($data) {
            $twilio = new Client(
                config('services.twilio.sid'),
                config('services.twilio.token')
            );
    
            $to = $request->phone;
            $channel = "sms";
            
            $twilioWhatsapp = new Client(
                config('services.twilio.sid'),
                config('services.twilio.token')
            );
    
            $to = $request->phone;
            $channelW = "whatsapp";
            try {
                $response = $twilio->verify->v2->services(config('services.twilio.verify_sms_sid'))
                ->verifications
                ->create($to, $channel);
                
                $response2 = $twilioWhatsapp->verify->v2->services(config('services.twilio.verify_whatsapp_sid'))
                ->verifications
                ->create($to, $channelW);
                
                // $code = 192383;
                // $message = "TTofer: Your verification code is " . $code;
                // $response = $twilio->messages->create(
                //     $to,  // Send to this number
                //     [
                //         // 'from' => config('services.twilio.from'),  // Twilio phone number
                //         'from' => '+971 50 265 1684',

                //         'body' => $message  // Custom message body
                //     ]
                // );
                
                return response()->json([
                    'status' => 'success',
                    'msg' => "Verification code sent successfully.",
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'msg' => "Something Went Wrong",
                    'error_details' => $e->getMessage(),
                ], 400);
            }

        } else {
            return response()->json([
            'status' => 'error',
            'msg' => "Phone Number doesn't exist!",
            ], 401);
        }
    }

    public function verify_forgot_pass_phone(Request $request)
    {
        $validator_a = Validator::make($request->all(), [
            'phone' => 'required|regex:/^\+[0-9]+$/',
            'code' => 'required|max:6',
        ]);
        if ($validator_a->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator_a->errors(),
            ], 401);
        }
        $twilio = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
        $to = $request->phone;
        $code = $request->code;
        $respone = $twilio->verify->v2->services(config('services.twilio.verify_sms_sid'))
        ->verificationChecks
        ->create([
            'to' => $to,
            'code' => $code
        ]);
        
        $twilioW = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
        // $to = $request->phone;
        // $code = $request->code;
        $responeW = $twilioW->verify->v2->services(config('services.twilio.verify_whatsapp_sid'))
        ->verificationChecks
        ->create([
            'to' => $to,
            'code' => $code
        ]);
        
        if ($respone->status === 'approved') {
            return response()->json([
                'status' => 'success',
                'msg' => "Verification successful.",
            ], 401);
        }
        return response()->json([
            'status' => 'error',
            'msg' => "Invalid verification code.",
        ], 422);
    }

    public function signup(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
            'social_login' => 'in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 401); // Bad Request
        }

        $is_true_you = 0;
        if(isset($request->is_true_you)){
            $is_true_you = $request->is_true_you;
        }

        if(isset($request->email)){
            $checkUnique = User::where("email", $request->email)->first();
            if($checkUnique != null)
            {
                return response()->json([
                'status' => 'error',
                'message' => "Email address already taken."
                ], 409);
                
            }
            $user = User::create([
                'name' => $request->name,
                'user_type' => 'user',
                'username' => $request->username,
                'email' => $request->email,
                'status' => 1,
                'provider' => 'site',
                'src' => 'app',
                'is_true_you' => $is_true_you,
                'social_login' => $request->social_login,
                'password' => Hash::make($request->password),
            ]);
            $data = User::where('id',$user->id)->first();

            $credentials['email']    = $request->email;
            $credentials['password']    = $request->password;

            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'Unauthorized'], 401);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'Could not create token'], 500);
            }
        }elseif(isset($request->phone)){
            $checkUnique = User::where("phone", $request->phone)->first();
            if($checkUnique != null)
            {
                return response()->json([
                'status' => 'error',
                'message' => "Phone number already taken."
                ], 409);
                
            }
            $user = User::create([
                'name' => $request->name,
                'user_type' => 'user',
                'username' => $request->username,
                'phone' => $request->phone,
                'status' => 1,
                'provider' => 'site',
                'src' => 'app',
                'is_true_you' => $is_true_you,
                'password' => Hash::make($request->password),
            ]);
            $data = User::where('id',$user->id)->first();

            $credentials['phone']    = $request->phone;
            $credentials['password']    = $request->password;

            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'Unauthorized'], 401);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'Could not create token'], 500);
            }
        }


        $return['user']   = $data;
        $return['token']  = $token;

        return response()->json([
            'status' => 'success',
            'data' => $return,
            'message' => 'Account registered, redirecting...',
        ], 200); // Created
    }

    public function login_with_username(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 401); // Unprocessable Entity
        }

        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Login details are not valid!',
            ], 401); // Unauthorized
        }

        if ($user->provider !== 'site') {
            return response()->json([
                'status' => 'error',
                'message' => 'This account utilizes a different login method!',
            ], 401); // Unauthorized
        }

        if (intval($user->status) !== 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your account is blocked by admin!',
            ], 401); // Forbidden
        }
        $credentials['phone'] = $request->phone;
        $credentials['password'] = $request->password;

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        $return['user']   = $user;
        $return['token']  = $token;

        // if (!Auth::attempt($credentials)) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Login details are not valid!',
        //     ], 401); // Unauthorized
        // }

        return response()->json([
            'status' => 'success',
            'message' => 'You are logged in successfully.',
            'data' => $return,
        ], 200); // OK
    }

    public function login_with_email(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 401); // Unprocessable Entity
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Login details are not valid!',
            ], 401); // Unauthorized
        }

        if ($user->provider !== 'site') {
            return response()->json([
                'status' => 'error',
                'message' => 'This account utilizes a different login method!',
            ], 401); // Unauthorized
        }

        if (intval($user->status) !== 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your account is blocked by admin!',
            ], 401); // Forbidden
        }

        $credentials['email']    = $request->email;
        $credentials['password'] = $request->password;

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        $return['user']   = $user;
        $return['token']  = $token;

        // if (!Auth::attempt($request->only('email', 'password'))) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Login details are not valid!',
        //     ], 401); // Unauthorized
        // }

        return response()->json([
            'status' => 'success',
            'message' => 'You are logged in successfully.',
            'data' => $return,
        ], 200); // OK
    }

    public function device_token_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 401); // Unprocessable Entity
        }

        $user_id = $request->user_id;
        $token = $request->token;

        $user = User::find($user_id)->update(['device_token'=>$token]);
        return response()->json([
            'status' => 'success',
            'message' => 'Device Token updated successfully.',
            'data' => $user,
        ], 200); // OK

    }

    public function verify_phone(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required|regex:/^\+[0-9]+$/',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 401); // Unprocessable Entity
        }

        $twilio = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
        
        $twilioW = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );

        $to = $request->phone;
        $channel = "sms";
        $channelW = "whatsapp";
        try {
            $response = $twilio->verify->v2->services(config('services.twilio.verify_sms_sid'))
            ->verifications
            ->create($to, $channel);
            
            $responseW = $twilioW->verify->v2->services(config('services.twilio.verify_whatsapp_sid'))
            ->verifications
            ->create($to, $channelW);
            
            return response()->json([
                'status' => 'success',
                'msg' => "Verification code sent successfully.",
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => "Something Went Wrong",
            ], 400);
        }

        // $data = User::where('phone', $request->phone)
        //     ->first();
        // if ($data) {
        //     $twilio = new Client(
        //         config('services.twilio.sid'),
        //         config('services.twilio.token')
        //     );
    
        //     $to = $request->phone;
        //     $channel = "sms";
        //     try {
        //         $response = $twilio->verify->v2->services(config('services.twilio.verify_sms_sid'))
        //         ->verifications
        //         ->create($to, $channel);
        //         return response()->json([
        //             'status' => 'success',
        //             'msg' => "Verification code sent successfully.",
        //         ], 200);
        //     } catch (\Exception $e) {
        //         return response()->json([
        //             'status' => 'error',
        //             'msg' => "Something Went Wrong",
        //         ], 400);
        //     }

        // } else {
        //     return response()->json([
        //     'status' => 'error',
        //     'msg' => "Phone Number doesn't exist!",
        //     ], 401);
        // }
    }

    public function verify_code_phone(Request $request)
    {
        $validator_a = Validator::make($request->all(), [
            'phone' => 'required|regex:/^\+[0-9]+$/',
            'code' => 'required|max:6',
        ]);
        if ($validator_a->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator_a->errors(),
            ], 401);
        }
        $twilio = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
        $to = $request->phone;
        $code = $request->code;
        $respone = $twilio->verify->v2->services(config('services.twilio.verify_sms_sid'))
        ->verificationChecks
        ->create([
            'to' => $to,
            'code' => $code
        ]);
        
        $twilioW = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
        $responeW = $twilioW->verify->v2->services(config('services.twilio.verify_whatsapp_sid'))
        ->verificationChecks
        ->create([
            'to' => $to,
            'code' => $code
        ]);
                
        if ($respone->status === 'approved' || $responeW->status === 'approved') {
            $update = User::find(JWTAuth::user()->id)->update(['phone_verified_at'=>date('Y-m-d H:i:s'),'phone'=>$request->phone]);
            return response()->json([
                'status' => 'success',
                'msg' => "Verification successful.",
            ], 401);
        }
        return response()->json([
            'status' => 'error',
            'msg' => "Invalid verification code.",
        ], 422);
    }

    public function sms_check(){
        try{
            // return json_encode([ '1' => '123']);
            $dummy = "+923009472575";
            $to = request()->query('phone') ?? $dummy;
            $code = request()->query('code') ?? 'check';
            
            // return ($to[0] == '+' ? $to : '+'.$to);

// return [config('services.twilio.token'), config('services.twilio.verify_sms_sid'), config('services.twilio.verify_whatsapp_sid')];
            // $twilio = new Client(
            //     config('services.twilio.sid'),
            //     config('services.twilio.token')
            // );
            // $channel = "sms";
            
            $twilioWhatsapp = new Client(
                config('services.twilio.sid'),
                config('services.twilio.token')
            );
            $channelW = "whatsapp";
            
            // $response = $twilio->verify->v2->services(config('services.twilio.verify_sms_sid'))
            //                 ->verifications
            //                 ->create(($to[0] == '+' ? $to : '+'.$to), $channel);
            
            $vCode = '{"1":"'.$code.'"}';
            $response2 = $twilioWhatsapp->messages
            ->create("whatsapp:".($to[0] == '+' ? $to : '+'.$to), // to
                array(
                  "from" => "whatsapp:+14155238886",
                  "contentSid" => "HX229f5a04fd0510ce1b071852155d3e75",
                  "contentVariables" => $vCode,
                  "body" => "TTOffer, please enter this code to verify your number"
                )
            );
                
            // $response2 = $twilioWhatsapp->verify->v2->services(config('services.twilio.verify_whatsapp_sid'))
            //                 ->verifications
            //                 ->create(($to[0] == '+' ? $to : '+'.$to), $channelW);
    
            dd(['sms' =>$respone ?? "", 'whatsapp' => $response2]);
            // dd($respone->status);
        }
        catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => "Something Went Wrong",
                'error_details' => $e->getMessage(),
            ], 400);
        }
    }
}

<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Review;
use App\Models\ReportUsers;
use App\Models\BlockedUsers;
use JWTAuth, DB, Carbon\Carbon;
use Hash;
use Mail;
// use DB;
// use Carbon\Carbon;
use App\Mail\VerifyEmail;
use App\Models\Product;
use App\Models\Auction;
use App\Models\MakeOffer;

class Profile extends Controller
{
    public function index(){
        $id = JWTAuth::user()->id;
        $user = User::with('reviews')->find($id);
        return $this->sendResponse($user,'User Retrived Successfully.');
    }
    
    public function deactivate($id, Request $request){
        // Validate both $id and request data
        $validator = Validator::make(array_merge($request->all(), ['id' => $id]), [
            'id' => 'required|integer|exists:users,id',  // Replace 'your_table_name' with the correct table name
        ]);
    
        // If validation fails, return an error response
        if ($validator->fails()) {
            return $this->sendError($validator->errors(), [], 401);
        }
        
        try{
            DB::beginTransaction();
            // $user = JWTAuth::user();
            $user = User::find($id);
            if($user){
                $user_2 = User::where('id', $user->id)->first();
                $user_2->delete();
                $products = Product::where('user_id', $user->id)->delete();
                $reviewFrom = Review::where('from_user', $user->id)->delete();
                $reviewTo = Review::where('to_user', $user->id)->delete();
                $auction = Auction::where('user_id', $user->id)->delete();
                $makeOfferSeller = MakeOffer::where('seller_id', $user->id)->delete();
                $makeOfferBuyer = MakeOffer::where('buyer_id', $user->id)->delete();
                
                $user->delete();
                
                DB::commit();
                return $this->sendResponse($user, 'User Deactivated Successfully.');

            }
            else
                return response()->json([
                    'status'    => 'error',
                    'msg'       => "User not found",
                ], 400);
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status'    => 'error',
                'msg'       => "Something Went Wrong",
                'error_details' => $e->getMessage(),
            ], 400);
        }
    }

    public function user_info($id)
    {
        $login_user = JWTAuth::user();
        
        if($login_user->id == $id) {
            print("own profile \n");
            $user = User::with(['reviews.fromUesr:id,name','reviews.Product.ImagePath','products','products.user','products.category','products.sub_category','products.photo','products.wishlist'])->find($id);
        } else {
            print("other user \n");
            $user = User::with([
                'reviews.fromUser:id,name',
                'reviews.product.imagePath',
                'products' => function($query) {
                    $query->where(function($q) {
                        // Conditions to include featured products
                        $q->where('fix_price', '!=', null)
                          ->where('status', '1')
                          ->where('is_archived', false)
                          ->where('is_sold', false);
                    })
                    ->orWhere(function($q) {
                        // Conditions to include auction products whose end time is still in the future
                        $q->whereNotNull('auction_price')
                          ->where('status', '1')
                          ->where('is_archived', false)
                          ->where('is_sold', false)
                        //   ->where('ending_time', '>', now());
                          ->whereRaw("CONCAT(ending_date, ' ', ending_time) >= ?", [Carbon::now()]);
                    });
                },
                'products.user',
                'products.category',
                'products.sub_category',
                'products.photo',
                'products.wishlist'
            ])->find($id);
        }
        
        // $user = User::with(['reviews.fromUesr:id,name','reviews.Product.ImagePath','products','products.user','products.category','products.sub_category','products.photo','products.wishlist'])->find($id);
        return $this->sendResponse($user,'User Retrived Successfully.');
    }

    public function update_user_name(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }
        $user_id = JWTAuth::user()->id;

        $user = User::find($user_id);
        $user->name = $request->name;
        $user->save();
        return $this->sendResponse($user,'User Retrived Successfully.');
    }

    public function update_phone_number(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }
        $user_id = JWTAuth::user()->id;

        $user = User::find($user_id);
        $user->phone = $request->phone;
        $user->save();
        return $this->sendResponse($user,'User Retrived Successfully.');
    }

    public function update_email(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }
        $user_id = JWTAuth::user()->id;

        $user = User::find($user_id);
        $user->email = $request->email;
        $user->save();
        return $this->sendResponse($user,'User Retrived Successfully.');
    }

    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'old_password' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }
        $user_id = JWTAuth::user()->id;
        $user = User::find($user_id);
        
        if($user->social_login == 1 ) {
            return response()->json([
                'status' => 'error',
                'msg' => "You can't update your password, as you are loggedIn using Social Account!",
            ], 403);
        }

        $credentials['email']    = $user->email;
        $credentials['password']    = $request->old_password;

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Old Password Does not Matched!'], 401);
        }else{
            $user->password = Hash::make($request->password);
            $user->save();
            return $this->sendResponse($user,'User Password Changed Successfully.');
        }
    }

    public function update_location(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'location' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }
        $user_id = JWTAuth::user()->id;

        $user = User::find($user_id);
        $user->location = $request->location;
        $user->save();
        return $this->sendResponse($user,'User Retrived Successfully.');
    }

    public function update_custom_link(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'custom_link' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }
        $user_id = JWTAuth::user()->id;

        $user = User::find($user_id);
        $user->custom_link = $request->custom_link;
        $user->save();
        return $this->sendResponse($user,'User Retrived Successfully.');
    }

    public function get_all_users()
    {
        $offset = request()->query('offset');
        if($offset){
            $users = User::where('status',1)->paginate($offset);
        }else{
            $users = User::where('status',1)->paginate(10);
        }
        return $this->sendResponse($users,'Users Retrived Successfully.');
    }

    public function update_user(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }

        $id = $request->user_id;
        $data = $request->all();
        // $data = $request->only('name','provider','provider_id','provider_token','phone','status','email','username','password','src');
        // $data = $request->except('img','src','user_id','email','username','code','email_verified_at','phone_verified_at','');

        if($request->has('email')){
            $validate = Validator::make($request->all(),[
                'email' => 'required|unique:users,email',
            ]);
            if ($validate->fails()) {
                return $this->sendError($validate->errors(),[],401);
            }else{
                $data['email_verified_at'] = null;
            }
        }

        if ($request->has('username')) {
            $validate = Validator::make($request->all(),[
                'username' => 'required|unique:users,username',
            ]);
            if ($validate->fails()) {
                return $this->sendError($validate->errors(),[],401);
            }
        }

        if(isset($request->phone)){
            $data['phone_verified_at'] = null;
        }

        if(isset($request->password)){
            $validate = Validator::make($request->all(),[
                'password' => 'required|min:3',
            ]);
            if ($validate->fails()) {
                return $this->sendError($validate->errors(),[],401);
            }else{
                $data['password'] = Hash::make($request->password);
            }
        }

        if($request->hasfile('img')){
            $image = $request->file('img');
            $extension =  $image->getClientOriginalExtension();
            $filename = Str::random(9) . '-' . Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/profile_imgs'), $filename);
            $data['img'] = env('APP_URL')."storage/profile_imgs/{$filename}";
        }
        
        
        if(isset($request->show_contact)){
            $data['show_contact'] = $request->show_contact;
        }

        // if($request->hasfile('src')){
        //     $image = $request->file('src');
        //     $extension =  $image->getClientOriginalExtension();
        //     $filename = Str::random(9) . '-' . Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('storage/profile_src'), $filename);
        //     $data['src'] = env('APP_URL')."storage/profile_src/{$filename}";
        // }

        $user = User::find($id)->update($data);
        if($user){
            $updated_user = User::find($id);
            return $this->sendResponse($updated_user,'User Updated Successfully.');
        }else{
            return $this->sendError('User Not Updated',[],401);
        }
    }

    public function selling_screen(){
        $id = JWTAuth::user()->id;

        $selling = Product::with(['user','category','sub_category','photo','video','wishlist'])->where('user_id',$id)->where('is_sold',0)->where('status',1)->get();
        $archive = Product::with(['user','category','sub_category','photo','video','wishlist'])->where('user_id',$id)->where('is_archived',true)->get();
        // $history = Product::with(['user','category','sub_category','photo','video','wishlist'])->where('sold_to_user_id',$id)->get();
        
        // $history = Product::with(['user','category','sub_category','photo','video','wishlist'])->where('is_sold',1)->where('user_id',$id)->orwhere('sold_to_user_id',$id)->get();
        $history = Product::with(['user', 'category', 'sub_category', 'photo', 'video', 'wishlist'])
                            ->where(function ($query) use ($id) {
                                $query->where('is_sold', 1)
                                    ->where(function ($subQuery) use ($id) {
                                        $subQuery->where('user_id', $id)
                                            ->orWhere('sold_to_user_id', $id);
                                    });
                            })
                            ->get();
                            
        // $purchase = Product::with(['user','category','sub_category','photo','video','wishlist', 'auction'])
        //                     ->join('chats','chats.product_id','product.id')
        //                     ->where('chats.buyer_id',$id)
        //                     ->select('product.*')
        //                     ->distinct()
        //                     ->get();
        
        $productsWithChats = Product::with(['user', 'category', 'sub_category', 'photo', 'video', 'wishlist', 'auction'])
            ->join('chats', 'chats.product_id', 'product.id')
            ->where('chats.buyer_id', $id)
            ->where('is_sold', 0)
            ->select('product.*');
        
        $productsWithAuctions = Product::with(['user', 'category', 'sub_category', 'photo', 'video', 'wishlist', 'auction'])
            ->join('auctions', 'auctions.product_id', 'product.id')
            ->where('auctions.user_id', $id)
            ->where('is_sold', 0)
            ->select('product.*');
        $purchases_new = $productsWithChats->union($productsWithAuctions)->get();
        
        // $purchases_new = Product::with(['user', 'category', 'sub_category', 'photo', 'video', 'wishlist', 'auction'])
        //     ->leftJoin('chats', 'chats.product_id', 'product.id')
        //     ->leftJoin('auctions', 'auctions.product_id', 'product.id')
        //     ->where(function ($query) use ($id) {
        //         $query->where('chats.buyer_id', $id)
        //             ->orWhere('auctions.user_id', $id);
        //     })
        //     ->select('product.*')
        //     ->get();

        // $placed_bids = Auction::where('user_id', $id)->groupBy('product_id')->get();

        $data = [
            // 'total_buying' => count($purchase),
            // 'total_selling' => count($selling),
            // 'placed_bids' => count($placed_bids),
            // 'purchases_new' => $purchases_new,
            // 'user' => [JWTAuth::user()->id, JWTAuth::user()->name],
            'selling' =>$selling, 
            'purchase' => $purchases_new,
            // 'purchase' => $purchase,
            'history' =>$history, 
            'archive' => $archive];
        return $this->sendResponse($data,'User Retrived Successfully.');
    }

    public function user_review(Request $request){
        $validator = Validator::make($request->all(), [
            'to_user' => 'required|exists:users,id',
            'from_user' => 'required|exists:users,id',
            'product_id' => 'required|exists:product,id',
            'rating' => 'required|max:5|min:0',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }
        $data = $request->all();
        $review = Review::create($data);
        return $this->sendResponse($review,'Review Added Successfully.');
    }

    public function report_user(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }

        $report = ReportUsers::create([
            'reporter_user_id' => JWTAuth::user()->id,
            'reported_user_id' => $request->user_id,
        ]);
        return $this->sendResponse($report,'User Reported Successfully.');
    }

    public function list_reported_user(){
        $report = ReportUsers::with(['reporter','reported'])->get();
        return $this->sendResponse($report,'Reported Users Retrived Successfully.');
    }

    public function list_one_reported_user($id){
        $report = ReportUsers::with(['reporter','reported'])->where('reported_user_id',$id)->get();
        return $this->sendResponse($report,'User all reports Retrived Successfully.');
    }

    public function block_user(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }

        $report = BlockedUsers::create([
            'blocker_user_id' => JWTAuth::user()->id,
            'blocked_user_id' => $request->user_id,
        ]);
        return $this->sendResponse($report,'User Reported Successfully.');
    }

    public function unblock_user(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }

        $report = BlockedUsers::where('blocker_user_id',JWTAuth::user()->id)->where('blocked_user_id', $request->user_id)->delete();
        return $this->sendResponse($report,'User Unblocked Successfully.');
    }

    public function list_blocked_user(){
        $block = BlockedUsers::with(['blocker','blocked'])->get();
        return $this->sendResponse($block,'Blocked Users Retrived Successfully.');
    }

    public function verify_email(Request $request)
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
            $code = rand(100000, 999999);
            $data->email_code = $code;
            $data->save();
            $mailData = [
                'title' => 'Email Verification Code',
                'body' => $code,
            ];
            // $htmlContent = View::make('emails.simple')->render();
            // Mail::raw($htmlContent, function ($message) use ($recipient) {
            //     $message->from('noreply@example.com', 'Your Company Name');
            //     $message->to($data->email)->subject('Simple Email from Laravel');
            // });
            Mail::to($data->email)->send(new VerifyEmail($mailData));
              return response()->json([
                  'status' => 'success',
                'msg' => 'We have sent an Email Verification otp code to your email',
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

    public function verify_email_otp(Request $request)
    {
        $validator_a = Validator::make($request->all(), [
            'otp' => 'required',
            'user_id' => 'required',
        ]);
        if ($validator_a->fails()) {
            return response()->json([
                  'status' => 'error',
                  'msg' => $validator_a->errors(),
            ], 401);
        }

        $user = User::find($request->user_id);
        if($user)
        {
            if($user->email_code == $request->otp)
            {
                $user->email_verified_at = date('Y-m-d H:i:s');
                $user->save();
                return response()->json([
                    'status' => 'success',
                    'msg' => 'Email Verified Successfully.',
                ], 200);
            }else{
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Invalid Code.',
                ], 401);
            }
        }else{
            return response()->json([
                'status' => 'error',
                'msg' => 'User Does not exist.',
            ], 401);
        }
    }

    public function get_all_users_reports()
    {

    }

    public function who_bought(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }
        $user_id = $request->user_id;
        
        $buyers = DB::table('chats')->join('users','users.id','chats.sender_id')
        ->where('chats.receiver_id',$user_id)
        ->select('users.name','users.img')
        ->groupby('chats.conversation_id')
        ->get();

        return $this->sendResponse($buyers,'Buyers Data Retreived Successfully.');
        
    }

}

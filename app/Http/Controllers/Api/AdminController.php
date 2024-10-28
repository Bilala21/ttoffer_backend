<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Chat;
use App\Models\Report;
use App\Models\Banner;
use Illuminate\Support\Str;
use App\Mail\Password;
use Hash;
use Mail;

class AdminController extends Controller
{
    public function get_users()
    {
        $offset = request()->query('offset');
        if($offset){
            $users = DB::table('users')->paginate($offset);
        }else{
            $users = DB::table('users')->paginate(10);
        }
        if($users){
            return response()->json([
                'status' => 'success',
                'data' => $users,
                'message' => 'Users Retreived successfully.',
            ],200);
        }else{
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function today_registration()
    {
        $today = date('Y-m-d');
        $users = DB::table('users')->whereRaw('DATE(created_at) = ?', [$today])->paginate(10);
        if($users){
            return response()->json([ 
                'status' => 'success',
                'data' => $users,
                'message' => 'Today Registered Users Retreived successfully.',
            ],200);
        }else{
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function verified_users()
    {
        $offset = request()->query('offset');
        if($offset){
            $users = DB::table('users')->where('status',1)->paginate($offset);
        }else{
            $users = DB::table('users')->where('status',1)->paginate(10);
        }
        if($users){
            return response()->json([ 
                'status' => 'success',
                'data' => $users,
                'message' => 'Verified Users Retreived successfully.',
            ],200);
        }else{
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function get_users_search()
    {
        $offset = request()->query('offset');
        $search = request()->query('search');
        // $query = DB::table('users');
        // if($search)
        // {
        //     $query->where('name','LIKE',"%{$search}%")
        //     ->orwhere('email','LIKE',"%{$search}%")
        //     ->orWhere('id','LIKE',"%{$search}%");
        // }
        // if($offset){
        //     $users = $query->paginate($offset);
        // }else{
        //     $users = $query->paginate(10);
        // }
        if($search)
        {
            if($offset){
                $users = DB::table('users')->where('id',$search)->paginate($offset);
            }else{
                $users = DB::table('users')->where('id',$search)->paginate(10);
            }
            if($users->isEmpty()){
                if($offset){
                    $users = DB::table('users')->where('name',$search)->paginate($offset);
                }else{
                    $users = DB::table('users')->where('name',$search)->paginate(10);
                }
            }
            if($users->isEmpty()){
                if($offset){
                    $users = DB::table('users')->where('email',$search)->paginate($offset);
                }else{
                    $users = DB::table('users')->where('email',$search)->paginate(10);
                }
            }
            if($users->isEmpty()){
                if($offset){
                    $users = DB::table('users')
                    ->where('name','LIKE',"%{$search}%")
                    ->orwhere('email','LIKE',"%{$search}%")
                    ->orWhere('id','LIKE',"%{$search}%")->paginate($offset);
                }else{
                    $users = DB::table('users')
                    ->where('name','LIKE',"%{$search}%")
                    ->orwhere('email','LIKE',"%{$search}%")
                    ->orWhere('id','LIKE',"%{$search}%")->paginate(10);
                }
            }

        }
        if($users){
            return response()->json([ 
                'status' => 'success',
                'data' => $users,
                'message' => 'Verified Users Retreived successfully.',
            ],200);
        }else{
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function ads_verification()
    {
        $products = Product::with(['user', 'category', 'sub_category', 'photo', 'video', 'auction', 'wishlist'])->where('status',0)->paginate(10);
        if($products){
            return response()->json([ 
                'status' => 'success',
                'data' => $products,
                'message' => 'Ads Verification Retreived successfully.',
            ],200);
        }else{
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function get_reports()
    {
        $offset = request()->query('offset');
        if($offset){
            $reports = Report::with(['user','product'])->paginate($offset);
        }else{
            $reports = Report::with(['user','product'])->paginate(10);
        }
        if($reports){
            return response()->json([ 
                'status' => 'success',
                'data' => $reports,
                'message' => 'Reports Retreived successfully.',
            ],200);
        }else{
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function add_product_report(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
            'user_id' => 'required|exists:users,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator->errors(),
            ], 401);
        }
        $check_report = Report::where('product_id',$request->product_id)->where('user_id',$request->user_id)->first();
        if(!$check_report){
            $data = $request->all();
            if(!isset($request->status)){
                $data['status'] = 0;
            }
            $report = Report::create($data);
            if($report){
                return response()->json([ 
                    'status' => 'success',
                    'data' => $report,
                    'message' => 'Product Reported successfully.',
                ],200);
            }else{
                return response()->json(['error' => 'Something went wrong'], 500);
            }
        }else{
            return response()->json(['error' => 'Report Already Exist from this User for this Product'], 500);
        }
    }

    public function delete_product_report(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'report_id' => 'required|exists:report,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator->errors(),
            ], 401);
        }

        $del = Report::find($request->report_id)->delete();
        return response()->json([ 
            'status' => 'success',
            'data' => $del,
            'message' => 'Product Report Deleted successfully.',
        ],200);
    }

    public function change_product_report_status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'report_id' => 'required|exists:report,id',
            'status' => 'required||in:1,0,2',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator->errors(),
            ], 401);
        }

        $update = Report::find($request->report_id)->update(['status'=>$request->status]);
        return response()->json([ 
            'status' => 'success',
            'data' => $update,
            'message' => 'Product Report Status Updated successfully.',
        ],200);
    }

    public function search_product_report(Request $request)
    {
        $offset = request()->query('offset');
        $query = Report::with(['user','product']);

        if(isset($request->search)){
            $search = $request->search;
            $query->whereAny(
                [
                    'id',
                    'product_id',
                    'user_id',
                    'subject',
                    'note',
                    'created_at',
                ],
                'LIKE',
                "%$search%"
            );

            if($search == 'Active' || $search == 'active'){
                $query->orwhere('status',1);
            }
            if($search == 'Inactive' || $search == 'inactive'){
                $query->orwhere('status',0);
            }
        }else{
            if(isset($request->report_id)){
                $query->where('id',$request->report_id);
            }

            if(isset($request->user_id)){
                $query->where('user_id',$request->user_id);
            }

            if(isset($request->product_id)){
                $query->where('product_id',$request->product_id);
            }

            if(isset($request->suject)){
                $query->where('subject',$request->subject);
            }

            if(isset($request->note)){
                $query->where('note',$request->note);
            }

            if(isset($request->status)){
                $query->where('status',$request->status);
            }

            if(isset($request->created_at)){
                $query->where('created_at',$request->created_at);
            }
        }

        if($offset){
            $reports = $query->paginate($offset);
        }else{
            $reports = $query->paginate(10);
        }


        return response()->json([ 
            'status' => 'success',
            'data' => $reports,
            'message' => 'Searched Reports Retreived successfully.',
        ],200);
    }

    public function latest_messages()
    {
        $latest_messages = Chat::with(['sender','receiver','product','offer','buyer','seller'])->groupby('conversation_id')->orderby('created_at','desc')->paginate(5);
        if($latest_messages){
            return response()->json([ 
                'status' => 'success',
                'data' => $latest_messages,
                'message' => 'Latest Top 5 Messages Retreived successfully.',
            ],200);
        }else{
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function delete_users()
    {
        $user_ids = request()->query('user_ids');
        if(isset($user_ids)){
            $user_ids = explode(',',$user_ids);
            $users = DB::table('users')->whereIn('id',$user_ids)->delete();
            return response()->json([ 
                'status' => 'success',
                'data' => $users,
                'message' => 'Users Deleted successfully.',
            ],200);
        }else{
            return response()->json(['error' => 'You Have not paased user_ids or user_ids are not in an array'], 500);
        }
    }

    public function get_ads()
    {
        $offset = request()->query('offset');
        if($offset){
            $products = Product::with(['user', 'category', 'sub_category', 'photo', 'video', 'auction', 'wishlist'])->paginate($offset);
        }else{
            $products = Product::with(['user', 'category', 'sub_category', 'photo', 'video', 'auction', 'wishlist'])->paginate(10);
        }
        if($products){
            return response()->json([ 
                'status' => 'success',
                'data' => $products,
                'message' => 'All Ads Retreived successfully.',
            ],200);
        }else{
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function get_ads_search(Request $request)
    {
        $offset = request()->query('offset');
        $search = request()->query('search');

        $query = Product::with(['user', 'category', 'sub_category', 'photo', 'video', 'auction', 'wishlist'])
        ->join('categories','categories.id','category_id');

        if($search){

            $query->whereAny(
                [
                    'product.id',
                    'product.title',
                    'product.user_id',
                    'product.created_at',
                    'categories.name',
                ],
                'LIKE',
                "%$search%"
            );

            if($search == 'Active' || $search == 'active'){
                $query->orwhere('product.status',1);
            }

            if($search == 'Inactive' || $search == 'inactive'){
                $query->orwhere('product.status',0);
            }

            // $query->where('id', 'LIKE', "%{$request->search}%");
            // $query->where('category_id', 'LIKE', "%{$request->search}%");
            // $query->where('sub_category_id', 'LIKE', "%{$request->search}%");
            // $query->where('title', 'LIKE', "%{$request->search}%");
            // $query->where('location', 'LIKE', "%{$request->search}%");
            // $query->where('is_urgert', 'LIKE', "%{$request->search}%");
            // $query->where('fix_price', 'LIKE', "%{$request->search}%");
        }

        if($offset){
            $products = $query->select('product.*','categories.name as category_name')->paginate($offset);
        }else{
            $products = $query->select('product.*','categories.name as category_name')->paginate(10);
        }

        if($products){
            return response()->json([ 
                'status' => 'success',
                'data' => $products,
                'message' => 'All Ads Searched Retreived successfully.',
            ],200);
        }else{
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function add_member(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            // 'phone' => 'required|min:8',
            'user_type' => 'required|in:admin,sub_admin,manager,team_member',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator->errors(),
            ], 401);
        }

        $pass = Str::password();

        $is_true_you = 0;
        if(isset($request->is_true_you)){
            $is_true_you = $request->is_true_you;
        }
        $user = User::create([
            'name' => $request->name,
            'username' => $request->name."_".uniqid(),
            'user_type' => $request->user_type,
            // 'phone' => $request->phone,
            'email' => $request->email,
            'status' => 1,
            'provider' => 'site',
            'src' => 'app',
            'is_true_you' => $is_true_you,
            'password' => Hash::make($pass),
        ]);
        if($user){
            $mailData['title'] = "Credentials";
            $mailData['email'] = $request->email;
            $mailData['password'] = $pass;
            $mailData['role'] = $request->user_type;
            Mail::to($request->email)->send(new Password($mailData));
            return response()->json([
                'status' => 'success',
                'data' => $user,
                'message' => 'Account registered successfully.',
            ],200);
        }else{
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function get_all_members()
    {
        $members = User::where('user_type','sub_admin')->get();
        return response()->json([
            'status' => 'success',
            'data' => $members,
            'message' => 'Team Members Retreived successfully.',
        ],200);
    }

    public function get_users_daterange(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator->errors(),
            ], 401);
        }

        $start_date = date('Y-m-d H:i:s',strtotime($request->start_date));
        $end_date = date('Y-m-d H:i:s',strtotime($request->end_date.' 23:59:59'));
        $perPage = 10;
        $page = 1;

        if(isset($request->per_page)){
            $perPage = $request->per_page;
        }

        if(isset($request->page)){
            $page = $request->page;
        }

        $users = User::whereBetween('created_at', [$start_date, $end_date])->paginate($perPage, ['*'], 'page', $page);
        return response()->json([
            'status' => 'success',
            'data' => $users,
            'message' => 'Users Retreived successfully.',
        ],200);
    }

    public function get_boosting_products(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default to 10 results per page if not provided
        $page = $request->input('page', 1); // Default to page 1 if not provided
        $id = $request->input('id'); // Default to page 1 if not provided

        if($id){
            $prods = Product::with(['user','category','sub_category','photo','video','wishlist'])
            ->where('id',$id)
            ->where('booster_start_datetime','<=',date('Y-m-d H:i:s'))
            ->where('booster_end_datetime','>',date('Y-m-d H:i:s'))->paginate($perPage, ['*'], 'page', $page);
        }else{
            $prods = Product::with(['user','category','sub_category','photo','video','wishlist'])
            ->where('booster_start_datetime','<=',date('Y-m-d H:i:s'))
            ->where('booster_end_datetime','>',date('Y-m-d H:i:s'))->paginate($perPage, ['*'], 'page', $page);
        }

        return response()->json([
            'status' => 'success',
            'data' => $prods,
            'message' => 'currently boosting products retreived successfully.',
        ],200);
    }

    public function get_configs()
    {
        $configs = DB::table('config')->get();
        return response()->json([
            'status' => 'success',
            'data' => $configs,
            'message' => 'configs retreived successfully.',
        ],200);
    }
    
    public function update_configs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'config_id'  =>  'required|exists:config,id',
            'value'  =>  'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator->errors(),
            ], 401);
        }

        $configs = DB::table('config')->where('id',$request->config_id)->update([
            'value' =>  $request->value,
        ]);

        $configs = DB::table('config')->where('id',$request->config_id)->first();
        
        return response()->json([
            'status' => 'success',
            'data' => $configs,
            'message' => 'config updated successfully.',
        ],200);
    }

    public function get_banners()
    {
        $page_name = request()->input('page_name');
        $id = request()->input('id');
        if($id){
            $banners = Banner::where('id',$id)->where('status',1)->orderby('sequence','ASC')->first();
        }elseif(isset($page_name)){
            $banners = Banner::where('page_name',$page_name)->where('status',1)->orderby('sequence','ASC')->get();
        }else{
            $banners = Banner::where('status',1)->orderby('sequence','ASC')->get();
        }
        return response()->json([
            'status' => 'success',
            'data' => $banners,
            'message' => 'Banners Retreived successfully.',
        ],200);
    }

    public function add_banner(Request $request)
    {
        $validator = Validator::make($request->all(), [
   'images'    => 'required_without_all:html|array', 
        'images.*'  => 'file',
        'html'      => 'required_without_all:images',
        'sequence'  => 'required|in:0,1,2,3,4,5,6,7,8,9',
        'page_name' => 'required',
        ]);
        
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator->errors(),
            ], 401);
        }

        $data = $request->except('images');
        $data['status'] = 1;

        if(isset($request->start_datetime)){
            $data['start_datetime'] = date('Y-m-d H:i:s',strtotime($request->start_datetime));
        }

        if(isset($request->end_datetime)){
            $data['end_datetime'] = date('Y-m-d H:i:s',strtotime($request->end_datetime));
        }

        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $key => $value) {
                $image = $value;
                $imgName = Str::random(9) . '-' . Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('banners', $imgName, 'public');
                $data['img'] = env('APP_URL')."storage/banners/{$imgName}";
                $banner = Banner::create($data);
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $banner,
            'message' => 'Banner Inserted successfully.',
        ],200);
    }

    public function update_banner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'banner_id'  =>  'required|exists:banners,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator->errors(),
            ], 401);
        }

        $data = $request->except('banner_id','image');
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $imgName = Str::random(9) . '-' . Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('banners', $imgName, 'public');
            $data['img'] = env('APP_URL')."storage/banners/{$imgName}";
        }
        $banner = Banner::find($request->banner_id)->update($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Banner updated successfully.',
        ],200);
    }

    public function delete_banners()
    {
        $banner_ids = request()->query('banner_ids');
        if(isset($banner_ids)){
            $banner_ids = explode(',',$banner_ids);
            $banners = DB::table('banners')->whereIn('id',$banner_ids)->delete();
            return response()->json([ 
                'status' => 'success',
                'data' => $banners,
                'message' => 'Banners Deleted successfully.',
            ],200);
        }else{
            return response()->json(['error' => 'You Have not paased banner_ids or banner_ids are not in an array'], 500);
        }
    }
}

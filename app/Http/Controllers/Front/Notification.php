<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Notification as Nt;
use App\Http\Controllers\Front\Chat;
use JWTAuth;

class Notification extends Controller
{
    public function create(Request $request)
    {
        $validator_a = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'text' => 'required',
            'type' => 'required',
            'type_id' => 'required',
            'buyer_id' => 'required|exists:users,id',
            'seller_id' => 'required|exists:users,id',
        ]);
        if ($validator_a->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator_a->errors(),
            ], 401);
        }

        $data = $request->all();
        $data['from_user_id'] = JWTAuth::user()->id;
        $data['status'] = "unread";
        $noti = Nt::create($data);
        $e = new Chat();
        $e->firebase_notification($data['user_id'],$noti);
        return $this->sendResponse($noti,'Notification Created Successfully');
    }

    public function get_user_all_notifications($id)
    {
        
        $type = request('type');
        if($type){
            $notifications = Nt::with([
                'user:id,name,username,email,phone,show_contact,share_able_link,img,status,location,custom_link,is_true_you,deleted_at,total_review,review_percentage'
            ])
            ->where('user_id',$id)
            ->where('type',$type)->get();
            return $this->sendResponse($notifications,'All User Notifications Retreived Successfully.');
        }else{
            $notifications = Nt::with([
                'user:id,name,username,email,phone,show_contact,share_able_link,img,status,location,custom_link,is_true_you,deleted_at,total_review,review_percentage', 
                'Product.ImagePath'
            ])->where('user_id',$id)->get();
            // $notifications = Nt::with(['user:id,name,email,username,phone,total_review'])->where('user_id',$id)->get();
            return $this->sendResponse($notifications,'All User Notifications Retreived Successfully.');
        }
    }

    public function get_user_unread_notifications($id)
    {
        $type = request('type');
        if($type){
            $notifications = Nt::with(['user:id,name,username,email,phone,show_contact,share_able_link,img,status,location,custom_link,is_true_you,deleted_at,total_review,review_percentage'])->where('user_id',$id)->where('type',$type)->where('status','unread')->get();
            return $this->sendResponse($notifications,'All Unread User Notifications Retreived Successfully.');
        }else{
            $notifications = Nt::with(['user:id,name,username,email,phone,show_contact,share_able_link,img,status,location,custom_link,is_true_you,deleted_at,total_review,review_percentage'])->where('user_id',$id)->where('status','unread')->get();
            return $this->sendResponse($notifications,'All Unread User Notifications Retreived Successfully.');
        }
    }
    
    public function get_unread_notifications()
    {
        $offset = request()->query('offset');

        if($offset){
            $notifications = Nt::where('status','unread')->paginate($offset);
        }else{
            $notifications = Nt::where('status','unread')->paginate(10);
        }

        return $this->sendResponse($notifications,'All Unread Notifications Retreived Successfully.');
    }

    public function get_user_read_notifications($id)
    {
        $type = request('type');
        if($type){
            $notifications = Nt::with(['user'])->where('user_id',$id)->where('type',$type)->where('status','read')->get();
            return $this->sendResponse($notifications,'All Read User Notifications Retreived Successfully.');
        }else{
            $notifications = Nt::with(['user'])->where('user_id',$id)->where('status','read')->get();
            return $this->sendResponse($notifications,'All Read User Notifications Retreived Successfully.');
        }
    }

    public function change_notification_status($id)
    {
        $notification = Nt::find($id);
        $notification->status = 'read';
        $notification->save();
        return $this->sendResponse($notification, 'Notification Status Updated Successfully.');
    }

    public function delete_single_notification($id)
    {
        $notification = Nt::find($id)->delete();
        return $this->sendResponse($notification, 'Notification Deleted Successfully.');
    }

    public function delete_notifications(Request $request)
    {
        $ids = $request->ids;
        if($ids!=null){
            $notification = Nt::whereIn('id',$ids)->delete();
            return $this->sendResponse($notification, 'All selected Notifications Deleted Successfully.');
        }else{
            return $this->sendResponse($ids, 'You have not selected notifications to be deleted.');
        }
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Chat as Ch;
use App\Models\Notification;
use App\Models\User;
use App\Models\Product;
use JWTAuth;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\ServiceAccount;
use Illuminate\Support\Facades\Validator;
use App\Models\BlockedUsers;
use Kreait\Firebase\Messaging\CloudMessage;
use DB;

class Chat extends Controller
{
    public function firebase($id,$type,$data)
    {
        $app = "Chats";
        // Get a reference to the database
        $firebase = (new \Kreait\Firebase\Factory)
        ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
        ->withDatabaseUri(env('FIREBASE_DATABASE_URL'));
        // Get a reference to the "users" node
        $database = $firebase->createDatabase();
        $blogRef = $database->getReference($app);
        $data['date'] = date('m-d-Y');
        $data['time'] = date('h:i A');
        $blogRef->getChild($id)->getChild($type)->set($data);

        // $us = User::find($id);
        // $deviceToken = $us->device_token;
        // $messaging = $firebase->createMessaging();
        // $message = CloudMessage::withTarget('token', $deviceToken)
        // ->withNotification(['title' => 'Chat Message', 'body' => $data['message']])
        // ->withData([
        //     'id' => $id,
        //     'date' => $data['date'],
        //     'time' => $data['time'],
        //     'click_action' => 'FLUTTER_NOTIFICATION_CLICK'
        // ]);
        // $messaging->send($message);
    }

    public function firebase_notification($id,$data)
    {
        $app = "Notifications";
        // Get a reference to the database
        $firebase = (new \Kreait\Firebase\Factory)
        ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
        ->withDatabaseUri(env('FIREBASE_DATABASE_URL'));
        // Get a reference to the "users" node
        $database = $firebase->createDatabase();
        $blogRef = $database->getReference($app);
        $data['date'] = date('m-d-Y');
        $data['time'] = date('h:i A');
        $blogRef->getChild($id)->set($data);

        $us = User::find($id);
        $deviceToken = $us->device_token;
        if($deviceToken){
            $messaging = $firebase->createMessaging();
            $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification(['title' => $data['type'], 'body' => $data['text']])
            ->withData([
                'id' => $id,
                'date' => $data['date'],
                'time' => $data['time'],
                'type_id' => $data['type_id'],
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK'
            ]);
            $messaging->send($message);
        }
    }

    public function firebase_auction($id,$data)
    {
        $app = "Auction";
        // Get a reference to the database
        $firebase = (new \Kreait\Firebase\Factory)
        ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
        ->withDatabaseUri(env('FIREBASE_DATABASE_URL'));
        // Get a reference to the "users" node
        $database = $firebase->createDatabase();
        $blogRef = $database->getReference($app);
        $data['date'] = date('m-d-Y');
        $data['time'] = date('h:i A');
        $blogRef->getChild($id)->set($data);

        // $us = User::find($id);
        // $deviceToken = $us->device_token;
        // $messaging = $firebase->createMessaging();
        // $message = CloudMessage::withTarget('token', $deviceToken)
        // ->withNotification(['title' => $data['text'], 'body' => $data])
        // ->withData([
        //     'id' => $id,
        //     'date' => $data['date'],
        //     'time' => $data['time'],
        //     'click_action' => 'FLUTTER_NOTIFICATION_CLICK'
        // ]);
        // $messaging->send($message);
    }

    public function send_msg(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sender_id'     => 'required|exists:users,id',
            'receiver_id'   => 'required|exists:users,id',
            'buyer_id'   => 'required|exists:users,id',
            'seller_id'   => 'required|exists:users,id',
            'product_id'   => 'required|exists:product,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }

        $images = [];
        $docs = [];
        $text = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                print("saving files");
                $path = $image->store('public/images');
                $path = Storage::url($path);
                $filename = $image->getClientOriginalName();
                $input = [];
                $input['sender_id'] = $request->sender_id;
                $input['receiver_id'] = $request->receiver_id;
                $input['buyer_id'] = $request->buyer_id;
                $input['seller_id'] = $request->seller_id;
                $input['file'] = env('APP_URL').$path;
                $input['file_name'] = $filename;
                $input['file_type'] = "img";
                $input['status'] = "unread";
                $input['product_id'] = $request->product_id;
                $conversation = Ch::where('sender_id',$request->sender_id)->where('receiver_id',$request->receiver_id)->first();
                $conversation1 = Ch::where('receiver_id',$request->sender_id)->where('sender_id',$request->receiver_id)->first();
                if($conversation){
                    $input['conversation_id'] = $conversation->conversation_id;
                }elseif ($conversation1) {
                    $input['conversation_id'] = $conversation->conversation_id;
                }else{
                    $input['conversation_id'] = date('YmdHis');
                }
                $msg = Ch::Create($input);
                $this->firebase($request->receiver_id,$request->sender_id,$input);
                $images[] = $msg;
            }
        }

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $image) {
                $path = $image->store('public/documents');
                $path = Storage::url($path);
                $filename = $image->getClientOriginalName();
                $input = [];
                $input['sender_id'] = $request->sender_id;
                $input['receiver_id'] = $request->receiver_id;
                $input['buyer_id'] = $request->buyer_id;
                $input['seller_id'] = $request->seller_id;
                $input['file'] = env('APP_URL').$path;
                $input['file_name'] = $filename;
                $input['file_type'] = "doc";
                $input['status'] = "unread";
                $input['product_id'] = $request->product_id;
                $conversation = Ch::where('sender_id',$request->sender_id)->where('receiver_id',$request->receiver_id)->first();
                $conversation1 = Ch::where('receiver_id',$request->sender_id)->where('sender_id',$request->receiver_id)->first();
                if($conversation){
                    $input['conversation_id'] = $conversation->conversation_id;
                }elseif ($conversation1) {
                    $input['conversation_id'] = $conversation->conversation_id;
                }else{
                    $input['conversation_id'] = date('YmdHis');
                }
                $msg = Ch::Create($input);
                $this->firebase($request->receiver_id,$request->sender_id,$input);
                $docs[] = $msg;
            }
        }

        if($request->has('message')){
            $input = [];
            $input['sender_id'] = $request->sender_id;
            $input['receiver_id'] = $request->receiver_id;
            $input['buyer_id'] = $request->buyer_id;
            $input['seller_id'] = $request->seller_id;
            $input['message'] = $request->message;
            $input['status'] = "unread";
            $input['product_id'] = $request->product_id;
            $conversation = Ch::where('sender_id',$request->sender_id)->where('receiver_id',$request->receiver_id)->first();
            $conversation1 = Ch::where('receiver_id',$request->sender_id)->where('sender_id',$request->receiver_id)->first();
            if($conversation){
                $input['conversation_id'] = $conversation->conversation_id;
            }elseif ($conversation1) {
                $input['conversation_id'] = $conversation1->conversation_id;
            }else{
                $input['conversation_id'] = date('YmdHis');
            }
            $msg = Ch::Create($input);
            $this->firebase($request->receiver_id,$request->sender_id,$input);
            $text[] = $msg;
        }
        $data['Message'] = $text;
        $data['Documanets'] = $docs;
        $data['Images'] = $images;
        if($text!=[] || $docs!=[] || $images!=[]){
            $sender = User::find($request->sender_id);
            $convo  = Ch::where('sender_id',$request->sender_id)->where('receiver_id',$request->receiver_id)->first();
            
            // $noti_text = "You have got a new message from ".$sender->name;
            $noti_text = "You have a new message. Check it now.";
            $notification['user_id'] = $request->receiver_id;
            $notification['from_user_id'] = $request->sender_id;
            $notification['buyer_id'] = $request->buyer_id;
            $notification['seller_id'] = $request->seller_id;
            $notification['text'] = $noti_text;
            $notification['type'] = "conversation";
            $notification['type_id'] = $convo->conversation_id;
            $notification['product_id'] = $request->product_id;
            $notification['status'] = "unread";
            $notif = Notification::create($notification);
            $this->firebase_notification($request->receiver_id,$notif);
        }
        return $this->sendResponse($data,'Message Send Successfully.');
    }

    public function get_all_chats_of_user($id)
    {
        // $chats = Ch::where('sender_id',$id)->orwhere('receiver_id',$id)->groupby('conversation_id')->get();
        
        // old query
        // $buyer_chats = Ch::whereIn('id', function($query) use ($id) {
        //     $query->select(DB::raw('MAX(id)'))
        //           ->from('chats')
        //           ->where('buyer_id', $id)
        //           ->groupBy('conversation_id');
        // })
        // ->orderBy('created_at', 'desc')
        // ->get();
        
        // new query
        $buyer_chats = Ch::whereIn('id', function($query) use ($id) {
            $query->select(DB::raw('MAX(chats.id)'))
                  ->from('chats')
                  ->join('product', 'chats.product_id', '=', 'product.id') // Join with products table
                  ->join('photos', 'chats.product_id', '=', 'photos.product_id')
                  ->where('chats.buyer_id', $id)
                  ->where('product.is_sold', 0) // Only get chats where product is not sold
                  ->groupBy('chats.conversation_id');
        })
        ->with('ImagePath:id,product_id,src')
        ->orderBy('created_at', 'desc')
        ->get();

        foreach ($buyer_chats as $key => $chat) {
            $chat->sender = User::select(
                    'id',
                    'name',
                    'user_type',
                    'email',
                    'username',
                    'img',
                    'src',
                    'status',
                    'email_verified_at',
                    'phone_verified_at',
                    'image_verified_at',
                    'total_review',
                    'review_percentage',
                    'location'
                    )
                  ->find($chat->sender_id);
            $chat->receiver = User::select(
                    'id',
                    'name',
                    'user_type',
                    'email',
                    'username',
                    'img',
                    'src',
                    'status',
                    'email_verified_at',
                    'phone_verified_at',
                    'image_verified_at',
                    'total_review',
                    'review_percentage',
                    'location'
                    )
                    ->find($chat->receiver_id);
            if($id == $chat->sender->id){
                $chat->user_image = $chat->receiver->img;
            }else{
                $chat->user_image = $chat->sender->img;
            }
            $status = Ch::where('conversation_id',$chat->conversation_id)->where('status','unread')->count();
            $chat->unread_message_count = $status;
            $block = BlockedUsers::where('blocker_user_id',$chat->sender->id)->where('blocked_user_id',$chat->receiver->id)->first();
            if($block){
               $chat->block = 1;
            }else{
                $chat->block = 0;
            }
        }

        $seller_chats = Ch::whereIn('id', function($query) use ($id) {
            $query->select(DB::raw('MAX(id)'))
                  ->from('chats')
                  ->where('seller_id', $id)
                  ->groupBy('conversation_id');
        })
        ->with('ImagePath:id,product_id,src')
        ->orderBy('created_at', 'desc')
        ->get();

        foreach ($seller_chats as $key => $chat) {
            $chat->sender = User::find($chat->sender_id);
            $chat->receiver = User::find($chat->receiver_id);
            if($id == $chat->sender->id){
                $chat->user_image = $chat->receiver->img;
            }else{
                $chat->user_image = $chat->sender->img;
            }
            $status = Ch::where('conversation_id',$chat->conversation_id)->where('status','unread')->count();
            $chat->unread_message_count = $status;
            $block = BlockedUsers::where('blocker_user_id',$chat->sender->id)->where('blocked_user_id',$chat->receiver->id)->first();
            if($block){
               $chat->block = 1;
            }else{
                $chat->block = 0;
            }
        }
        $data['buyer_chats'] = $buyer_chats;
        $data['seller_chats'] = $seller_chats;
        return $this->sendResponse($data,'Retreived All Chats of user Successfully.');
    }

    public function get_conversation_id(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sender_id'     => 'required|exists:users,id',
            'receiver_id'   => 'required|exists:users,id',
            'product_id'   => 'required|exists:product,id'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }

        $chat = Ch::where('sender_id',$request->sender_id)->where('receiver_id',$request->receiver_id)->where('product_id', $request->product_id)->first();
        $chat1 = Ch::where('sender_id',$request->receiver_id)->where('receiver_id',$request->sender_id)->where('product_id', $request->product_id)->first();
        if($chat){
            $conversation_id = $chat->conversation_id;
        }elseif($chat1){
            $conversation_id = $chat->conversation_id;
        }else{
            $conversation_id = date('YmdHis');
            
            $product = Product::find($request->product_id);
            
            $input = [];
            $input['sender_id'] = $request->sender_id;
            $input['receiver_id'] = $request->receiver_id;
            $input['buyer_id'] = JWTAuth::user()->id;
            $input['seller_id'] = $product->user_id;
            $input['message'] = $request->message ?? "";
            $input['status'] = "unread";
            $input['product_id'] = $request->product_id;
            $input['conversation_id'] = $conversation_id;
            $msg = Ch::Create($input);
        }
        
        return $this->sendResponse($conversation_id,'Retreived Conversation of user Successfully.');
    }

    public function get_conversation($conversation_id)
    {
        // $status = Ch::where('conversation_id',$conversation_id)->where('receiver_id',auth()->user()->id)->update([
        //     'status' => "read" 
        // ]);
        $conversation = Ch::with(['product','offer','product.category','product.sub_category','product.photo','product.video','product.wishlist'])->where('conversation_id',$conversation_id)->get();
        if($conversation->count() > 0){
            $msg = Ch::with(['product','offer','product.category','product.sub_category','product.photo','product.video','product.wishlist'])->where('conversation_id',$conversation_id)->first();
            $user1 = User::find($msg->sender_id);
            $user2 = User::find($msg->receiver_id);
            $data['conversation'] = $conversation;
            $data['Participant1'] = $user1;
            $data['Participant2'] = $user2;
            return $this->sendResponse($data,'Retreived Conversation of user Successfully.');
        }else{
            return $this->sendResponse([],'Chat with this Conversation Id does not Exist.');
        }
    }
    
    public function mark_conversation_as_read($conversation_id)
    {
        $status = Ch::where('conversation_id',$conversation_id)->where('receiver_id',JWTAuth::user()->id)->update([
            'status' => "read" 
        ]);
        if($status){
            return $this->sendResponse([],'Conversation marked as read Successfully.');
        }else{
            $status = Ch::where('conversation_id',$conversation_id)->where('sender_id',JWTAuth::user()->id)->update([
                'status' => "read" 
            ]);
            if($status){
                return $this->sendResponse([],'Conversation marked as read Successfully.');
            }
            return $this->sendError("No Conversation Found or All the messages are already marked read of this conversation",[],200);
        }
    }

    public function delete_message($id)
    {
        $Message = Ch::find($id);
        $Message->delete();
        return $this->sendResponse($Message,'Message Deleted Successfully.');
    }

    public function delete_conversation($id)
    {
        $conversation = Ch::where('conversation_id',$id)->delete();
        return $this->sendResponse($conversation,'Conversation Deleted Successfully.');
    }

    public function delete_product_conversation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id'     => 'required|exists:chats,product_id',
            'conversation_id'   => 'required|exists:chats,conversation_id',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }
        $conversation = Ch::where('conversation_id',$request->conversation_id)
        ->where('product_id',$request->product_id)->delete();
        return $this->sendResponse($conversation,'Product Conversation Deleted Successfully.');
    }

    public function delete_product_all_conversation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id'     => 'required|exists:chats,product_id',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }
        
        $conversation = Ch::where('product_id', $request->product_id)->get();
        return $this->sendResponse($conversation,'Product All Conversations Deleted Successfully.');
    }

    public function search_conversation_msg()
    {
        $search = request()->query('search');
        if($search){
            $results = Ch::where('conversation_id','LIKE',"%{$search}%")
            ->orwhere('sender_id','LIKE',"%{$search}%")
            ->orwhere('receiver_id','LIKE',"%{$search}%")
            ->get();
            return $this->sendResponse($results,'Search results retreived Successfully.');
        }else{
            return $this->sendError("Search Parameter is not present",[],400);
        }
    }
}

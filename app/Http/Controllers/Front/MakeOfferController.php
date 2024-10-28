<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\MakeOffer;
use App\Models\User;
use App\Models\Product;
use App\Models\Chat as Ch;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Front\Chat;
use JWTAuth, DB;

class MakeOfferController extends Controller
{
    public function make_offer(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
            'seller_id' => 'required|exists:users,id',
            'buyer_id' => 'required|exists:users,id',
            'offer_price' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }
        
        $user = JWTAuth::user();
        $product = Product::find($request->product_id);
        if($user->id == $product->user_id) {
            return response()->json([
                'status' => 'error',
                'message' => "You can't Place bid again Your own product!",
            ], 400);
        }

        $offer = MakeOffer::create($request->all());
        $conversation = Ch::where('sender_id',$request->buyer_id)->where('receiver_id',$request->seller_id)->where('product_id',$request->product_id)->first();
        $conversation1 = Ch::where('receiver_id',$request->buyer_id)->where('sender_id',$request->seller_id)->where('product_id',$request->product_id)->first();
        if($conversation){
            $conversation_id = $conversation->conversation_id;
        }elseif ($conversation1) {
            $conversation_id = $conversation->conversation_id;
        }else{
            $conversation_id = date('YmdHis');
        }
        $sender = User::find($request->buyer_id);
        $receiver = User::find($request->seller_id);
        $prod = Product::find($request->product_id);

        $ch_input['sender_id'] = $sender->id;
        $ch_input['receiver_id'] = $receiver->id;
        $ch_input['buyer_id'] = $sender->id;
        $ch_input['seller_id'] = $receiver->id;
        $ch_input['message'] = $sender->name." made an offer ".$request->offer_price." for your listed product ".$prod->name;
        $ch_input['status'] = "sent";
        $ch_input['conversation_id'] = $conversation_id;
        $ch_input['offer_id'] = $offer->id;
        $ch_input['product_id'] = $request->product_id;
        $msg = Ch::Create($ch_input);
        
        // $noti_text = $sender->name." made an offer for your listed product.";
        $noti_text = "You have received a new offer! Review and respond now.";
        $notification['user_id'] = $receiver->id;
        $notification['text'] = $noti_text;
        $notification['type'] = "MakeOffer";
        // $notification['type_id'] = $offer->id;
        $notification['type_id'] = $conversation_id;
        $notification['product_id'] = $request->product_id;
        $notification['status'] = "unread";
        $notification['from_user_id'] = $sender->id;
        $notification['buyer_id'] = $request->buyer_id;
        $notification['seller_id'] = $request->seller_id;
        $notif = Notification::create($notification);

        $e = new Chat();
        $e->firebase($receiver->id,$sender->id,$ch_input);
        $e->firebase_notification($receiver->id,$notif);

        return $this->sendResponse($offer,"Offer Made placed Successfully");
    }

    public function get_user_offers(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }

        $offer = MakeOffer::with(['product','seller','buyer'])->where('buyer_id',$request->user_id)->where('status',1)->first();
        return $this->sendResponse($offer,"Offers Retreived Successfully");
    }
    
    public function get_offer(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:make_offers,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }

        $offer = MakeOffer::with(['product','seller','buyer'])->find($request->id);
        return $this->sendResponse($offer,"Offer Retreived Successfully");
    }

    public function accept_offer(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
            'seller_id' => 'required|exists:users,id',
            'buyer_id' => 'required|exists:users,id',
            'offer_id' => 'required|exists:make_offers,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }

        // $offer = MakeOffer::where('product_id',$request->product_id)
        //     ->where('seller_id',$request->seller_id)
        //     ->where('buyer_id',$request->buyer_id)
        //     ->first();
        $up_off = MakeOffer::find($request->offer_id)->update(['status'=>1]);
        $offer = MakeOffer::find($request->offer_id);
        
        $conversation = Ch::where('sender_id',$request->buyer_id)->where('receiver_id',$request->seller_id)->first();
        $conversation1 = Ch::where('receiver_id',$request->buyer_id)->where('sender_id',$request->seller_id)->first();
        if($conversation){
            $conversation_id = $conversation->conversation_id;
        }elseif ($conversation1) {
            $conversation_id = $conversation->conversation_id;
        }else{
            $conversation_id = date('YmdHis');
        }
        $sender = User::find($request->seller_id);
        $receiver = User::find($request->buyer_id);
        // $up_prod = Product::find($request->product_id)->update(["is_sold"=>"1","sold_to_user_id"=>$request->buyer_id]);
        $up_prod = Product::find($request->product_id)->update(["sold_to_user_id"=>$request->buyer_id]);
        $prod = Product::find($request->product_id);
        // $prod->is_sold = "1";
        // $prod->sold_to_user_id = $request->buyer_id;
        // $prod->save();

        $ch_input['sender_id'] = $sender->id;
        $ch_input['receiver_id'] = $receiver->id;
        $ch_input['buyer_id'] = $receiver->id;
        $ch_input['seller_id'] = $sender->id;
        $ch_input['message'] = $sender->name." accepted your offer for ".$prod->name;
        $ch_input['status'] = "sent";
        $ch_input['conversation_id'] = $conversation_id;
        $ch_input['offer_id'] = $request->offer_id;
        $ch_input['product_id'] = $request->product_id;
        $msg = Ch::Create($ch_input);
        
        $noti_text = "Your offer has been accepted.";
        $notification['user_id'] = $receiver->id;
        $notification['text'] = $noti_text;
        $notification['type'] = "conversation";
        $notification['type_id'] = $conversation_id;
        $notification['product_id'] = $request->product_id;
        $notification['status'] = "unread";
        $notif = Notification::create($notification);

        $e = new Chat();
        $e->firebase($receiver->id,$sender->id,$ch_input);
        $e->firebase_notification($receiver->id,$notif);

        return $this->sendResponse($offer,"Offer Accepted Successfully");
    }

    public function reject_offer(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
            'seller_id' => 'required|exists:users,id',
            'buyer_id' => 'required|exists:users,id',
            'offer_id' => 'required|exists:make_offers,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }

        $offer = MakeOffer::find($request->offer_id);
        $offer->status = 0;
        $offer->save();
        $conversation = Ch::where('sender_id',$request->buyer_id)->where('receiver_id',$request->seller_id)->first();
        $conversation1 = Ch::where('receiver_id',$request->buyer_id)->where('sender_id',$request->seller_id)->first();
        if($conversation){
            $conversation_id = $conversation->conversation_id;
        }elseif ($conversation1) {
            $conversation_id = $conversation->conversation_id;
        }else{
            $conversation_id = date('YmdHis');
        }
        $sender = User::find($request->seller_id);
        $receiver = User::find($request->buyer_id);
        $prod = Product::find($request->product_id);

        $ch_input['sender_id'] = $sender->id;
        $ch_input['receiver_id'] = $receiver->id;
        $ch_input['buyer_id'] = $receiver->id;
        $ch_input['seller_id'] = $sender->id;
        $ch_input['message'] = $sender->name." rejected your offer for ".$prod->name;
        $ch_input['status'] = "sent";
        $ch_input['conversation_id'] = $conversation_id;
        $ch_input['offer_id'] = $request->offer_id;
        $ch_input['product_id'] = $request->product_id;
        $msg = Ch::Create($ch_input);
        
        // $noti_text = $sender->name." rejected your Offer.";
        $noti_text = "Your offer has been rejected. Try to send a new offer. ";
        $notification['user_id'] = $receiver->id;
        $notification['text'] = $noti_text;
        $notification['type'] = "conversation";
        $notification['type_id'] = $conversation_id;
        $notification['product_id'] = $request->product_id;
        $notification['status'] = "unread";
        $notif = Notification::create($notification);

        $e = new Chat();
        $e->firebase($receiver->id,$sender->id,$ch_input);
        $e->firebase_notification($receiver->id,$notif);

        return $this->sendResponse($offer,"Offer Rejected Successfully");
    }
}

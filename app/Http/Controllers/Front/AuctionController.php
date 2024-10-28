<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Auction;
use App\Models\Notification;
use App\Models\User;
use App\Models\Product;
use App\Http\Controllers\Front\Chat;
use JWTAuth, DB;

class AuctionController extends Controller
{
    // 39760
    public function place_bid(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'product_id' => 'required|exists:product,id',
                'price' => 'required',
            ]);
    
            if ($validator->fails()) {
                return $this->sendError($validator->errors(),[],401);
            }
            
            DB::beginTransaction();
            $sender = JWTAuth::user();
            $lastBid = Auction::where('product_id' ,$request->product_id)->orderBy('id', 'desc')->first();
            $product = Product::find($request->product_id);
            if($sender->id == $product->user_id) {
                return response()->json([
                    'status' => 'error',
                    'message' => "You can't Place bid again Your own product!",
                ], 400);
            }

            if(!(isset($lastBid)) || ($lastBid->user_id != $request->user_id)) {
                $bid = Auction::create($request->all());
                $pro = Product::with('user')->find($request->product_id);
                $fp = 0;
                if($pro->final_price){
                    $fp = $pro->final_price;
                }
                
                // updating for optimiztion
                // $receiver_id = Product::find($request->product_id)->user_id;
                $receiver_id = $pro->user_id;
                
                // updating for optimiztion
                // $sender = User::find($request->user_id);
                
                
                // updating for optimiztion
                // $receiver = User::find($receiver_id);
                $receiver = $pro->user;
                
                $noti_text = $sender->name." placed a bid on your product.";
                if($fp && $request->price >= $fp){
                    $noti_text = $sender->name." placed a bid and it has reached your Final Price.";
                }
                $notification['user_id'] = $receiver_id;
                $notification['text'] = $noti_text;
                $notification['type'] = "auction";
                $notification['type_id'] = $bid->id;
                $notification['product_id'] = $request->product_id;
                $notification['status'] = "unread";
                $notification['from_user_id'] = $sender->id;
                $notification['buyer_id'] = $sender->id;
                $notification['seller_id'] = $receiver_id;
                $notif = Notification::create($notification);
        
                $e = new Chat();
                $e->firebase_notification($receiver_id,$notif);
                $e->firebase_auction($request->product_id,$bid);
                
                DB::commit();
                return $this->sendResponse($bid,"Bid placed Successfully");
            }
            else{
                return response()->json([
                    'status' => 'error',
                    'message' => "Your can't Place bid again untill someone else bid on this product!",
                ], 400);
            }
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'msg' => "Something Went Wrong, Please try again later.",
                'error' => $e->getMessage(),
                'error_details' => $e->getTrace()
            ], 400);
        }
    }

    public function get_placed_bids(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }

        $bid = Auction::with('user')->where('product_id',$request->product_id)->orderBy('price','desc')->get();
        return $this->sendResponse($bid,"Bids Retreived Successfully");
    }
    
    public function get_highest_bid(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }

        $bid = Auction::with('user:id,name,img,username', 'product')->where('product_id',$request->product_id)->orderBy('price','desc')->first();
        return $this->sendResponse($bid,"Highest Bid Retreived Successfully");
    }

    public function get_bid(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:auctions,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }

        $bid = Auction::with('user')->find($request->id);
        return $this->sendResponse($bid,"Bid Retreived Successfully");
    }
    
    public function get_all_placed_bid(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }
                        
        $bid = Auction::with('user:id,name,img')->where('product_id',$request->product_id)->orderBy('price','desc')->paginate(10);
        return $this->sendResponse($bid,"Bids Retreived Successfully");
    }
}

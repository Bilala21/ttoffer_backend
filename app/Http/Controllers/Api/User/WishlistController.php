<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $wishlist_products = Wishlist::with(['user','product','product.photo','product.video'])->wherehas('product')->where('user_id',$request->user_id)->get();
        return $this->sendResponse($wishlist_products,'Wishlist Products Retrived Successfully.');
    }

    public function store(Request $request)
    {
        $validator_a = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator_a->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator_a->errors(),
            ], 401);
        }

        if(WishList::where([["user_id", $request->user_id], ["product_id", $request->product_id]])->first() == null)
        {
            $wishlist_products = WishList::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
            ]);
            return $this->sendResponse($wishlist_products,'Wishlist Products Stored Successfully.');
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => "Product Already exist in wishlist."
                ], 409);
        }
    }
    public function destroy(Request $request)
    {
        $wishlist_products = Wishlist::find($request->id)->delete();
        return $this->sendResponse([],'Wishlist Products Deleted Successfully.');
    }
}

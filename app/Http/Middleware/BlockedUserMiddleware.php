<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JWTAuth;
use App\Models\User;
use App\Models\BlockedUsers;

class BlockedUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sender = JWTAuth::user();
        $receiver = User::find($request->receiver_id);
        $block = BlockedUsers::where('blocker_user_id',$sender->id)->where('blocked_user_id',$receiver->id)->first();
        $blocked = BlockedUsers::where('blocker_user_id',$receiver->id)->where('blocked_user_id',$sender->id)->first();
        if($block){
            $code = 401;
            $response = [
                'success' => false,
                'message' => "You have currently blocked this user. Hence cannot message.",
            ];

            return response()->json($response, $code);
        }elseif ($blocked) {
            $code = 401;
            $response = [
                'success' => false,
                'message' => "You are currently blocked by this user. Hence cannot message.",
            ];
            return response()->json($response, $code);
        }else{
            return $next($request);
        }
    }
}

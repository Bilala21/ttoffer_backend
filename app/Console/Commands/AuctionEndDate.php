<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Notification;
use App\Http\Controllers\Front\Chat;

class AuctionEndDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:auction-end-date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Cron Checks if auction of any product gets expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = Product::where('auction_price', '!=', null)
        ->where('status', '1')
        ->where('is_archived', 0)
        ->where('is_sold', 0)
        ->where('notify',0)
        ->where('ending_date','<=',date('Y-m-d'))
        ->where('ending_time','<',date('H:i'))
        ->get();

        foreach ($products as $key => $prod) {
            $notification['user_id'] = $prod->user_id;
            $notification['text'] = "Your auction time for product ".$prod->title." is expired.";
            $notification['type'] = "Auction Expire";
            $notification['type_id'] = $prod->id;
            $notification['product_id'] = $prod->id;
            $notification['status'] = "unread";
            $notification['from_user_id'] = $prod->user_id;
            $notif = Notification::create($notification);

            $e = new Chat();
            $e->firebase_notification($prod->user_id,$notif);

            $up_prod = Product::find($prod->id)->update(['notify'=>1]);
        }
    }
}

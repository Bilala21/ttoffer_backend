<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Chat;
use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use JWTAuth;
use App\Models\User;
use App\Models\Product;
use App\Models\MakeOffer;
use App\Models\Notification;
use App\Models\Photo;
use App\Models\Video;
use App\Models\Wishlist;
use App\Models\Report;
use App\Models\Chat as ChatModel;
use App\Models\Categories;
use App\Models\Sub_Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Products extends Controller
{
    public function first_step(Request $request)
    {
        $validator_a = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'description' => 'required',
            // 'video' => 'nullable|file|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4',
        ]);
        if ($validator_a->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator_a->errors(),
            ], 401);
        }


        // Generate slug from title
        $slug = Str::slug($request->title);
        $make_sure = Product::where('slug', $slug)->first();
        if ($make_sure) {
            $slug = $slug . '-' . Str::random(9);
        }

        $product = Product::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'status' => 0,
        ]);
        $product_id = $product->id;

        // Video
        if ($request->hasfile('video')) {
            foreach ($request->file('video') as $key => $value) {
                $video = $value;
                $videoName = Str::random(9) . '-' . Str::uuid() . time() . '.' . $video->getClientOriginalExtension();
                $video->storeAs('ads_videos', $videoName, 'public');
                Video::create([
                    'product_id' => $product->id,
                    'src' => env('APP_URL')."storage/ads_videos/{$videoName}",
                ]);
            }

        }

        return response()->json([
            'status' => 'success',
            'msg' => 'Product details added successfully!',
            'product_id' => $product_id,
        ], 200);

    }
    // Second Step
    public function second_step(Request $request)
    {
        $validator_a = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
            'category_id' => 'required|exists:categories,id',
            'condition' => 'required',
        ]);
        if ($validator_a->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator_a->errors(),
            ], 401);
        }
        $product = Product::where('id', $request->product_id)->first();
        if ($product) {
            $product->category_id = $request->category_id;
            $product->condition = $request->condition;

            if ($request->has('sub_category_id')) {
                $sub_category_id = $request->sub_category_id;
                $make_sure = Sub_Category::where('id', $sub_category_id)->first();
                if ($make_sure) {
                    $product->sub_category_id = $sub_category_id;
                }
            }

            // if ($request->has('make_and_model')) {
            //     $product->make_and_model = $request->make_and_model;
            // }
            // if ($request->has('mileage')) {
            //     $product->mileage = $request->mileage;
            // }
            // if ($request->has('color')) {
            //     $product->color = $request->color;
            // }
            // if ($request->has('brand')) {
            //     $product->brand = $request->brand;
            // }
            // if ($request->has('model')) {
            //     $product->model = $request->model;
            // }
            // if ($request->has('edition')) {
            //     $product->edition = $request->edition;
            // }
            // if ($request->has('authenticity')) {
            //     $product->authenticity = $request->authenticity;
            // }

            $attr = $request->all();
            $product->attributes = json_encode($attr);

            $product->save();
            return response()->json([
                'status' => 'success',
                'msg' => 'Product details added successfully!',
                'product_id' => $request->product_id,
            ], 200);
        }
    }

    // Thrid Step
    public function third_step(Request $request)
    {
        $validator_a = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
        ]);
        if ($validator_a->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator_a->errors(),
            ], 401);
        }
        $product = Product::where('id', $request->product_id)->first();
        if ($product) {
            if ($request->has('fix_price')) {
                $product->fix_price = $request->fix_price;
                if ($request->has('firm_on_price')) {
                    $product->firm_on_price = 1;
                } else {
                    $product->firm_on_price = 0;
                }
                $product->save();
            } else if ($request->has('auction_price')) {
                $product->auction_price = $request->auction_price;
                $validator_b = Validator::make($request->all(), [
                    'starting_date' => 'required',
                    'starting_time' => 'required',
                    'ending_date' => 'required',
                    'ending_time' => 'required',
                    'final_price' => 'required',
                ]);
                if ($validator_b->fails()) {
                    return response()->json([
                        'status' => 'error',
                        'msg' => $validator_b->errors(),
                    ], 401);
                }
                $product->starting_date = $request->starting_date;
                $product->starting_time = $request->starting_time;
                $product->ending_date = $request->ending_date;
                $product->ending_time = $request->ending_time;
                $product->final_price = $request->final_price;
                $product->notify = 0;
                $product->save();
            } else if ($request->has('sell_to_us')) {
                $product->sell_to_us = 1;
                $product->save();
            }else{
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Some went wrong!',
                ], 401);
            }
            return response()->json([
                'status' => 'success',
                'msg' => 'Product details added successfully!',
                'product_id' => $request->product_id,
            ], 200);
        }
    }

    // Last Step
    public function last_step(Request $request)
    {
         $validator_a = Validator::make($request->all(), [
             'product_id' => 'required|exists:product,id',
             'location' => 'required',
         ]);
         if ($validator_a->fails()) {
             return response()->json([
                 'status' => 'error',
                 'msg' => $validator_a->errors(),
             ], 401);
         }
         $product = Product::where('id', $request->product_id)->first();
         if ($product) {
            $product->location = $request->location;
            $product->status = 1;
            $product->save();
            return response()->json([
                'status' => 'success',
                'msg' => 'Product is live now!',
                'product_id' => $request->product_id,
                'data' => $product
            ], 200);
         }
    }

    public function reschedule_auction(Request $request){
        $validator_b = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
            'starting_date' => 'required',
            'starting_time' => 'required',
            'ending_date' => 'required',
            'ending_time' => 'required',
        ]);
        if ($validator_b->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator_b->errors(),
            ], 401);
        }

        $data = $request->all();
        $data['notify'] = 0;
        $prod = Product::find($request->product_id)->update($data);
        return response()->json([
            'status' => 'success',
            'msg' => 'Product Rescheduled Successfully',
        ], 200);
    }

    public function update_product_status(Request $request)
    {
        $validator_b = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
            'status' => 'required|in:0,1',
        ]);

        if ($validator_b->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator_b->errors(),
            ], 401);
        }

        $prod = Product::find($request->product_id)->update(['status'=>$request->status]);
        return response()->json([
            'status' => 'success',
            'msg' => 'Product Status Updated Successfully',
        ], 200);
    }

    public function edit_product_first_step(Request $request)
    {
        $validator_a = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:product,id',
            'title' => 'required',
            'description' => 'required',
        ]);
        if ($validator_a->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator_a->errors(),
            ], 401);
        }


        // Generate slug from title
        $slug = Str::slug($request->title);
        $make_sure = Product::where('slug', $slug)->first();
        if ($make_sure) {
            $slug = $slug . '-' . Str::random(9);
        }

        $product = Product::find($request->product_id);
        $product->title = $request->title;
        $product->slug = $slug;
        $product->description = $request->description;
        $product_id = $product->id;
        $product->save();
        // Video
        if ($request->hasfile('video')) {
            foreach ($request->file('video') as $key => $value) {
                $video = $value;
                $videoName = Str::random(9) . '-' . Str::uuid() . time() . '.' . $video->getClientOriginalExtension();
                $video->storeAs('ads_videos', $videoName, 'public');
                Video::create([
                    'product_id' => $product->id,
                    'src' => env('APP_URL')."storage/ads_videos/{$videoName}",
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'msg' => 'Product details added successfully!',
            'product_id' => $product_id,
        ], 200);
    }

    public function upload_image(Request $request)
    {
        $validator_a = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
            'src' => 'required',
        ]);
        if ($validator_a->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator_a->errors(),
            ], 401);
        }
        $product = Product::where('id', $request->product_id)->first();
        if ($product) {
            if ($request->hasfile('src')) {
                foreach ($request->file('src') as $key => $value) {
                    $image = $value;
                    $extension =  $image->getClientOriginalExtension();
                    $filename = Str::random(9) . '-' . Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('storage/ads_imgs'), $filename);
                    Photo::create([
                        'product_id' => $product->id,
                        'src' => env('APP_URL')."storage/ads_imgs/{$filename}",
                    ]);
                }
            }
            $product = Product::with('photo')->where('id', $request->product_id)->first();
            return response()->json([
                'status' => 'success',
                'msg' => 'Image added to product!',
                'product_id' => $request->product_id,
                'data' => $product
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'msg' => 'Product id not found!',
            ], 401);
        }
    }
    
    public function replace_images(Request $request)
    {
        try{
            $validator_a = Validator::make($request->all(), [
                'product_id' => 'required|exists:product,id',
                'src' => 'required',
            ]);
            if ($validator_a->fails()) {
                return response()->json([
                    'status' => 'error',
                    'msg' => $validator_a->errors(),
                ], 401);
            }
            $product = Product::with('photo')->where('id', $request->product_id)->first();
            if ($product) {
                if ($request->hasfile('src')) {
                    DB::beginTransaction();
                    
                    $oldImages = $product->photo;
                    foreach ($request->file('src') as $key => $value) {
                        $image = $value;
                        $extension =  $image->getClientOriginalExtension();
                        $filename = Str::random(9) . '-' . Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('storage/ads_imgs'), $filename);
                        

                        
                        Photo::create([
                            'product_id' => $product->id,
                            'src' => env('APP_URL')."storage/ads_imgs/{$filename}",
                        ]);
                    }
                    
                    foreach($oldImages as $old)
                    {
                        $filePath = str_replace("https://ttoffer.com/backend/public/storage/", "", $old->src);
                        if (Storage::disk('public')->exists($filePath)) {
                            Storage::disk('public')->delete($filePath);
                        }
                        Photo::where('id', $old->id)->delete();
                    }
                }
                else {
                    return response()->json([
                        'status' => 'error',
                        'msg' => 'No image not found!',
                    ], 401);
                }
                $product = Product::with('photo')->where('id', $request->product_id)->first();
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'msg' => 'Image added to product!',
                    'product_id' => $request->product_id,
                    'data' => $product
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Product id not found!',
                ], 401);
            }
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'msg' => "Something Went Wrong, Please try again later.",
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function featured_products(Request $request){
        // $query = Product::with(['user','category','sub_category','photo','video','wishlist' => function($query) {
        //     $query->where('user_id', JWTAuth::user()->id); // Replace $specificWishlistId with the ID you want to filter
        // },'offer'=>function($query){
        //     $query->with(['buyer']);
        // }])
        $query = Product::with(['user','category','sub_category','photo','video','wishlist','offer'=>function($query){
            $query->with(['buyer']);
        }])
        ->where('fix_price','!=',null)
        ->where('status','1')
        ->where('is_archived',false)
        ->where('is_sold',false)
        ->orderBy(DB::raw('CASE WHEN booster_end_datetime >= NOW() THEN 0 ELSE 1 END'));
        // ->orderByRaw('ISNULL(booster_start_datetime), booster_start_datetime ASC');

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('sub_category_id')) {
            $query->where('sub_category_id', $request->sub_category_id);
        }

        if ($request->filled('search')) {
            $query->where('title', 'LIKE', "%{$request->search}%");
        }

        if ($request->filled('limit')) {
            $query->limit($request->limit);
        }

        if ($request->filled('location')) {
            $query->where('location','LIKE',"%{$request->location}%");
        }
        if ($request->filled('sort_by')) {
            if(Str::lower($request->sort_by) == "newest on top"){
                $query->orderby('id','desc');
            }elseif(Str::lower($request->sort_by) == "newest on bottom"){
                $query->orderby('id','asc');
            }elseif(Str::lower($request->sort_by) == "lowest price on top"){
                $query->orderby('fix_price','asc');
            }elseif(Str::lower($request->sort_by) == "lowest price on bottom"){
                $query->orderby('fix_price','desc');
            }
        }
        if ($request->filled('is_urgert')) {
            $query->where('is_urgert',$request->is_urgert);
        }
        if ($request->filled('min_price')) {
            $query->where('fix_price','>=',$request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('fix_price','<=',$request->max_price);
        }

        $featured_products = $query->get();

        return $this->sendResponse($featured_products,'Featured Products Retrived Successfully.');
    }
    
    public function get_products(Request $request) 
    {
        try {
        
            $query = Product::
                with([
                    'user:id,name,img', 
                    // 'category:id,name,slug', 
                    // 'sub_category:id,category_id,name', 
                    'ImagePath:product_id,src', 
                    // 'video:id,product_id,src', 
                    // 'wishlist' => function ($query) {
                    //     $query->where('user_id', JWTAuth::user()->id);
                    // }, 
                    // 'offer' => function ($query) {
                    //     $query->with(['buyer']);
                    // }
                ])
            ->selectRaw(
                // Subquery to check if the product exists in the wishlist for the current user
                
                // Id done
                // Title done	
                // Price done
                // ImagePath done
                // Location done
                // Is_wishList done
                // IsOwnProduct done
                
                // ProductExpiry done
                // IsSold done

                
                // ProductType done
                // AttributeList
                // IsProductExpired
                
                // "id, user_id, title, attributes, mileage, color, brand, model, edition, authenticity, fix_price, starting_date, starting_time, ending_date, ending_time, location, status, created_at, updated_at, is_urgent, total_review, review_percentage, is_archived, is_sold as IsSold, 
                // (SELECT COUNT(*) FROM wishlists WHERE wishlists.product_id = product.id AND wishlists.user_id = ?) as is_wishList",
                // to be added , category_id, sub_category_id, auction_price
                "id as Id, user_id, title as Title, attributes, fix_price as Price, Location, status, is_archived, is_sold as IsSold, 
                (SELECT COUNT(*) FROM wishlists WHERE wishlists.product_id = product.id AND wishlists.user_id = ?) as Is_wishList",
                [JWTAuth::user()->id ?? 0]
            )
            ->selectRaw(
                // Add an is_owner flag by comparing the product's user_id with the logged-in user's ID
                "(CASE WHEN product.user_id = ? THEN 1 ELSE 0 END) as IsOwnProduct",
                [JWTAuth::user()->id ?? 0] // Pass the logged-in user's ID
            )
            ->selectRaw("CONCAT(ending_date, ' ', ending_time) AS ProductExpiry")
            ->where('status', '1')
            ->where('is_archived', false)
            ->where('is_sold', false)
            ->orderBy(DB::raw('CASE WHEN booster_end_datetime >= NOW() THEN 0 ELSE 1 END'));
    
            // Apply conditions based on the type
            if ($request->filled('type')) {
                if (Str::lower($request->type) == 'featured') {
                    $query->where('fix_price', '!=', null);
                } elseif (Str::lower($request->type) == 'auction') {
                    $query->where('auction_price', '!=', null);
                } else {
                    return $this->sendError('Invalid product type provided.');
                }
            }
    
    
            if ($request->filled('id')) {
                $query->where('id', $request->id);
            }
    
            if ($request->filled('category_id')) {
                $query->where('category_id', $request->category_id);
            }
    
            if ($request->filled('sub_category_id')) {
                $query->where('sub_category_id', $request->sub_category_id);
            }
    
            if ($request->filled('search')) {
                $query->where('title', 'LIKE', "%{$request->search}%");
            }
    
            if ($request->filled('location')) {
                $query->where('location', 'LIKE', "%{$request->location}%");
            }
    
            // Sorting logic
            if ($request->filled('sort_by')) {
                if (Str::lower($request->sort_by) == "newest on top") {
                    $query->orderby('id', 'desc');
                } elseif (Str::lower($request->sort_by) == "newest on bottom") {
                    $query->orderby('id', 'asc');
                } elseif (Str::lower($request->sort_by) == "lowest price on top") {
                    $query->orderby($request->type == 'auction' ? 'auction_price' : 'fix_price', 'asc');
                } elseif (Str::lower($request->sort_by) == "lowest price on bottom") {
                    $query->orderby($request->type == 'auction' ? 'auction_price' : 'fix_price', 'desc');
                }
            }
    
            // Apply filters for price range
            if ($request->filled('min_price')) {
                $query->where($request->type == 'auction' ? 'auction_price' : 'fix_price', '>=', $request->min_price);
            }
    
            if ($request->filled('max_price')) {
                $query->where($request->type == 'auction' ? 'auction_price' : 'fix_price', '<=', $request->max_price);
            }
    
            // Apply filter for urgency
            if ($request->filled('is_urgent')) {
                $query->where('is_urgent', $request->is_urgent);
            }
    
            // Fetch filtered products
            $products = $query->get();
            // $products = $query->paginate(10);
    
            // Return successful response with the products
            return response()->json($products);
            // return $this->sendResponse($products, ucfirst($request->type) . ' Products Retrieved Successfully.');
            
        } catch (\Exception $e) {
            return $this->sendError('Error fetching products: ' . $e->getMessage());
        }
    }
    
    // new api
    public function product_detail(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }

        $product = Product::with(['user','category','sub_category','photo','video','wishlist'])->where('id',$request->product_id)->first();
        return $this->sendResponse($product,'Product Details Retrived Successfully.');
    }

    public function auction_products(Request $request){
        // $query = Product::with(['user', 'category', 'sub_category', 'photo', 'video', 'auction', 'wishlist' => function($query) {
        //     $query->where('user_id', JWTAuth::user()->id);
        // },'offer'=>function($query){
        //     $query->with(['buyer']);
        // }])
        // return Carbon::now();
        $query = Product::with(['user', 'category', 'sub_category', 'photo', 'video', 'auction', 'wishlist','offer'=>function($query){
            $query->with(['buyer']);
        }])
        ->where('auction_price', '!=', null)
        ->where('status', '1')
        ->where('is_archived', false)
        ->where('is_sold', false)
        ->whereRaw("CONCAT(starting_date, ' ', starting_time) <= ?", [Carbon::now()])
        ->whereRaw("CONCAT(ending_date, ' ', ending_time) >= ?", [Carbon::now()])
        ->orderBy(DB::raw('CASE WHEN booster_end_datetime >= NOW() THEN 0 ELSE 1 END'));

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('sub_category_id')) {
            $query->where('sub_category_id', $request->sub_category_id);
        }

        if ($request->filled('search')) {
            $query->where('title', 'LIKE', "%{$request->search}%");
        }

        if ($request->filled('limit')) {
            $query->limit($request->limit);
        }

        if ($request->filled('location')) {
            $query->where('location', 'LIKE', "%{$request->location}%");
        }

        if ($request->filled('sort_by')) {
            if (Str::lower($request->sort_by) == "newest on top") {
                $query->orderby('id', 'desc');
            } elseif (Str::lower($request->sort_by) == "newest on bottom") {
                $query->orderby('id', 'asc');
            } elseif (Str::lower($request->sort_by) == "lowest price on top") {
                $query->orderby('auction_price', 'asc');
            } elseif (Str::lower($request->sort_by) == "lowest price on bottom") {
                $query->orderby('auction_price', 'desc');
            }
        }

        if ($request->filled('is_urgent')) {
            $query->where('is_urgent', $request->is_urgent);
        }

        if ($request->filled('min_price')) {
            $query->where('auction_price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('auction_price', '<=', $request->max_price);
        }

        // Add filters for category_name and sub_category_name
        if ($request->filled('category_name')) {
            $query->whereHas('category', function ($query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->category_name}%");
            });
        }

        if ($request->filled('sub_category_name')) {
            $query->whereHas('sub_category', function ($query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->sub_category_name}%");
            });
        }

        $auction_products = $query->get();


        return $this->sendResponse($auction_products,'Auction Products Retrived Successfully.');
    }

    public function product_review(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
            'review_quantity' => 'required|max:5|min:0',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }
        $product = Product::where('id', $request->product_id)->first();

        if ($product->review_percentage == 0) {
            $rating = $request->review_quantity;
        } else {
            $rating = ($request->review_quantity+$product->review_percentage)/2;
        }
        $product->review_percentage = $rating;
        $product->total_review++;
        $product->save();
        return $this->sendResponse($product,'Review Added Successfully.');
    }

    public function mark_product_sold($id){
        $product = Product::find($id);
        if(!$product) {
            return $this->sendError('Product not Found',[],401);
        }
        
        if($product->ending_date != null && $product->ending_time != null){
            $endingDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $product->ending_date . ' ' . $product->ending_time);
    
            if (Carbon::now()->lessThan($endingDateTime)){
                return $this->sendError("Can't mark product sold before auction time ends",[],400);
            }
        }

        $product->status = "0";
        $product->is_archived = false;
        $product->is_sold = true;
        $product->save();
        
        ChatModel::where('product_id', $id)->delete();

        $e = new Chat();
        $buyers = MakeOffer::where('product_id',$id)->get();
        
        // $noti_text = "Product ". $product->title ." is sold.";
        $noti_text = "Congratulations! Your item has been sold. Check it now.";
        $notification['text'] = $noti_text;
        $notification['type'] = "MarkAsSold";
        $notification['status'] = "unread";
        $notification['from_user_id'] = auth()->id();
        $notification['seller_id'] = auth()->id();
        $notification['product_id'] = $id;
        // $notif = Notification::create($notification);
        foreach ($buyers as $key => $buyer) {
            $notification['user_id'] = $buyer->buyer_id;
            $notification['buyer_id'] = $buyer->buyer_id;
            $notification['type_id'] = $buyer->id;
            $notif = Notification::create($notification);
            $e->firebase_notification($buyer->buyer_id,$notif);
        }
        

        return $this->sendResponse($product,'Congratulations! Your item has been sold. Check it now.');
    }

    public function mark_product_archive($id){
        $product = Product::find($id);
        if(!$product) {
            return $this->sendError('Product not Found',[],401);
        }

        $product->status = "0";
        $product->is_archived = true;
        $product->is_sold = false;
        $product->save();
        return $this->sendResponse($product,'Product Marked Archived Successfully.');
    }

    public function mark_product_unarchive($id){
        $product = Product::find($id);
        if(!$product) {
            return $this->sendError('Product not Found',[],401);
        }

        $product->status = "1";
        $product->is_archived = false;
        $product->is_sold = false;
        $product->save();
        return $this->sendResponse($product,'Product Unarchived Successfully.');
    }

    public function all_products(Request $request){
        // $query = Product::with(['user','category','sub_category','photo','video','wishlist' => function($query) {
        //     $query->where('user_id', JWTAuth::user()->id); // Replace $specificWishlistId with the ID you want to filter
        // },'offer'=>function($query){
        //     $query->with(['buyer']);
        // }])
        $query = Product::with(['user','category','sub_category','photo','video','wishlist','offer'=>function($query){
            $query->with(['buyer']);
        }])
        ->where('status','1')
        ->where('is_archived',false)
        ->where('is_sold',false)
        ->orderBy(DB::raw('CASE WHEN booster_end_datetime >= NOW() THEN 0 ELSE 1 END'));
        // ->orderByRaw('ISNULL(booster_start_datetime), booster_start_datetime ASC');


        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('sub_category_id')) {
            $query->where('sub_category_id', $request->sub_category_id);
        }

        if ($request->filled('search')) {
            $query->where('title', 'LIKE', "%{$request->search}%");
        }

        if ($request->filled('limit')) {
            $query->limit($request->limit);
        }

        if ($request->filled('location')) {
            $query->where('location','LIKE',"%{$request->location}%");
        }
        if ($request->filled('sort_by')) {
            if(Str::lower($request->sort_by) == "newest on top"){
                $query->orderby('id','desc');
            }elseif(Str::lower($request->sort_by) == "newest on bottom"){
                $query->orderby('id','asc');
            }elseif(Str::lower($request->sort_by) == "lowest price on top"){
                $query->orderby('fix_price','asc');
            }elseif(Str::lower($request->sort_by) == "lowest price on bottom"){
                $query->orderby('fix_price','desc');
            }
        }
        if ($request->filled('is_urgert')) {
            $query->where('is_urgert',$request->is_urgert);
        }
        if ($request->filled('min_price')) {
            $query->where('fix_price','>=',$request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('fix_price','<=',$request->max_price);
        }

        $featured_products = $query->get();

        return $this->sendResponse($featured_products,'All Products Retrived Successfully.');
    }

    public function increase_product_view(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }

        $prod = Product::find($request->product_id);
        if($prod->views_count == null)
        {
            $prod->views_count = 1;
            $prod->save();
        }else{
            $prod->views_count = (int)$prod->views_count + 1;
            $prod->save();
        }

        return $this->sendResponse($prod,'Product View Increased Successfully.');
    }

    public function delete_photo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'product_id' => 'required|exists:product,id',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }

        $photo = Photo::find($request->id);
        if($photo){
            $photo->delete();
            return $this->sendResponse([],'Photo Deleted Successfully.');
        }else{
            return $this->sendResponse([],'Image with requested Id does not exist.');
        }
    }
    
    public function get_location()
    {
        $uniqueLocations = Product::distinct()->pluck('location');
        $uniqueLocations = Product::select('location')->distinct()->get();
        $uniqueLocations = Product::whereNotNull('location')
                            ->select('location')
                            ->distinct()
                            ->get();
        return $this->sendResponse($uniqueLocations,'Request Successful.');

    }

    public function delete_product(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }

        $auctions = Auction::where('product_id',$request->product_id)->pluck('id')->toArray();
        $offers = MakeOffer::where('product_id',$request->product_id)->pluck('id')->toArray();

        $del_not = Notification::where('type','auction')->whereIn('type_id',$auctions)->delete();
        $del_not = Notification::where('type','MakeOffer')->whereIn('type_id',$offers)->delete();
        $del_not = Notification::where('type','auction_expire')->where('type_id',$request->product_id)->delete();
        $del_not = Notification::where('type','Auction Expire')->where('type_id',$request->product_id)->delete();

        $del_auctions = Auction::where('product_id',$request->product_id)->delete();
        $del_offers = MakeOffer::where('product_id',$request->product_id)->delete();
        $del_chats = ChatModel::where('product_id',$request->product_id)->delete();
        $del_photos = Photo::where('product_id',$request->product_id)->delete();
        $del_videos = Video::where('product_id',$request->product_id)->delete();
        $del_wishlist = Wishlist::where('product_id',$request->product_id)->delete();
        $del_reports = Report::where('product_id',$request->product_id)->delete();
        $del_property = DB::table('property_listing')->where('product_id',$request->product_id)->delete();
        
        $del_prod = Product::where('id',$request->product_id)->delete();

        return $this->sendResponse([],'Product Deleted Successfully.');
    }
}

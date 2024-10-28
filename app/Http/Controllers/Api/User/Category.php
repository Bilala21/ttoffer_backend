<?php

namespace App\Http\Controllers\APi\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Sub_Category;
class Category extends Controller
{
    public function index(Request $request)
    {
        $query = Categories::query()->where('status', 1);

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        if ($request->filled('limit')) {
            $query->limit($request->limit);
        }

        $categories = $query->get();

        $baseUrl = config('app.base_url'); // Using configuration value
        $categories->transform(function ($category) use ($baseUrl) {
            if ($category->image) {
                $category->image = $baseUrl . ltrim($category->image, '/');
            }
            return $category;
        });

        return response()->json($categories);
    }

    public function sub_category(Request $request){
        $query = Sub_Category::query();

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        if ($request->filled('limit')) {
            $query->limit($request->limit);
        }

        $categories = $query->get();

        return response()->json($categories);
    }
    
    public function show()
    {
        try
        {
            return response()->json(Categories::select(
                                                        "id", 
                                                        "name",
                                                        "image",
                                                        "status"
                                                        )->where('status',1)->get());
            // return [
            //     'data' => [
            //         'code'                  => 200,
            //         'message'               => "Request was successful.",
            //         'result'                => $category,
            //         'errors'                => "",
            //         'serverMaintenance'     => env("SERVER_MAINTENANCE", false),
            //     ],
            //   'status' => 200
            // ];
        }
        catch (\Exception $e) {
            return response()->json("Error:".$e->getMessage(), 422);
        }
    }
    
    public function show_sub_category($id)
    {
        try
        {
            if($id < 1)
                return response()->json("Invalid ID", 422);
            $category = Sub_Category::select('id', 'category_id', 'name')->where('category_id', $id)->get();
            if($category)
                return response()->json($category);
            else
                return response()->json("Invalid category ID", 422);
        }
        catch (\Exception $e) {
            return response()->json("Error:".$e->getMessage(), 422);
            // return makeResponse(ResponseCode::UNEXPECTED_ERROR, ResponseCode::getMessage(ResponseCode::UNEXPECTED_ERROR), [], ResponseCode::UNEXPECTED_ERROR, $e->getMessage());
        }
    }
}

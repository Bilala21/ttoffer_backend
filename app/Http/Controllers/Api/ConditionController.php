<?php

namespace App\Http\Controllers\APi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;

class ConditionController extends Controller
{
    public function index()
    {
        try
        {
            return response()->json([
                [
                    'id'    => 1,
                    'name'  => "new",
                ],
                [
                    'id'    => 2,
                    'name'  => "Used",
                ]
            ]);
        }
        catch (\Exception $e) {
            return response()->json("Error:".$e->getMessage(), 422);
            // return makeResponse(ResponseCode::UNEXPECTED_ERROR, ResponseCode::getMessage(ResponseCode::UNEXPECTED_ERROR), [], ResponseCode::UNEXPECTED_ERROR, $e->getMessage());
        }
    }
    
}
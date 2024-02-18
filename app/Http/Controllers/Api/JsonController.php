<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JsonController extends Controller
{

    public function index(Request $request)
    {
        $requestMethod = $request->method();

        // Check if the request method is GET
        if ($requestMethod == 'GET') {
            $Category = Item::all();
            if ($Category->count() > 0) {

                return response()->json([
                    "status" => 200,
                    "items" => $Category

                ], 200);
            } else {
                return response()->json([
                    "status" => 404,
                    "items" => "No Category Found"

                ], 200);
            }
        } else {
            return response()->json([
                "status" => 405,
                'message' => $requestMethod . ' Not Allowed',

            ], 405);
        }
    }
}
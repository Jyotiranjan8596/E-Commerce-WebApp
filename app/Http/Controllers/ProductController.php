<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //to get the product by product id
    function get_user_product($id)
    {
        if ($id) {

            $products = Product::find($id);
            if ($products) {
                return response()->json(['products' => $products], 200);
            } else {
                return response()->json(['error' => $products->errors()], 422);
            }
        }
    }

    //to get all product data
    function get_all_product(){

        $products= Product::all();

        if($products){
            return response()->json(['Success' => $products], 200);
        }
        else{
            return response()->json(['error' => $products->errors()], 422);
        }
    }
}

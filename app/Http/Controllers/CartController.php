<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    //for add to cart
    function add_to_cart(Request $request)
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'userId' => 'required',
            'product_id' => 'required',
            'quantity' => 'required'
        ]);

        if ($validation->failed()) {
            return response()->json(['error' => $validation->errors()], 422,);
        } else {

            $cart = Cart::create($input);

            if ($cart) {
                return response()->json(['carts' => $cart], 200);
            } else {
                return response()->json(['error' => $cart->errors()], 422);
            }
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Auth\Events\Failed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNan;
use function PHPUnit\Framework\isType;

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

    //for add more quantity
    function add_quantity($id)
    {

        $cart_quantity = DB::table('carts')->where('id', $id)->increment('quantity');

        if ($cart_quantity == 1) {
            return response()->json(['message' => " Product addded to cart Successfully"], 200);
        } else {
            return response()->json(['error' => "Invalid Id"], 422);
        }
    }

    //for remove  quantity
    function remove_quantity($id)
    {

        $cart_quantity = DB::table('carts')->where('id', $id)->decrement('quantity');

        if ($cart_quantity == 1) {
            return response()->json(['message' => " Product successfully removed"], 200);
        } else {
            return response()->json(['error' => "Invalid Id"], 422);
        }
    }

    function delete_cart($id){
        $delete= DB::table('carts')->where('id',$id)->delete();
        if ($delete == 1) {
            return response()->json(['message' => " Product successfully removed"], 200);
        } else {
            return response()->json(['error' => "Invalid Id"], 422);
        }
    }
}

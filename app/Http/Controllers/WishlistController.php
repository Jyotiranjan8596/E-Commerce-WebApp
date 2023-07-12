<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    //for add to wishlist
    function add_to_wishlist(Request $request)
    {
        $user_id = Auth::user()->id;
        $input = $request->all();
        $validation = Validator::make($input, [
            'product_id' => 'required'
        ]);

        if ($validation->failed()) {
            return response()->json(['error' => $validation->errors()]);
        } else {
            $wishlist = DB::table('wishlists')->insert(array(
                'userId' => $user_id,
                'product_id' => $input['product_id']
            ));

            if ($wishlist) {
                return response()->json(['Message' => "Item added to "], 200);
            } else {
                return response()->json(['error' => "Oppss.... got some error"], 200);
            }
        }
    }

    //for remove from wishlist

    function delete_wishlist($id)
    {
        $delete = DB::table('wishlists')->where('id', $id)->delete();
        if ($delete) {
            return response()->json(['Message' => "Item Removed Successfully"], 200);
        } else {
            return response()->json(['error' => "Opps... Something happened, We are working on it."], 200);
        }
    }
}

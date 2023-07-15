<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    //for create order
    function create_order(Request $request)
    {
        $user_id = Auth::user()->id;
        $input = $request->all();
        $validation = Validator::make($input, [
            'product_id' => 'required',
            'address_id' => 'required',
            'status'     => 'required'
        ]);
        if ($validation->failed()) {
            return response()->json(['error' => $validation->errors()]);
        } else {

            $orders = Order::create([
                'userId' => $user_id,
                'product_id' => $input['product_id'],
                'address_id' => $input['address_id'],
                'status' => $input['status']

            ]);

            if ($orders) {
                return response()->json($request, 200);
            } else {
                return response()->json(['error' => "Oppss.... got some error"], 200);
            }
        }
    }

    //update the order

    //for update
    function update_order($id)
    {
        $user_id = Auth::user()->id;
        $update_order = Order::find($id);

        $update_order->status = 'Cancelled';

        $update_order->save();

        if ($update_order) {
            return response()->json(['message' => "Order Canceled"], 200);
        } else {
            return response()->json(['error' => "Oppss.... got some error"], 200);
        }
    }

    //for delete order

    function delete_order($order_id)
    {

        $delete = Order::find($order_id)->delete();

        if ($delete) {
            return response()->json(['message' => "Data deleted Successfully"], 200);
        } else {
            return response()->json(['message' => "Getting some error"], 200);
        }
    }
}

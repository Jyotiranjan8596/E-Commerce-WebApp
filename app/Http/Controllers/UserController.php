<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class UserController extends Controller
{
    function create_User(Request $request)
    {
        $req = $request->all();
        $validation = Validator::make($req, [
            'name' => 'required',
            'email' => 'required | email',
            'password' => 'password'
        ]);

        if ($validation->failed()) {
            return response()->json(['error' => $validation->errors()], 420);
        } else {

            $user = User::create($req);

            return response()->json(['Success' => $user], 200,);
        }
    }



    //for login
    function login(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors()], 422,);
        } else {
            $user = User::where(['email' => $input['email'], 'password' => $input['password']])->first();

            if ($user) {
                $token = $user->createToken('Login_Token')->accessToken;
                return response()->json([
                    'token' => $token,
                    'user' => $user
                ], 200,);
            } else {
                return response()->json(['error' => "Invalid Data"]);
            }
        }
    }

    //forgot password
    function forgot_password(Request $request)
    {

        $input = $request->all();

        $validation = Validator::make($input, [
            'email' => 'required | email',
            'password' => 'required'
        ]);

        if ($validation->failed()) {
            return response()->json(['error' => $validation->errors()], 422);
        } else {

            $user = User::where('email', $input['email'])->first();

            if ($user) {
                $user->password = $input['password'];
                $user->save();
                return response()->json(['Success'], 200);
            } else {
                return response()->json(['error' => $validation->errors()], 422);
            }
        }
    }


    //to view the cart

    function show_cart($id)
    {
        $cart = User::where('id', $id)->with('cart')->get();
        if ($cart) {
            return response()->json($cart, 200);
        } else {
            return response()->json(['error' => $cart->errors()], 422);
        }
    }


    //to view the address by userId

    function show_address($id)
    {
        // $cart = User::find($id)->with('cart')->get();
        // $cart= User::find($id)->cart;
        $address = User::where('id', $id)->with('address')->get();
        if ($address) {
            return response()->json($address, 200);
        } else {
            return response()->json(['error' => $address->errors()], 422);
        }
    }

    function show_orders($id)
    {
        // $cart = User::find($id)->with('cart')->get();
        // $cart= User::find($id)->cart;
        $orders = User::where('id', $id)->with('orders')->get();
        if ($orders) {
            return response()->json($orders, 200);
        } else {
            return response()->json(['error' => $orders->errors()], 422);
        }
    }


}

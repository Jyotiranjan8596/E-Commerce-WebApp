<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    function login(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validation->fails()) {
            // dd("Validation failed");
            return response()->json(['error' => $validation->errors()], 422,);
        } else {
            $user = User::where(['email' => $input['email'], 'password' => $input['password']])->first();
            // dd($user);

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

        $cart = User::find($id)->view_cart;
        dd($cart);
        exit;
            if ($cart) {
                return response()->json(['cart' => $cart], 200);
            }
            else{
                return response()->json(['error' => $cart->errors()], 422);
            }
    }
}

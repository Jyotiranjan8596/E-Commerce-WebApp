<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    //for add address
    function add_address(Request $request)
    {

        $user_id = Auth::user()->id;
        $input = $request->all();
        $validation = Validator::make($input, [
            'name' => 'required',
            'address' => 'required',
            'pin' => 'required'
        ]);
        if ($validation->failed()) {
            return response()->json(['error' => $validation->errors()]);
        } else {

            // $address= Address::create($input);
            $address = Address::create([
                'user_id' => $user_id,
                'name' => $input['name'],
                'address' => $input['address'],
                'pin' => $input['pin']
            ]);
            if ($address) {
                return response()->json($request, 200);
            } else {
                return response()->json(['error' => "Oppss.... got some error"], 200);
            }
        }
    }

    //for change address
    function edit_address(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $input = $request->all();
        $validation = Validator::make($input, [
            'name' => 'required',
            'address' => 'required',
            'pin' => 'required'
        ]);
        if ($validation->failed()) {
            return response()->json(['error' => $validation->errors()]);
        } else {

            $update_address = Address::find($id);

            $update_address->user_id = $user_id;
            $update_address->name = $input['name'];
            $update_address->address = $input['address'];
            $update_address->pin = $input['pin'];

            $update_address->save();


            if ($update_address) {
                return response()->json($request, 200);
            } else {
                return response()->json(['error' => "Oppss.... got some error"], 200);
            }
        }
    }

    //for delete address

    function delete_address($id)
    {
        $delete = Address::find($id)->delete();
        if ($delete) {
            return response()->json(['message' => "Data deleted Successfully"], 200);
        } else {
            return response()->json(['message' => "Getting some error"], 200);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            $address = DB::table('addresses')->insert(
                array(
                    'user_id' => $user_id,
                    'name' => $input['name'],
                    'address' => $input['address'],
                    'pin' => $input['pin']
                )
            );
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

            $update_address = DB::table('addresses')->where('id', $id)->update(
                array(

                    'user_id' => $user_id,
                    'name' => $input['name'],
                    'address' => $input['address'],
                    'pin' => $input['pin']
                )
            );

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
        $delete = DB::table('addresses')->where('id', $id)->delete();
        if ($delete) {
            return response()->json(['message' => "Data deleted Successfully"], 200);
        } else {
            return response()->json(['message' => "Getting some error"], 200);
        }
    }
}

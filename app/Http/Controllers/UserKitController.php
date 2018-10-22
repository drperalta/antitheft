<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserKit;

class UserKitController extends Controller
{
    public function add(Request $request){

        $request->validate([
            'name' => 'required',
            'serial_number' => 'required|unique:userkits'
        ]);
        if(RegisteredKit::where('serial_number', $request['serial_number'])->exists()) {
            $kit = new Kit([
                'user_id' => $request['user_id'],
                'serial_number' => $request['serial_number'],
                'name' => $request['name'],
                'status' => 'offline',
                'created_at' => time(),
                'updated_at' => time()
            ]);
            $kit->save();
            return response()->json([
                'message' => 'Successfully Added!'
            ], 201);
         }else{
            abort(402, "Invalid Serial Number");
         }
    }
}

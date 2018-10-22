<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Kit;
use App\UserKit;
use Carbon\Carbon;

class UserKitController extends Controller
{
    public function add(Request $request){

        $request->validate([
            'name' => 'required',
            'serial_number' => 'required|unique:user_kits'
        ]);
        if(Kit::where('serial_number', $request['serial_number'])->exists()) {
            $kit = new UserKit([
                'user_id' => $request['user_id'],
                'serial_number' => $request['serial_number'],
                'name' => $request['name'],
                'created_at' => Carbon::now()->setTimezone('GMT+8'),
                'updated_at' => Carbon::now()->setTimezone('GMT+8')
            ]);
            $kit->save();
            return response()->json([
                'message' => 'Successfully Added!'
            ], 201);
         }else{
            return response()->json([
                'errors' => [ 'message' => ['Invalid Serial Number'] ]
            ], 400);
         }
    }

    public function set($id){

        return UserKit::select('id','serial_number','name')->where('user_id', $id)->get();

    }
}

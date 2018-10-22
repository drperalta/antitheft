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
            $kit = new Kit([
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
            abort(402, "Invalid Serial Number");
         }
    }
}

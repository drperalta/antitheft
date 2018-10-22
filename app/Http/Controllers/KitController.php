<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Kit;
use Carbon\Carbon;

class KitController extends Controller
{
    public function add(Request $request){

        $request->validate([
            'serial_number' => 'required|unique:kits'
        ]);

        $kit = new Kit([
            'serial_number' => $request['serial_number'],
            'created_at' => Carbon::now()->setTimezone('GMT+8'),
            'updated_at' => Carbon::now()->setTimezone('GMT+8')
        ]);
        $kit->save();

        return response()->json([
            'message' => 'Successfully Added!'
        ], 201);

    }
}

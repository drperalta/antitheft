<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Log;
use App\UserKit;

class LogController extends Controller
{
    public function log(Request $request){

        if(UserKit::where('serial_number', $request['serial_number'])->first()){
            $log = new Log([
                'serial_number' => $request['serial_number'],
                'message' => $request['message'],
                'created_at' => $request['timestamp'],
                'updated_at' => $request['timestamp']
            ]);
            $log->save();
        }
        else{
            abort(401);
        }
    }
}

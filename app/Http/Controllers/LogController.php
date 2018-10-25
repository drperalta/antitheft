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
                'created_at' => Carbon::now()->setTimezone('GMT+8'),
                'updated_at' => Carbon::now()->setTimezone('GMT+8')
            ]);
            $log->save();
        }
        else{
            abort(404);
        }
    }
}

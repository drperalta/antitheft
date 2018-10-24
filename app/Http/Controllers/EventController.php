<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\UserKit;

class EventController extends Controller
{
    public function upload(Request $request){
        //serial
        //picture
        //timestamp
        //folder path
        
        $get = UserKit::select('user_id')->where('serial_number', $request['serial_number'])->first();

        $path = $get['user_id']. '/' .$request['serial_number']. '/' .$request['time'];
        $file = $request['image'];

        Storage::disk('local')->putFile($path, $file);


    }
}

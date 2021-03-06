<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\UserKit;
use App\Event;
use App\User;

class EventController extends Controller
{
    public function upload(Request $request){
        //serial
        //picture
        //timestamp
        //folder path
        
        if(UserKit::where('serial_number', $request['serial_number'])->first()){

            $get = UserKit::select('user_id')->where('serial_number', $request['serial_number'])->first();

            $path = $get['user_id']. '/' .$request['serial_number']. '/' .$request['folder_name'];
            $file = $request['file'];
    
            Storage::disk('local')->putFileAs($path, $file, $request['file_name']);
            
            $event = new Event([
                'user_id' => $get['user_id'],
                'serial_number' => $request['serial_number'],
                'folder_name' => $request['folder_name'],
                'file_name' => $request['file_name'],
                'path' => 'path',
                'created_at' => Carbon::now()->setTimezone('GMT+8'),
                'updated_at' => Carbon::now()->setTimezone('GMT+8')
            ]);
            $event->save();

            return response()->json([
                'message' => $request['file_name'] . ' is successfully uploaded!'
            ], 201);

        }else{
            return response()->json([
                'errors' => [ 'message' => ['Serial Number does not exist'] ]
            ], 401);
        }
    }

    public function getFolder($user_id,$serial_number){
        //return $user_id.' '. $serial_number;
        $folder = Event::select('folder_name')->where('user_id', $user_id)->where('serial_number', $serial_number)->get();

        $collection = collect($folder);
        $unique = $collection->unique()->values()->all();

        return $unique;
    }
    public function getFile($user_id,$serial_number){
        return Event::select('id','user_id','serial_number','folder_name','file_name')->where('user_id', $user_id)->where('serial_number', $serial_number)->get();
    }

    public function getImage($user_id, $serial_number, $folder_name, $file_name){
        $path = $user_id.'/'.$serial_number.'/'.$folder_name.'/'.$file_name;

        return Storage::disk('local')->get($path);
    }

    public function ping(Request $request){
        
        if(Userkit::where('serial_number', $request['serial_number'])->first()){
            $time =  Carbon::now()->setTimezone('GMT+8');
            UserKit::where('serial_number', $request['serial_number'])->update(['last_activity' => $time]);
        }else{
            abort(401);
        }
    }

    public function user($serial_number){

        if(UserKit::where('serial_number', $serial_number)->first()){
            $id = UserKit::select('user_id')->where('serial_number', $serial_number)->first();
            $user = User::select('id','fullname','username','email')->where('id', $id['user_id'])->get();

            return $user;
        }else{
            return response()->json([
                'errors' => ['message' => ['This kit is not linked to any User.']]
            ], 400);
        }
    }
}


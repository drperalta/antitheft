<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Kit;
use App\Log;
use App\UserKit;
use Carbon\Carbon;

class UserKitController extends Controller
{
    public function add(Request $request){

        $request->validate([
            'name' => 'required|max:10',
            'serial_number' => 'required|unique:user_kits'
        ]);
        if(Kit::where('serial_number', $request['serial_number'])->exists()) {
            $kit = new UserKit([
                'user_id' => $request['user_id'],
                'serial_number' => $request['serial_number'],
                'name' => $request['name'],
                'last_activity' => Carbon::now()->setTimezone('GMT+8'),
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

    public function logs(Request $request, $id){
        return Log::where('serial_number', $id)->orderBy('created_at', 'DESC')->get();
    }

    public function getStatus(Request $request, $id){
        return UserKit::where('serial_number', $id)->first()['status'];
    }

    public function setStatus(Request $request, $id){
        $status = $request->input('status') == 'true';

        UserKit::where('serial_number', $id)->update(['status' => $status]);
    }

    public function edit(Request $request){

        $request->validate([
            'name' => 'required|max:10',
            'serial_number' => 'required|unique:user_kits,serial_number,'. $request['id']
        ]);


        $name = UserKit::select('name')->where('id', $request['id'])->get();
        $serial = UserKit::select('serial_number')->where('serial_number', $request['serial_number']);

        if(Kit::where('serial_number', $request['serial_number'])->exists()){
          UserKit::where('id', $request['id'])->update(array('name' => $request['name'], 'serial_number' => $request['serial_number']));
          return response()->json([
              'message' => 'Successfully Updated!'
          ], 201);
        }else{
            return response()->json([
                'errors' => ['message' => ['Invalid Serial Number']]
            ], 400);
        }

      }

    public function set($id){

        return UserKit::where('user_id', $id)->get();

    }

    public function remove(Request $request){

        UserKit::destroy($request['kitId']);
        return response()->json([
            'message' => 'Successfully Deleted!'
        ], 201);
    }

    public function edit_set($id){
        return UserKit::select('serial_number','name')->where('id', $id)->get();
    }

    public function selected_kit(Request $request){
        User::where('id', $request['user_id'])->update([ 'selected_kit' => $request['kit_id'] ]);

    }

    public function delete_selected_kit(Request $request){
        User::where('id', $request['user_id'])->update([ 'selected_kit' => '' ]);
    }
    public function selected_kit_data($kit_id){
        return UserKit::where('id', $kit_id)->get();
    }
}

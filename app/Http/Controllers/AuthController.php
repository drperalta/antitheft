<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SignupActivate;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Mail\ConfirmEmail;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/|same:confirm_password',
            'confirm_password' => 'sometimes'
        ]);
        $user = new User([
            'fullname' => $request['fullname'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'activation_token' => str_random(60),
            'selected_kit' => '',
            'created_at' => Carbon::now()->setTimezone('GMT+8'),
            'updated_at' => Carbon::now()->setTimezone('GMT+8')
        ]);
        $user->save();
        \Mail::to($user['email'])->send(new ConfirmEmail($user));
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);

    }
    public function open($token){

        return redirect('confirm-email/'.$token);
    }
    public function check($token){

        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return response()->json([
                'errors' => [ 'message' => ['This activation token is invalid.'] ]
            ], 404);
        }

        return redirect('confirm-email/'.$token);
    }
    public function confirm($token)
    {
        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return response()->json([
                'errors' => [ 'message' => ['This activation token is invalid.'] ]
            ], 404);
        }
        $user->active = true;
        $user->activation_token = '';
        $user->save();

        return response()->json([
            'message' => 'Successfully confirmed your Email'
        ], 200);
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['username', 'password']);
        if(Auth::validate($credentials)){ // Check if Username and Password is correct

            $credentials['active'] = 1;
            $credentials['deleted_at'] = null;

            if(Auth::attempt($credentials)){ //Check if email is already activated

                $user = $request->user();

                $tokenResult = $user->createToken('Personal Access Token');
                $token = $tokenResult->token;
                if ($request->remember_me){
                    $token->expires_at = Carbon::now()->addWeeks(1)->setTimezone('GMT+8');
                }else {
                    $token->expires_at = Carbon::now()->addHour()->setTimezone('GMT+8');
                }
                $token->save();

                return response()->json([
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse(
                        $tokenResult->token->expires_at
                    )->toDateTimeString()
                ]);
            }else{ // if you didn't confirm your email yet
                return response()->json([
                    'errors' => [ 'message' => ['Confirm your email first'] ]
                ], 401);
            }

        }else{ //if username and password is not correct
            return response()->json([
                'errors' => [ 'message' => ['Invalid username or password'] ]
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function setUser(Request $request)
    {
        $id = $request->user()->id;

        $data = $request->validate([
            'fullname' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|unique:users,email,' . $id,
            'password' => 'nullable|min:8'
        ]);

        if (isset($data['password']) && !$data['password']) {
            unset($data['password']);
        } else {
            $data['password'] = \Hash::make($data['password']);
        }

        $request->user()->fill($data);
        $request->user()->save();
    }

    public function setEmail($token){
        return User::select('email')->where('activation_token', $token)->first();
    }
}

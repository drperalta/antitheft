<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\PasswordResetRequest;
use App\Mail\PasswordResetSuccess;
use App\User;
use App\PasswordReset;

class PasswordResetController extends Controller
{
    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user){
            return response()->json([
                'errors' => [ 'message' => ['We can\'t find a user with that e-mail address.'] ]
            ], 404);
        }
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => str_random(60)
             ]
        );
        if($user && $passwordReset){
            $data = [
                User::select('fullname')->where('email', $user->email)->first(),
                'token' => $passwordReset->token
            ];

            \Mail::to($user->email)->send(new PasswordResetRequest($data));
        }
        return response()->json([
            'message' => 'We have e-mailed your password reset link'
        ]);
    }
    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();

        if (!$passwordReset){

            response()->json([
                'errors' => [ 'message' => ['This password reset token is invalid.'] ]
            ], 404);

            $user = PasswordReset::where('token', $token)->first();

            return redirect('change-password/INVALID_TOKEN');
        }
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->setTimezone('GMT+8')->isPast()) {
            $passwordReset->delete();

            return response()->json([
                'errors' => [ 'message' => ['This password reset token is invalid.'] ]
            ], 404);

            return redirect('change-password/INVALID_TOKEN');
        }

        return redirect('change-password/'.$passwordReset->token);
    }

    public function check($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();

        if (!$passwordReset){

            return response()->json([
                'errors' => [ 'message' => ['This password reset token is invalid.'] ]
            ], 404);
        }
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->setTimezone('GMT+8')->isPast()) {
            $passwordReset->delete();

            return response()->json([
                'errors' => [ 'message' => ['This password reset token is invalid.'] ]
            ], 404);
        }
    }
     /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/|same:confirm_password',
            'confirm_password' => 'sometimes',
            'token' => 'required|string'
        ]);

        $passwordReset = PasswordReset::where([ ['token', $request->token], ['email', $request->email] ])->first();

        if (!$passwordReset){
            return response()->json([
                'errors' => [ 'message' => ['This password reset token is invalid.'] ]
            ], 404);
        }

        $user = User::where('email', $passwordReset->email)->first();

        if (!$user){
            return response()->json([
                'errors' => [ 'message' => ['We can\'t find a user with that e-mail address.'] ]
            ], 404);
        }

        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();

        $data = [
            User::select('fullname')->where('email', $user->email)->first(),
        ];

        \Mail::to($passwordReset->email)->send(new PasswordResetSuccess($data));

        return response()->json([
            'message' => 'Successfully Changed your Password'
        ], 200);
    }

    public function setEmail($token){
        return $passwordReset = PasswordReset::select('email')->where('token', $token)->first();
    }
}

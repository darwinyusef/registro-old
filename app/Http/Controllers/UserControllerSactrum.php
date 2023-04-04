<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserControllerSactrum extends Controller
{
    function index(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                "status_code" => 500,
                "message" => "Unauthorized"
            ]);
        } else {
            $user = User::where('email', $request->email)->first();
            Auth::loginUsingId($user->id, $remember = true);

            dd(  $user->tokenCan('one') );
            // $token = $user->createToken('one', ['one']);
            // return ['token' => $token->plainTextToken];
        }
    }

    function show() {
        return 1;
    }
}

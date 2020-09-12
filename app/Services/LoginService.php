<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

use App\User;

class LoginService
{
    public function login($credentials)
    {
        if (Auth::attempt($credentials)) {
            $user = User::find(auth()->user()->id);
            $response['token'] = $user->createToken('palato_token', [strtolower($user->type['type'])])->plainTextToken;
            $response['user'] = $user;
            return response()->json($response);
        } else {
            return response("", 400);
        }
    }

    public function logout()
    {
        $user = User::find(auth()->user()->id);
        $user->token()->currentAccessToken()->delete();
    }
}

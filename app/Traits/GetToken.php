<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait GetToken
{
    public function getToken()
    {
        if(auth()->check())
        {
            $user = auth()->user();
            $user->tokens()->where('name', 'defaultToken')->delete();
            $token = $user->createToken('defaultToken')->plainTextToken;
            return $token;
        }
    }
}

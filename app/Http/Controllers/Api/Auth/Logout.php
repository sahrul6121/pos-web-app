<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;

class Logout extends Controller
{
    public function __invoke()
    {
        if (! auth('api')->id()) {
            return response()->json([
                'message' => 'no access',
            ], 422);
        }

        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}

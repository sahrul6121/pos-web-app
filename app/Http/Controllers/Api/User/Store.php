<?php

namespace App\Http\Controllers\Api\User;

use App\Model\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\User as UserForm;

class Store extends Controller
{
    public function __invoke(UserForm $request): JsonResponse
    {
        User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'avatar' => $request->avatar,
            'is_active' => $request->status,
        ]);

        return response()->json([
            'message' => 'success'
        ]);
    }
}

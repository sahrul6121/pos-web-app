<?php

namespace App\Http\Controllers\Api\Auth;

use App\Model\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Login as LoginForm;
use App\Http\Resources\UserInfo;

class Login extends Controller
{
    public function __invoke(LoginForm $request): JsonResponse
    {
        $user = User::whereEmail($request->email)->first();

        if (! $user) {
            return $this->failedResponse(
                'User not found.',
                200
            );
        }

        if (! $user->is_active) {
            return $this->failedResponse(
                'User not active, please contact admin.',
                200
            );
        }

        $credentials = $request->only('email', 'password');

        if (! $token = auth('api')->attempt($credentials)) {
            return $this->failedResponse(
                'Something wrong, try to login again.',
                200
            );
        }

        return response()->json([
            'userData' => new UserInfo(auth('api')->user()),
            'accessToken' => $token,
            'tokenType' => 'bearer',
        ]);
    }

    public function failedResponse(string $message, int $code): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], $code);
    }
}

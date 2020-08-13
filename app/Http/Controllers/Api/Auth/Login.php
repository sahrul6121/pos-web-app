<?php

namespace App\Http\Controllers\Api\Auth;

use App\Model\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Login as LoginForm;

class Login extends Controller
{
    public function __invoke(LoginForm $request): JsonResponse
    {
        $user = User::whereEmail($request->email)->first();

        if (! $user) {
            return $this->failedResponse(
                'User not found.',
                401
            );
        }

        if (! $user->is_active) {
            return $this->failedResponse(
                'User not active, please contact admin.',
                422
            );
        }

        $credentials = $request->only('email', 'password');

        if (! $token = auth('api')->attempt($credentials)) {
            return $this->failedResponse(
                'Something wrong, try to login again.',
                422
            );
        }

        return response()->json([
            'user_id' => auth('api')->id(),
            'token' => $token,
            'token_type' => 'bearer',
        ]);
    }

    public function failedResponse(string $message, int $code): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], $code);
    }
}

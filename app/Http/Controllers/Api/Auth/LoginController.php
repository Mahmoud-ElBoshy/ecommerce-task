<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\CustomHandlerException;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseApiController
{
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt($data)) {

            $user = Auth::user();
            $token = $user->createToken('ecommerce');
            $user->token = $token->plainTextToken;
            return response()->json($user);
        }

        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Exceptions\UserException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserSessionController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    public function login(UserLoginRequest $request)
    {

        try {
            $user = $this->userService->login($request->validated());
            $token = $user->createToken($user->name . '_auth_token')->plainTextToken;
            return response()->json([
                'message' => 'User logged in successfully.',
                'access_token' => $token,
                'user' => $user,
            ]);

        } catch (UserException $e) {
            return response()->json(['message' => $e->getMessage(),], $e->getCode());
        }
    }
}

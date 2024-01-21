<?php

namespace App\Http\Controllers\API;

use App\Exceptions\UserException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserRegisterController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    public function __invoke(UserRegisterRequest $request): JsonResponse
    {
        try {
            $this->userService->store($request->validated());
            return response()->json(['message' => 'User created successfully'], 201);
        } catch (UserException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
}

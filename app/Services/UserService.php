<?php

namespace App\Services;

use App\Exceptions\UserException;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserService
{
    /**
     * @throws UserException
     */
    public function store(array $data)
    {
        try {
            return User::create($data);
        } catch (\Exception $e) {
            // User creation failed
            Log::error("User creation failed: {$e->getMessage()}");
            throw UserException::OopsSomethingWentWrongWhileCreating($e->getMessage());
        }
    }

    /**
     * @throws UserException
     */
    public function login(array $data): ?Authenticatable
    {
        try {
            if (!Auth::attempt($data)) {
                throw new AuthenticationException('Invalid credentials');
            }
            return Auth::user();
        } catch (AuthenticationException $e) {
            // User creation failed
            Log::error("User login failed: {$e->getMessage()}");
            throw UserException::InvalidCredentials();
        }
    }
}

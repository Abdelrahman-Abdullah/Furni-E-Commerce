<?php

namespace App\Services;

use App\Exceptions\UserException;
use App\Models\User;
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
}

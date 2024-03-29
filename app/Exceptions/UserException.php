<?php

namespace App\Exceptions;

use Exception;

class UserException extends Exception
{
    public static function OopsSomethingWentWrongWhileCreating(string $additionMsg = ''): self
    {
        return new self('Oops, something went wrong'.$additionMsg, 500);
    }

    public static function InvalidCredentials(): self
    {
        return new self('Invalid credentials', 401);
    }
}

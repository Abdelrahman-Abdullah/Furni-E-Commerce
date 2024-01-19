<?php

namespace App\Exceptions;

use Exception;

class InternalException extends Exception
{
    public static function Oops(): self
    {
        return new self('Oops! Something went wrong.', 500);
    }
}

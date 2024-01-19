<?php

namespace App\Exceptions;

use Exception;

class ProductException extends Exception
{
    public static function OopsWeHaveNoProductsYetSorry(): self
    {
        return new self('Products not found Or We Haven\'t. Yet !!', 404);
    }
}

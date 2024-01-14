<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductsService
{
    public function all(): Collection
    {
        return Product::all();
    }
}

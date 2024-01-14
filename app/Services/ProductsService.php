<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductsService
{
    public function all()
    {
        return Product::with('category:id,name')
            ->select('id', 'name', 'price','description','image','category_id');
    }
}

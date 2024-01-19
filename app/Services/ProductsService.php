<?php

namespace App\Services;

use App\Exceptions\ProductException;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductsService
{
    public function all(): Builder|ProductException
    {
        $allProducts =  Product::with('category:id,name')
            ->select('id', 'name', 'price','description','image','category_id');

        throw_if($allProducts->get()->isEmpty(), ProductException::OopsWeHaveNoProductsYetSorry());

        return $allProducts;
    }
}

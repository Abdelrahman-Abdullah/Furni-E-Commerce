<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductsService $productsService){}

    public function __invoke()
    {
        $products = $this->productsService->all()
            ->paginate(8)
            ->withQueryString();

        return view('Front.products.index', compact('products'));
    }
}

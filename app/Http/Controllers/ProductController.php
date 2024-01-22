<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductException;
use App\Services\ProductsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductsService $productsService){}

    public function __invoke()
    {
        try {
            $products = $this->productsService->all()
                ->paginate(8)
                ->withQueryString();
            return view('Front.products.index', compact('products'));
        } catch (ProductException $e) {
            $products = new Collection();
            return view('Front.products.index', compact('products'))->withErrors(['error'=>$e->getMessage()]);
        }
    }
}

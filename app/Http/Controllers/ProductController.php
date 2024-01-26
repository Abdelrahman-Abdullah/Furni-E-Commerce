<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductException;
use App\Models\Product;
use App\Services\ProductsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductsService $productsService){}

    public function index()
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
    protected function show(string $name)
    {
        try {
            $product = $this->productsService->find($name);
            return view('Front.products.show', compact('product'));
        } catch (ProductException $e) {
            return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
        }
    }

}

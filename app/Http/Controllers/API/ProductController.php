<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Services\ProductsService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductsService $productsService){}

    public function __invoke()
    {
        $allProducts = $this->productsService->all()->get();
        return response()->json(
            ProductResource::collection($allProducts)
        );

    }
}

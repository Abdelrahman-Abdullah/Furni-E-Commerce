<?php

namespace App\Http\Controllers\API;

use App\Exceptions\ProductException;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Services\ProductsService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(protected ProductsService $productsService){}

    public function index(): JsonResponse
    {
        try {
            $allProducts = $this->productsService->all()->get();
            return response()->json(
                [
                    'products' => ProductResource::collection($allProducts)
                ]
            );

        } catch (ProductException $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ], $exception->getCode());
        }
    }
}

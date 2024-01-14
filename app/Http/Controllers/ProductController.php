<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductsService $productsService){}

    public function index(): Collection
    {
        return $this->productsService->all();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $recentProducts = Product::select('name','price','image')->latest()->take(3)->get();
        return view('Front.services',compact('recentProducts'));
    }
}

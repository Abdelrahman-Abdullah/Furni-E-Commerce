<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('Front.cart', ['cartProducts' => session('cart') ?? []]);
    }

    public function store(Request $request)
    {
        $cart = session('cart') ?? [];
        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity']++;
            session(['cart' => $cart]);
            return true;
        }
        $product = Product::select('id', 'name', 'price', 'image')->find($request->id);
        $cart[$request->id] = [
            'title' => $product->name,
            'price' => $product->price,
            'imageUrl' => $product->image_url,
            'quantity' => 1
        ];
        session(['cart' => $cart]);
        return "Added Successfully";
    }
}

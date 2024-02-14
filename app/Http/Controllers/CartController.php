<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    public function index()
    {
        return view('Front.cart', ['cartProducts' => session('cart') ?? []]);
    }

    public function store(Request $request)
    {
        $productId = $request->id;

        // If the product is already in the cart, increment the quantity
        $cart = session('cart') ?? [];
        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity']++;
            session(['cart' => $cart]);
            return true;
        }
        // Find the product; if not found, return an error response
        $product = Product::select('id', 'name', 'price', 'image')->find($productId);
        if (!$product) {
            return  'Product not found';
        }
        $cart[$request->id] = [
            'id' => $product->id,
            'title' => $product->name,
            'price' => $product->price,
            'imageUrl' => $product->image_url,
            'quantity' => 1
        ];
        session(['cart' => $cart]);
        return "Product Added Successfully";
    }

    public function update(Request $request)
    {
        $productId = $request->id;
        // If the product is already in the cart, increment the quantity
        $cart = session('cart') ?? [];
        if (isset($cart[$request->id])) {
            return $this->updateCart($productId, $request->increment);
        }
        return false;
    }

    public function destroy(Request $request)
    {
        $cart = session('cart', []);
        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session(['cart' => $cart]);
            // Return a success response with a message
            return response()->json([
                'success' => true,
                'message' => 'Item removed successfully.',
            ], Response::HTTP_OK); // HTTP 200
        }

        // Return an error response if the item is not found
        return response()->json([
            'success' => false,
            'message' => 'Item not found in the cart.',
        ], Response::HTTP_NOT_FOUND); // HTTP 404
    }

    private function updateCart($productId, $isIncrement)
    {
        $cart = session('cart') ?? [];
        if ($isIncrement == 'true' && $cart[$productId]['quantity'] >= 1) {
            $cart[$productId]['quantity']++;
            session(['cart' => $cart]);
            return true;
        } else if ($isIncrement == 'false' && $cart[$productId]['quantity'] > 1) {
            $cart[$productId]['quantity']--;
            session(['cart' => $cart]);
            return true;
        }
        return false;
    }



}

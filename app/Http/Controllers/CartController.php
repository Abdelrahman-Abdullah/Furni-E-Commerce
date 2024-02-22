<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    public function index()
    {
        $cartProducts = session('cart') ?? [];
        return view('Front.cart', [
            'cartProducts' => $cartProducts,
        ]);
    }

    public function store(Request $request) {
        $productId = $request->id;
        $cart = session('cart', []);

        // Check if the product is already in the cart
        if (isset($cart[$productId])) {
            // Increment the quantity
            $cart[$productId]['quantity']++;
        } else {
            // Attempt to find the product by its ID
            $product = Product::select('id', 'name', 'price', 'image')->find($productId);
            if (!$product) {
                return 'Product not found';
            }

            // Add the new product to the cart
            $cart[$productId] = [
                'id' => $product->id,
                'title' => $product->name,
                'price' => $product->price,
                'imageUrl' => $product->image_url, // Ensure attribute matches your model
                'quantity' => 1,
            ];
        }
            // Calculate the total price of the cart
            $cart['totalPrice'] = $this->calculateTotalPrice($cart);
            // Update or set the cart with new changes
            session(['cart' => $cart]);
            return response()->json([
                'success' => true,
                'message' => 'Item added to the cart successfully.',
            ], Response::HTTP_OK); // HTTP 200
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
            if (count($cart) == 1) $cart = [];
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
        } else if ($isIncrement == 'false' && $cart[$productId]['quantity'] > 1) {
            $cart[$productId]['quantity']--;
        } else {
            return false;
        }
        $cart['totalPrice'] = $this->calculateTotalPrice($cart);
        session(['cart' => $cart]);
        return  $cart['totalPrice'];
    }

    private function calculateTotalPrice($cartProducts): float|int
    {

        return array_reduce($cartProducts, function ($carry, $product) {
            if (is_array($product)) {
                $carry += $product['price'] * $product['quantity'];
            }
            return $carry;
        }, 0);
    }



}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('Front.cart' , ['cartProducts' => session('cart') ?? []] );
    }
}

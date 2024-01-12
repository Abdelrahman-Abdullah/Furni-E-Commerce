<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomePageController extends Controller
{
        public function index()
        {
            $recent_products = Product::latest()->take(3)->get(['name','price', 'image','description']);
            return view('index' , compact('recent_products'));
        }
}

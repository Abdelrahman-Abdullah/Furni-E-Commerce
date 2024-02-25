<?php

namespace App\Http\Controllers;

use App\Models\{
    Blog,
    Product
};

class HomePageController extends Controller
{
    public function __invoke()
    {
        $recentProducts = Product::latest()->take(3)->get(['name', 'price', 'image', 'description','id']);
        $recentBlogs = Blog::with('author:id,name')->latest()->take(3)->get(['title', 'image', 'description', 'author_id', 'created_at' , 'slug']);

        return view('index', compact('recentProducts', 'recentBlogs'));
    }
}

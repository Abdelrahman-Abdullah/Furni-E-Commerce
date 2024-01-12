<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use App\Models\{
    Blog,
    Product
};

class HomePageController extends Controller
{
    public function __invoke(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $recentProducts = Product::latest()->take(3)->get(['name', 'price', 'image', 'description']);
        $recentBlogs = Blog::with('author:id,name')
            ->latest()
            ->take(3)
            ->get(['title', 'image', 'description', 'author_id','created_at']);

        return view('index', compact('recentProducts', 'recentBlogs'));
    }
}

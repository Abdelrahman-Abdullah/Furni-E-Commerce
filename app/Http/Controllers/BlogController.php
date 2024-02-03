<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    public function index()
    {
        $cachedData = Cache::remember('blog', now()->addHour(), function () {
            return Blog::with('author:id,name')
                ->select('title', 'slug', 'image', 'description','author_id')
                ->latest()
                ->get();
        });
        return view('Front.blogs.index' , ['blogs' => $cachedData]);
    }
}

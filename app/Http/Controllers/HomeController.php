<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application home page.
     */
    public function index()
    {
        $featured = Post::with(['images', 'type', 'district'])
            ->featured()
            ->published()
            ->notExpired()
            ->latest()
            ->take(6)
            ->get();

        $latest = Post::with(['images', 'type', 'district'])
            ->published()
            ->notExpired()
            ->latest()
            ->take(12)
            ->get();

        return view('home.index', compact('featured', 'latest'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Post;
use App\Models\Type;
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
            
        $districts = District::orderBy('name')->get();
        $types = Type::orderBy('name')->get();

        return view('home.index', compact('featured', 'latest', 'districts', 'types'));
    }
}
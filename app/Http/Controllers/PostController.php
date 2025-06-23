<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['images', 'type', 'district', 'btsStation'])
            ->published()
            ->notExpired()
            ->latest()
            ->paginate(15);

        return view('posts.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Ensure the post is published
        if (!$post->is_published) {
            abort(404);
        }

        // Load relationships
        $post->load(['images', 'type', 'district', 'btsStation', 'facilities', 'user']);

        // Get similar posts
        $similar = Post::with(['images', 'type', 'district'])
            ->where('id', '!=', $post->id)
            ->where(function ($query) use ($post) {
                $query->where('district_id', $post->district_id)
                    ->orWhere('type_id', $post->type_id);
            })
            ->published()
            ->notExpired()
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('posts.show', compact('post', 'similar'));
    }
}
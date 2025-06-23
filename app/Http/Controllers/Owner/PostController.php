<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\BtsStation;
use App\Models\District;
use App\Models\Facility;
use App\Models\Image;
use App\Models\Post;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('check.owner');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['images', 'type', 'district'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('owner.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $districts = District::orderBy('name')->get();
        $btsStations = BtsStation::orderBy('name')->get();
        $types = Type::orderBy('name')->get();
        $facilities = Facility::orderBy('name')->get();

        return view('owner.posts.create', compact(
            'districts',
            'btsStations',
            'types',
            'facilities'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'price_unit' => 'required|in:month,day,night',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'size' => 'nullable|numeric|min:0',
            'floor' => 'nullable|string|max:50',
            'building' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_line' => 'nullable|string|max:50',
            'contact_email' => 'nullable|email|max:255',
            'type_id' => 'required|exists:types,id',
            'district_id' => 'required|exists:districts,id',
            'bts_station_id' => 'nullable|exists:bts_stations,id',
            'facilities' => 'nullable|array',
            'facilities.*' => 'exists:facilities,id',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create post
        $post = new Post($request->except(['images', 'facilities']));
        $post->user_id = auth()->id();
        $post->slug = Str::slug($request->title) . '-' . time();
        $post->is_published = true;
        $post->save();

        // Add facilities
        if ($request->has('facilities')) {
            $post->facilities()->attach($request->facilities);
        }

        // Upload images
        if ($request->hasFile('images')) {
            $isPrimarySet = false;
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('public/images/posts');
                
                $postImage = new Image();
                $postImage->path = $path;
                $postImage->order = $index;
                
                // Set the first image as primary
                if (!$isPrimarySet) {
                    $postImage->is_primary = true;
                    $isPrimarySet = true;
                }
                
                $post->images()->save($postImage);
            }
        }

        return redirect()->route('owner.posts.index')
            ->with('success', 'ประกาศที่พักถูกสร้างเรียบร้อยแล้ว');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Check if the post belongs to the authenticated user
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('owner.posts.index')
                ->with('error', 'คุณไม่มีสิทธิ์แก้ไขประกาศนี้');
        }

        $districts = District::orderBy('name')->get();
        $btsStations = BtsStation::orderBy('name')->get();
        $types = Type::orderBy('name')->get();
        $facilities = Facility::orderBy('name')->get();

        return view('owner.posts.edit', compact(
            'post',
            'districts',
            'btsStations',
            'types',
            'facilities'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Check if the post belongs to the authenticated user
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('owner.posts.index')
                ->with('error', 'คุณไม่มีสิทธิ์แก้ไขประกาศนี้');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'price_unit' => 'required|in:month,day,night',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'size' => 'nullable|numeric|min:0',
            'floor' => 'nullable|string|max:50',
            'building' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_line' => 'nullable|string|max:50',
            'contact_email' => 'nullable|email|max:255',
            'type_id' => 'required|exists:types,id',
            'district_id' => 'required|exists:districts,id',
            'bts_station_id' => 'nullable|exists:bts_stations,id',
            'facilities' => 'nullable|array',
            'facilities.*' => 'exists:facilities,id',
            'new_images' => 'nullable|array',
            'new_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:images,id',
            'primary_image' => 'nullable|exists:images,id',
        ]);

        // Update post
        $post->update($request->except(['new_images', 'facilities', 'delete_images', 'primary_image']));

        // Update facilities
        $post->facilities()->sync($request->input('facilities', []));

        // Upload new images
        if ($request->hasFile('new_images')) {
            $lastOrder = $post->images()->max('order') ?? 0;
            
            foreach ($request->file('new_images') as $index => $image) {
                $path = $image->store('public/images/posts');
                
                $postImage = new Image();
                $postImage->path = $path;
                $postImage->order = $lastOrder + $index + 1;
                $postImage->is_primary = false;
                
                $post->images()->save($postImage);
            }
        }

        // Delete images
        if ($request->has('delete_images')) {
            $images = Image::whereIn('id', $request->delete_images)
                ->where('post_id', $post->id)
                ->get();

            foreach ($images as $image) {
                Storage::delete($image->path);
                $image->delete();
            }
        }

        // Set primary image
        if ($request->has('primary_image')) {
            $post->images()->update(['is_primary' => false]);
            $post->images()->where('id', $request->primary_image)->update(['is_primary' => true]);
        }

        return redirect()->route('owner.posts.index')
            ->with('success', 'ประกาศที่พักถูกอัปเดตเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Check if the post belongs to the authenticated user
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('owner.posts.index')
                ->with('error', 'คุณไม่มีสิทธิ์ลบประกาศนี้');
        }

        // Delete images
        foreach ($post->images as $image) {
            Storage::delete($image->path);
        }

        $post->delete();

        return redirect()->route('owner.posts.index')
            ->with('success', 'ประกาศที่พักถูกลบเรียบร้อยแล้ว');
    }
}
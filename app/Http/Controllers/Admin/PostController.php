<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BtsStation;
use App\Models\District;
use App\Models\Facility;
use App\Models\Image;
use App\Models\Post;
use App\Models\Type;
use App\Models\User;
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
        $this->middleware('check.admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::with(['user', 'type', 'district']);

        // กรองตามสถานะ
        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->where('is_published', true);
            } elseif ($request->status === 'unpublished') {
                $query->where('is_published', false);
            } elseif ($request->status === 'featured') {
                $query->where('is_featured', true);
            } elseif ($request->status === 'expired') {
                $query->whereNotNull('expires_at')
                      ->where('expires_at', '<', now());
            }
        }

        // กรองตามเจ้าของ
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // กรองตามประเภทที่พัก
        if ($request->filled('type_id')) {
            $query->where('type_id', $request->type_id);
        }

        // กรองตามพื้นที่
        if ($request->filled('district_id')) {
            $query->where('district_id', $request->district_id);
        }

        // ค้นหาตาม keyword
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%")
                  ->orWhere('address', 'like', "%{$keyword}%");
            });
        }

        // จัดเรียง
        $sortField = $request->input('sort_field', 'created_at');
        $sortDirection = $request->input('sort_direction', 'desc');
        $query->orderBy($sortField, $sortDirection);

        $posts = $query->paginate(20)->withQueryString();

        // ข้อมูลสำหรับตัวเลือกในการกรอง
        $users = User::where('role', 'owner')->orderBy('name')->get();
        $types = Type::orderBy('name')->get();
        $districts = District::orderBy('name')->get();

        return view('admin.posts.index', compact(
            'posts',
            'users',
            'types',
            'districts'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'owner')->orderBy('name')->get();
        $districts = District::orderBy('name')->get();
        $btsStations = BtsStation::orderBy('name')->get();
        $types = Type::orderBy('name')->get();
        $facilities = Facility::orderBy('name')->get();

        return view('admin.posts.create', compact(
            'users',
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
            'user_id' => 'required|exists:users,id',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'expires_at' => 'nullable|date',
            'facilities' => 'nullable|array',
            'facilities.*' => 'exists:facilities,id',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // สร้างโพสต์
        $post = new Post($request->except(['images', 'facilities']));
        $post->slug = Str::slug($request->title) . '-' . time();
        $post->is_published = $request->has('is_published');
        $post->is_featured = $request->has('is_featured');
        $post->save();

        // เพิ่มสิ่งอำนวยความสะดวก
        if ($request->has('facilities')) {
            $post->facilities()->attach($request->facilities);
        }

        // อัปโหลดรูปภาพ
        if ($request->hasFile('images')) {
            $isPrimarySet = false;
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('public/images/posts');
                
                $postImage = new Image();
                $postImage->path = $path;
                $postImage->order = $index;
                
                // ตั้งรูปแรกเป็นรูปหลัก
                if (!$isPrimarySet) {
                    $postImage->is_primary = true;
                    $isPrimarySet = true;
                }
                
                $post->images()->save($postImage);
            }
        }

        return redirect()->route('admin.posts.index')
            ->with('success', 'ประกาศที่พักถูกสร้างเรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load(['user', 'type', 'district', 'btsStation', 'facilities', 'images']);
        
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $users = User::where('role', 'owner')->orderBy('name')->get();
        $districts = District::orderBy('name')->get();
        $btsStations = BtsStation::orderBy('name')->get();
        $types = Type::orderBy('name')->get();
        $facilities = Facility::orderBy('name')->get();

        return view('admin.posts.edit', compact(
            'post',
            'users',
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
            'user_id' => 'required|exists:users,id',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'expires_at' => 'nullable|date',
            'facilities' => 'nullable|array',
            'facilities.*' => 'exists:facilities,id',
            'new_images' => 'nullable|array',
            'new_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:images,id',
            'primary_image' => 'nullable|exists:images,id',
        ]);

        // อัปเดตโพสต์
        $post->fill($request->except(['new_images', 'facilities', 'delete_images', 'primary_image', 'is_published', 'is_featured']));
        $post->is_published = $request->has('is_published');
        $post->is_featured = $request->has('is_featured');
        $post->save();

        // อัปเดตสิ่งอำนวยความสะดวก
        $post->facilities()->sync($request->input('facilities', []));

        // อัปโหลดรูปภาพใหม่
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

        // ลบรูปภาพ
        if ($request->has('delete_images')) {
            $images = Image::whereIn('id', $request->delete_images)
                ->where('post_id', $post->id)
                ->get();

            foreach ($images as $image) {
                Storage::delete($image->path);
                $image->delete();
            }
        }

        // ตั้งรูปหลัก
        if ($request->has('primary_image')) {
            $post->images()->update(['is_primary' => false]);
            $post->images()->where('id', $request->primary_image)->update(['is_primary' => true]);
        }

        return redirect()->route('admin.posts.index')
            ->with('success', 'ประกาศที่พักถูกอัปเดตเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // ลบรูปภาพ
        foreach ($post->images as $image) {
            Storage::delete($image->path);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'ประกาศที่พักถูกลบเรียบร้อยแล้ว');
    }

    /**
     * Toggle the featured status of the post.
     */
    public function toggleFeatured(Post $post)
    {
        $post->is_featured = !$post->is_featured;
        $post->save();

        return redirect()->back()
            ->with('success', 'สถานะการแนะนำถูกเปลี่ยนเรียบร้อยแล้ว');
    }

    /**
     * Toggle the published status of the post.
     */
    public function togglePublished(Post $post)
    {
        $post->is_published = !$post->is_published;
        $post->save();

        return redirect()->back()
            ->with('success', 'สถานะการเผยแพร่ถูกเปลี่ยนเรียบร้อยแล้ว');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'path',
        'order',
        'is_primary',
        'post_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_primary' => 'boolean',
    ];

    /**
     * Get the post that owns the image.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the URL of the image.
     */
    public function getUrlAttribute()
    {
        return Storage::url($this->path);
    }

    /**
     * Delete the image file when the model is deleted.
     */
    protected static function booted()
    {
        static::deleting(function ($image) {
            Storage::delete($image->path);
        });
    }
}
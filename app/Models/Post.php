<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'price_unit',
        'bedrooms',
        'bathrooms',
        'size',
        'floor',
        'building',
        'address',
        'latitude',
        'longitude',
        'contact_name',
        'contact_phone',
        'contact_line',
        'contact_email',
        'is_featured',
        'is_published',
        'expires_at',
        'user_id',
        'type_id',
        'district_id',
        'bts_station_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'size' => 'decimal:2',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'expires_at' => 'date',
    ];

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the type that owns the post.
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Get the district that owns the post.
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Get the BTS station that owns the post.
     */
    public function btsStation()
    {
        return $this->belongsTo(BtsStation::class);
    }

    /**
     * The facilities that belong to the post.
     */
    public function facilities()
    {
        return $this->belongsToMany(Facility::class);
    }

    /**
     * Get the images for the post.
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Get the primary image for the post.
     */
    public function primaryImage()
    {
        return $this->hasOne(Image::class)->where('is_primary', true);
    }

    /**
     * Scope a query to only include featured posts.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to only include published posts.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope a query to only include posts that have not expired.
     */
    public function scopeNotExpired($query)
    {
        return $query->where(function ($query) {
            $query->whereNull('expires_at')
                  ->orWhere('expires_at', '>=', now());
        });
    }

    /**
     * Format the price with the price unit.
     */
    public function getFormattedPriceAttribute()
    {
        $unit = $this->price_unit === 'month' ? '/เดือน' : ($this->price_unit === 'day' ? '/วัน' : '/คืน');
        return number_format($this->price) . ' บาท' . $unit;
    }
}
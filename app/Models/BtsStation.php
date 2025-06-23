<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BtsStation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'line',
        'color',
    ];

    /**
     * Get the posts for the BTS station.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikedPosts extends Model
{
    use HasFactory;

    /**
     * Fillable Attributes
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'post_id',
    ];

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

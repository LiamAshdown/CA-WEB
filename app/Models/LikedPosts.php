<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LikedPosts
 *
 * @property int $id
 * @property int $user_id
 * @property int $post_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|LikedPosts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LikedPosts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LikedPosts query()
 * @method static \Illuminate\Database\Eloquent\Builder|LikedPosts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LikedPosts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LikedPosts wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LikedPosts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LikedPosts whereUserId($value)
 * @mixin \Eloquent
 */
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

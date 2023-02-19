<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PostReply
 *
 * @property-read \App\Models\Post $post
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PostReply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostReply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostReply query()
 * @mixin \Eloquent
 */
class PostReply extends Model
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
        'message'
    ];

    /**
     * Get the post that owns the reply.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the user that owns the reply.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

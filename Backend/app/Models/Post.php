<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Type of posts
    const POST_TYPE_PUBLIC = 'public';
    const POST_TYPE_REPLY  = 'reply';

    /**
     * Get the user that owns the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get Parent Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Post::class, 'reply_post_id');
    }

    /**
     * Get Post Likes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes() 
    {
        return $this->hasMany(LikedPosts::class);
    }

    /**
     * Auth User Liked
     *
     * @return mixed
     */
    public function liked()
    {
        return $this->hasMany(LikedPosts::class)->where('user_id', auth()->id())->exists();
    }

    /**
     * Get Post Replies
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(self::class, 'reply_post_id')->latest();
    }
}

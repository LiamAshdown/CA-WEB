<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Image;
use Storage;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $type
 * @property string $message
 * @property int $user_id
 * @property int|null $reply_post_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PostImage> $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LikedPosts> $likes
 * @property-read int|null $likes_count
 * @property-read Post|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Post> $replies
 * @property-read int|null $replies_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereReplyPostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @mixin \Eloquent
 */
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

    /**
     * Get Post Images
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(PostImage::class, 'post_id');
    }

    /**
     * Store Image
     *
     * @param object $file
     * @return void
     */
    public function storeImage($file)
    {
        // Save to disk
        $path = $file->hashName("posts/$this->id/images/");
        $blurPath = $file->hashName("posts/$this->id/images/blur/");
        
        // TODO; The dimensions could be changed,
        // potentially let frontend handle resizing the image.
        $image = Image::make($file)->fit(640);

        $model = new PostImage();
        $model->path = $path;
        $model->blur_path = $path;
        $model->post_id = $this->id;
        $model->save();

        Storage::disk('public')->put($path, (string)$image->encode());

        // Blur image
        $image->blur(80);

        // Reduce quality for smaller image
        $image->encode('jpg', 10);

        Storage::disk('public')->put($blurPath, (string)$image->encode());
    }
}

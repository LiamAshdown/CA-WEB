<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\LikeResourceCollection;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostResourceCollection;
use App\Models\Post;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\LikePostNotification;
use App\Notifications\ReplyPostNotification;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PostResourceCollection(Post::where('type', Post::POST_TYPE_PUBLIC)->latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'message' => 'required|string|max:255',
            'images' => 'array',
            'images.*' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:10240'
        ]);

        $post = new Post();
        $post->message = $attributes['message'];
        $post->type = Post::POST_TYPE_PUBLIC;
        $post->user_id = auth()->id();
        $post->save();

        // Store images if there's any
        if (isset($attributes['images'])) {
            foreach ($attributes['images'] as $image) {
                $post->storeImage($image);
            }
        }

        return response()->noContent();
    }

    /**
     * Like Post
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function like(Request $request)
    {
        $post = Post::findOrFail($request->id);

        $post->likes()->create([
            'user_id' => auth()->id()
        ]);

        $post->user->notify(new LikePostNotification(auth()->user(), $post));

        return response()->noContent();
    }

    /**
     * Unlike Post
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function unlike(Request $request)
    {
        $post = Post::findOrFail($request->id);

        $post->likes()->where('user_id', auth()->id())->delete();

        return response()->noContent();
    }

    /**
     * Post Resource
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $post = Post::findOrFail($request->id);

        return new PostResource($post);
    }

    /**
     * Get User Posts
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function userPosts($id)
    {
        $user = User::findOrFail($id);

        return new PostResourceCollection($user->posts()->latest()->paginate());
    }

    /**
     * Get Profile Posts
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function profilePosts()
    {
        return new PostResourceCollection(auth()->user()->posts()->latest()->paginate());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request)
    {
        $attributes = $request->validate([
            'message' => 'required|string|max:140'
        ]);

        $post = Post::findOrFail($request->id);


        // Create Reply Post
        $replyPost = new Post();
        $replyPost->message = $attributes['message'];
        $replyPost->type = Post::POST_TYPE_REPLY;
        $replyPost->user_id = auth()->id();
        $replyPost->reply_post_id = $request->id; //< Reply Post ID; TODO : Validate
        $replyPost->save();

        $post = Post::findOrFail($request->id);

        $post->user->notify(new ReplyPostNotification(auth()->user(), $post));

        return response()->noContent();
    }

    /**
     * Reply Resource
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function replies(Request $request)
    {
        $post = Post::findOrFail($request->id);

        return new PostResourceCollection($post->replies);
    }

    /**
     * Get Liked Users
     *
     * @param Request $request
    * @return \Illuminate\Http\Response
     */
    public function likes(Request $request)
    {
        $post = Post::findOrFail($request->id);

        return new LikeResourceCollection($post->likes);
    }
}

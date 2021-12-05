<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
            'type' => $this->type,
            'user' => new UserResource($this->user),
            'parent' => new PostResource($this->parent),
            'liked' => $this->liked(),
            'likes_count' => $this->likes()->count(),
            'comments_count' => $this->replies()->count(),
            'created_at_readable' => $this->created_at->diffForHumans()
        ];
    }
}

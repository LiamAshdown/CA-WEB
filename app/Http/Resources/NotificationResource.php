<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Mockery\Matcher\Not;
use Notification;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        switch ($this->type) 
        {
            case Notification::TYPE_LIKE:
                return [
                    'type' => 'like',
                    'user' => $this->data['user'],
                    'post' => $this->data['post'],
                    'created_at' => $this->created_at->diffForHumans(),
                ];
        }
    }
}

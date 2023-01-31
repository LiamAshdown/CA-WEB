<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'          => $this->id,
            'name'        => $this->name,
            'username'    => $this->username,
            'profile_url' => $this->url('avatar'),
            'banner_url'  => $this->url('banner'),
            'bio'         => $this->bio,
            'position'    => $this->position,
            'email'       => $this->email,
            'company'     => [
                'name' => $this->company->name,
            ]
        ];
    }
}

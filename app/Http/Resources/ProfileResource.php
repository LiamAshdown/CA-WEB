<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'name'        => $this->name,
            'email'       => $this->email,
            'role'        => $this->roles->first()->name,
            'permissions' => $this->getAllPermissions()->pluck('name')
        ];
    }
}

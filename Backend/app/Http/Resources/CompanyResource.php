<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'id'                => $this->id,
            'name'              => $this->name,
            'telephone_number'  => $this->telephone_number,
            'postal_code'       => $this->postal_code,
            'address'           => $this->address,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at
        ];
    }
}

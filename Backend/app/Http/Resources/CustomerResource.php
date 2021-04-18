<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'id'                        => $this->id,
            'name'                      => $this->name,
            'website'                   => $this->website,
            'email'                     => $this->email,
            'telephone_number'          => $this->telephone_number,
            'billing_name'              => $this->billing_name,
            'billing_telephone_number'  => $this->billing_telephone_number,
            'billing_postal_code'       => $this->billing_postal_code,
            'billing_address'           => $this->billing_address
        ];
    }
}

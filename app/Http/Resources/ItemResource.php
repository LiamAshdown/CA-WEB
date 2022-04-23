<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'id'            => $this->id,
            'description'   => $this->description,
            'unit_price'    => $this->unit_price,
            'quantity'      => $this->quantity,
            'net'           => $this->net,
            'gross'         => $this->gross,
            'vat'           => $this->vat
        ];
    }
}

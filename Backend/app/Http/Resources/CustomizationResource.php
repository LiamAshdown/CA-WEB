<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomizationResource extends JsonResource
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
            'invoice_prefix'        => $this->invoice_prefix,
            'default_invoice_body'  => $this->default_invoice_body,
            'estimate_prefix'       => $this->estimate_prefix,
            'default_estimate_body' => $this->default_estimate_body
        ];
    }
}

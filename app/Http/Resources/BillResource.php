<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'unique_id' => $this->unique_id,
            'reference' => $this->reference,
            'notes' => $this->notes ?? '',
            'status' => $this->status,
            'due_date' => $this->due_date ? date('Y-m-d', strtotime($this->due_date)) : '',
            'due_date_formatted' => $this->due_date ? date('d/m/Y', strtotime($this->due_date)) : '',
            'customer_id' => $this->customer_id,
            'customer' => new CustomerResource($this->customer),
            'total' => $this->total(),
            'items' => new ItemResourceCollection($this->items()),
            'user_id' => $this->user_id,
            'company_id' => $this->company_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_at_readable' => $this->created_at->diffForHumans(),
            'updated_at_readable' => $this->updated_at->diffForHumans()
        ];
    }
}

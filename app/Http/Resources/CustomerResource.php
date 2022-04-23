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
        // Get initials from first name and last name
        $initials = substr($this->first_name, 0, 1) . substr($this->last_name, 0, 1);

        $fullName = '';

        if ($this->title) {
            $fullName .= $this->title . ' ';
        }

        if ($this->first_name) {
            $fullName .= $this->first_name . ' ';
        }

        if ($this->last_name) {
            $fullName .= $this->last_name;
        }

        return [
            'id'                  => $this->id,
            'initials'            => $initials,
            'full_name'           => $fullName,
            'title'               => $this->title,
            'first_name'          => $this->first_name,
            'last_name'           => $this->last_name,
            'telephone'           => $this->telephone,
            'mobile'              => $this->mobile,
            'email'               => $this->email,
            'postcode'            => $this->postcode,
            'address1'            => $this->address1,
            'address2'            => $this->address2,
            'address3'            => $this->address3,
            'town'                => $this->town,
            'county'              => $this->county,
            'created_at'          => $this->created_at,
            'updated_at'          => $this->updated_at,
            'created_at_readable' => $this->created_at->diffForHumans(),
            'updated_at_readable' => $this->updated_at->diffForHumans()
        ];
    }
}

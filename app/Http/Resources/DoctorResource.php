<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
            'center' => $this->center,
            'mobile_number' => $this->mobile_number,
            'phone' => $this->phone,
            'website' => $this->website,
            'address' => $this->address,
            'status_contract' => $this->status_contract,
            'status_doctor' => $this->status_doctor,
            'email' => $this->email,
            'city' => $this->city,
            'region' => $this->region,
            'country' => $this->country,
            'postal_code' => $this->postal_code,
          //  'created_at' => ($this->created_at)->format('Y-m-d H:i')
        ];
    }
}


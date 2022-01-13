<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class AppointmentResource extends JsonResource
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
            'representative_id' => $this->representative_id,
            'doctor_id' => $this->doctor_id,
            'location' => $this->location,
            'notes' => $this->notes,
            'actual_date' => $this->actual_date,
            'expected_date' => $this->expected_date,
            'status' => $this->status,
            'doctor_name' => $this->doctor->name,
            'doctor_address' => $this->doctor->address,
        ];
    }


}
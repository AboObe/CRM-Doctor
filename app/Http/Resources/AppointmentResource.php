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
            'id' => $this->id,
            'representative_id' => (int)$this->representative_id,
            'doctor_id' => (int)$this->doctor_id,
            'location' => $this->location,
            'notes' => $this->notes,
            'actual_date' => date('Y-m-d H:i:s', $this->actual_date),
            'expected_date' => date('Y-m-d H:i:s',$this->expected_date),
            'status' => $this->status,
            'doctor_name' => $this->doctor->name,
            'doctor_address' => $this->doctor->address,
        ];
    }


}
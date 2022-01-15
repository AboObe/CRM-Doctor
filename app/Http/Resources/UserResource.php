<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'work_type' => $this->work_type,
            'mobile_number' => $this->mobile_number,
            'profile_photo' => $this->profile_photo,
            'status' => $this->status,
            'zone' => $this->zones
        ];
    }
}

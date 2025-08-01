<?php

namespace App\Http\Resources\Base;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'user_id' => $this->user_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'building_num' => $this->building_num,
            'building_type' => $this->building_type,
            'apartment_num' => $this->apartment_num,
            'floor' => $this->floor,
            'site_name' => $this->site_name,
            'street' => $this->street,
            'additional_info' => $this->additional_info,
            'default_address' => $this->default_address,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}

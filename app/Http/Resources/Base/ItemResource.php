<?php

namespace App\Http\Resources\Base;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'restaurant_id' => $this->restaurant_id,
            'menu_id' => $this->menu_id,
            'name' => $this->name,
            'description' => $this->description,
            'item_additions' => ItemAdditionResource::collection($this->itemAdditions),
            'price' => $this->price,
            'calories' => $this->calories,
            'featured' => $this->featured,
            'image' => $this->image,
            'is_available' => $this->is_available,
            'status' => $this->status,
            'sort_order' => $this->sort_order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

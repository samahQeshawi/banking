<?php

namespace App\Http\Resources\Base;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemAdditionResource extends JsonResource
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
            'item_id' => $this->item_id,
            'title' => $this->title,
            'item_addition_options' => ItemAdditionOptionResource::collection($this->itemAdditionOptions),
            'required' => $this->required,
            'min_selection' => $this->min_selection,
            'max_selection' => $this->max_selection,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

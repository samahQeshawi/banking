<?php

namespace App\Http\Resources\Base;

use App\Models\Item;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
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
            'cart_id' => $this->cart_id,
            'item_id' => $this->item_id,
            'item_name' => Item::find($this->item_id)->name,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'item_additions' => $this->item_additions,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

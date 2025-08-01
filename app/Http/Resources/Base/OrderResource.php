<?php

namespace App\Http\Resources\Base;

use App\Utilities\JsonResourceHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'uuid' => $this->uuid,
            'customer' => (new JsonResourceHelper($this->customer))->getResourceItem(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                ];
            }),
            'restaurant' => (new JsonResourceHelper($this->restaurant))->getResourceItem(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                ];
            }),
            'address_id' => $this->address_id,
            'coupon_id' => $this->coupon_id,
            'driver_id' => $this->driver_id,
            'order_details' => $this->order_details,
            'payment_type' => $this->payment_type,
            'discount' => $this->discount,
            'total' => $this->total,
            'sub_total' => $this->sub_total,
            'delivery_fees' => $this->delivery_fees,
            'status' => $this->status,
            'order_method' => $this->order_method,
            'cancel_reason' => $this->cancel_reason,
            'is_read_it' => $this->is_read_it,
            'note' => $this->note,
            'due_at' => $this->due_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

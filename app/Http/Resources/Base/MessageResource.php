<?php

namespace App\Http\Resources\Base;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'firebase_id' => $this->firebase_id,
            'sender_id' => $this->sender_id,
            'sender_type' => $this->sender_type,
            'receiver_id' => $this->receiver_id,
            'receiver_type' => $this->receiver_type,
            'body' => $this->body,
            'is_read' => $this->is_read,
            'sent_at' => $this->sent_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

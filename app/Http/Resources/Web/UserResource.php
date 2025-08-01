<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->name,
            'email ' => $this->email ?? null,
            'phone ' => $this->phone,
            'photo' => $this->photo,
            'is_verified' => $this->is_verified,
        ];
    }
}

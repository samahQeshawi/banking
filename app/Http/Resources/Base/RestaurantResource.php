<?php

namespace App\Http\Resources\Base;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
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
            'owner_name' => $this->owner_name,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'otp' => $this->otp,
            'is_verified' => $this->is_verified,
            'iban' => $this->iban,
            'logo' => $this->logo,
            'order_type' => $this->order_type,
            'description' => $this->description,
            'has_driver' => $this->has_driver,
            'activity' => $this->activity,
            'status' => $this->status,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'location' => $this->location,
            'is_suggested' => $this->is_suggested,
            'is_featured' => $this->is_featured,
            'free_delivery_min_amount' => $this->free_delivery_min_amount,
            'extra_discount_min_amount' => $this->extra_discount_min_amount,
            'language' => $this->language,
            'notification_settings' => $this->notification_settings,
            'order_time' => new OrderTimeResource($this->orderTime),
            'section' => new SectionResource($this->section),
            'categories' => RestaurantCategoryResource::collection($this->restaurantCategories),
            'working_hours' => WorkingHourResource::collection($this->workingHours),
            'distance_in_km' => $this->distanceToUser(auth('customer_api')->user()),
            'rating' => $this->getRate(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

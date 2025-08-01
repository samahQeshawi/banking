<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantSubscription extends Model
{
    protected $fillable = [
        'id',
        'restaurant_id',
        'subscription_id',
        'start_date',
        'end_date',
        'active',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'active' => 'boolean',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}

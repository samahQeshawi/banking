<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = [];

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_subscriptions')
            ->withPivot('start_date', 'end_date', 'active')
            ->withTimestamps();
    }
}

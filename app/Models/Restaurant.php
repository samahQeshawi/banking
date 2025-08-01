<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;

class Restaurant extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guard_name = 'restaurant';

    public $timestamps = true;

    protected $guarded = [];

    public $casts = [
        'status' => 'boolean',
        'is_suggested' => 'boolean',
        'is_featured' => 'boolean',
        'activity' => 'boolean',
        'has_driver' => 'boolean',
        'notification_settings' => 'array',
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'restaurant_categories', 'restaurant_id', 'category_id');
    }

    public function orderTime()
    {
        return $this->belongsTo(OrderTime::class);
    }

    public function restaurantCategories(): HasMany
    {
        return $this->hasMany(RestaurantCategory::class);
    }

    public function workingHours()
    {
        return $this->hasMany(WorkingHour::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class, 'restaurant_subscriptions')
            ->withPivot('start_date', 'end_date', 'active')
            ->withTimestamps();
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function getImgUrlAttribute()
    {
        $image = $this->logo ?? '';

        if (URL::isValidUrl($image)) {
            return $image;
        }
        $path = public_path('uploads/restaurants/'.$image);

        return ! empty($image) && file_exists($path) ? asset('uploads/restaurants/'.$image) : asset('dashboard/assets/img/6.jpg');
    }

    public function deleteImg($photo)
    {
        $photoPath = public_path('uploads/restaurants/'.$photo);
        if (File::exists($photoPath)) {
            File::delete($photoPath);
        }
    }

    public function distanceToUser($customer): ?float
    {
        if (! $customer || ! $customer->defaultAddress) {
            return null;
        }

        $lat1 = $customer->defaultAddress->latitude;
        $lon1 = $customer->defaultAddress->longitude;
        $lat2 = $this->latitude;
        $lon2 = $this->longitude;

        // Haversine formula
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos(min(max($dist, -1), 1));
        $dist = rad2deg($dist);
        $km = $dist * 60 * 1.1515 * 1.609344;

        return round($km, 2);
    }

    public function getRate(): float
    {
        return round($this->ratings()->avg('restaurant_rate') ?? 0, 1);
    }

    public function ratings(): MorphMany
    {
    return $this->morphMany(Rate::class, 'ratable');
    }
}

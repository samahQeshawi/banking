<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guarded = [];

    protected $casts = [
        'notification_settings' => 'array',
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function defaultAddress(): HasOne
    {
        return $this->hasOne(Address::class)->where('default_address', true);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class);
    }

    public function getImgUrlAttribute()
    {
        $image = $this->photo ?? '';

        if (URL::isValidUrl($image)) {
            return $image;
        }
        $path = public_path('uploads/customers/'.$image);

        return ! empty($image) && file_exists($path) ? asset('uploads/customers/'.$image) : asset('dashboard/assets/img/6.jpg');
    }

    public function deleteImg($photo)
    {
        $photoPath = public_path('uploads/customers/'.$photo);
        if (File::exists($photoPath)) {
            File::delete($photoPath);
        }
    }

    public function ordersCount()
    {
        return $this->orders()->count();
    }

    public function getFirstNameAttribute()
    {
        return explode(' ', $this->name)[0] ?? '';
    }

    public function getLastNameAttribute()
    {
        return explode(' ', $this->name)[1] ?? '';
    }
}

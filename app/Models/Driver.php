<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = true;

    protected $guarded = [];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_available' => 'boolean',
        'latitude' => 'float',
        'longitude' => 'float',
        'balance' => 'float',
        'notification_settings' => 'array',
    ];

    public function getImgUrlAttribute()
    {
        $image = $this->photo ?? '';

        if (URL::isValidUrl($image)) {
            return $image;
        }
        $path = public_path('uploads/drivers/'.$image);

        return ! empty($image) && file_exists($path) ? asset('uploads/drivers/'.$image) : asset('dashboard/assets/img/6.jpg');
    }

    public function getLicenseImgUrlAttribute()
    {
        $image = $this->license_photo ?? '';

        if (URL::isValidUrl($image)) {
            return $image;
        }
        $path = public_path('uploads/drivers/'.$image);

        return ! empty($image) && file_exists($path) ? asset('uploads/drivers/'.$image) : asset('dashboard/assets/img/6.jpg');
    }

    public function deleteImg($photo)
    {
        $photoPath = public_path('uploads/drivers/'.$photo);
        if (File::exists($photoPath)) {
            File::delete($photoPath);
        }
    }
}

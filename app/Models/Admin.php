<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasApiTokens, HasRoles ,Notifiable;

    public $timestamps = true;

    protected $guard_name = 'admin';

    protected $guarded = [];

    public function getImgUrlAttribute()
    {
        $image = $this->image ?? '';

        if (URL::isValidUrl($image)) {
            return $image;
        }
        $path = public_path('uploads/admins/'.$image);

        return ! empty($image) && file_exists($path) ? asset('uploads/admins/'.$image) : asset('dashboard/assets/img/6.jpg');
    }

    public function deleteImg($photo)
    {
        $photoPath = public_path('uploads/admins/'.$photo);
        if (File::exists($photoPath)) {
            File::delete($photoPath);
        }
    }
}

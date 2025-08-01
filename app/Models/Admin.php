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
    // من قام بتفويض مشرفين
    public function delegates()
    {
    return $this->belongsToMany(Admin::class, 'admin_delegate', 'admin_id', 'delegate_id')
                ->withPivot(['id_number', 'problem', 'delegation_duration', 'agency_number', 'agency_type', 'max_amount'])
                ->withTimestamps();
    }

// من فُوّض إليهم هذا المشرف
    public function delegators()
   {
    return $this->belongsToMany(Admin::class, 'admin_delegate', 'delegate_id', 'admin_id')
                ->withPivot(['id_number', 'problem', 'delegation_duration', 'agency_number', 'agency_type', 'max_amount'])
                ->withTimestamps();
    }
}

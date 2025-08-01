<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class Menu extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'name',
        'image',
        'sort_order',
        'restaurant_id',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function getImgUrlAttribute()
    {
        $image = $this->image ?? '';

        if (URL::isValidUrl($image)) {
            return $image;
        }
        $path = public_path('uploads/menus/'.$image);

        return ! empty($image) && file_exists($path) ? asset('uploads/menus/'.$image) : asset('dashboard/assets/img/6.jpg');
    }

    public function deleteImg($photo)
    {
        $photoPath = public_path('uploads/menus/'.$photo);
        if (File::exists($photoPath)) {
            File::delete($photoPath);
        }
    }
}

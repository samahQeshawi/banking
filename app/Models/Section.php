<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function getImgUrlAttribute()
    {
        $image = $this->image ?? '';

        if (\URL::isValidUrl($image)) {
            return $image;
        }
        $path = public_path('uploads/sections/'.$image);

        return ! empty($image) && file_exists($path) ? asset('uploads/sections/'.$image) : asset('dashboard/assets/img/6.jpg');
    }

    public function delete_photo_file($photo)
    {

        $photoPath = public_path('uploads/sections/'.$photo);
        if (\File::exists($photoPath)) {
            \File::delete($photoPath);
        }
    }
}

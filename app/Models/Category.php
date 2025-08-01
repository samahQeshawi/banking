<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'image',
        'status',
        'created_at',
        'updated_at',
    ];

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
        $path = public_path('uploads/categories/'.$image);

        return ! empty($image) && file_exists($path) ? asset('uploads/categories/'.$image) : asset('dashboard/assets/img/6.jpg');
    }

    public function delete_photo_file($photo)
    {

        $photoPath = public_path('uploads/categories/'.$photo);
        if (\File::exists($photoPath)) {
            \File::delete($photoPath);
        }
    }
}

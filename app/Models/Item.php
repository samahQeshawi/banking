<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class Item extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = [];

    protected $casts = [
        'is_available' => 'boolean',
        'featured' => 'boolean',
        'calories' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function itemAdditions(): HasMany
    {
        return $this->hasMany(ItemAddition::class);
    }

    public function getImgUrlAttribute()
    {
        $image = $this->image ?? '';

        if (URL::isValidUrl($image)) {
            return $image;
        }
        $path = public_path('uploads/items/'.$image);

        return ! empty($image) && file_exists($path) ? asset('uploads/items/'.$image) : asset('dashboard/assets/img/6.jpg');
    }

    public function deleteImg($photo)
    {
        $photoPath = public_path('uploads/items/'.$photo);
        if (File::exists($photoPath)) {
            File::delete($photoPath);
        }
    }
}

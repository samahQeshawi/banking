<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'id',
        'image',
        'title',
        'description',
        'link',
        'view',
        'status',
        'created_at',
        'updated_at',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}

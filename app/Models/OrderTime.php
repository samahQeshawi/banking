<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTime extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'id',
        'title',
        'status',
        'created_at',
        'updated_at',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}

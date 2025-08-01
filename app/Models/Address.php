<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'id',
        'customer_id',
        'latitude',
        'longitude',
        'building_num',
        'apartment_num',
        'floor',
        'site_name',
        'additional_info',
        'building_type',
        'street',
        'default_address',
        'created_at',
        'updated_at',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}

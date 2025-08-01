<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $casts = [
        'item_additions' => 'array',
    ];

    protected $fillable = [
        'id',
        'cart_id',
        'item_id',
        'item_name',
        'quantity',
        'price',
        'item_additions',
        'created_at',
        'updated_at',
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}

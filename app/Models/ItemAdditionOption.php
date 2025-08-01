<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemAdditionOption extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = [];

    public function itemAddition(): BelongsTo
    {
        return $this->belongsTo(ItemAddition::class);
    }
}

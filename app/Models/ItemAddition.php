<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemAddition extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_required' => 'boolean',
        'min_selection' => 'integer',
        'max_selection' => 'integer',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function itemAdditionOptions(): HasMany
    {
        return $this->HasMany(ItemAdditionOption::class);
    }
}

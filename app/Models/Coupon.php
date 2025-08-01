<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Coupon extends Model
{
    use HasFactory;

    public $timestamps = true;

    public $casts = [
        'status' => 'boolean',
        'end_date' => 'datetime',
        'start_date' => 'datetime',
    ];

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function scopeValid(Builder $builder)
    {
        $now = now();

        return $builder->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->where('status', 1);
    }

    public function getAmount(float $total): float
    {
        $amount = $this->getAttribute('discount_amount');

        if ($this->getAttribute('discount_type') === 'percentage') {
            return $amount / 100 * $total;
        }

        return $total - $amount;
    }
}

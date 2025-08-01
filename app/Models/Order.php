<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'uuid',
        'customer_id',
        'restaurant_id',
        'address_id',
        'coupon_id',
        'driver_id',
        'order_details',
        'payment_type',
        'discount',
        'total',
        'sub_total',
        'delivery_fees',
        'status',
        'order_method',
        'cancel_reason',
        'is_read_it',
        'note',
        'due_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'order_details' => 'array',
        'is_read_it' => 'boolean',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function orderLogs(): HasMany
    {
        return $this->hasMany(OrderLog::class);
    }

    public function getStatusText()
    {
        switch ($this->status) {
            case 'pending':
                return 'قيد الانتظار';
            case 'preparing':
                return 'قيد التحضير';
            case 'ready':
                return 'جاهز';
            case 'completed':
                return 'مكتمل';
            case 'canceled':
                return 'ملغي';
            default:
                return $this->status;
        }
    }

    public function logs()
    {
        return $this->hasMany(OrderLog::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

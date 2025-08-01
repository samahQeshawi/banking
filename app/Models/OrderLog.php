<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'id',
        'order_id',
        'status',
        'created_at',
        'updated_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
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
}

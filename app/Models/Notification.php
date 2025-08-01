<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $casts = [
        'options' => 'array',
        'data' => 'array',
    ];

    protected $fillable = [
        'id',
        'notifiable_id',
        'notifiable_type',
        'options',
        'data',
        'read_at',
        'sent_at',
        'created_at',
        'updated_at',
    ];
}

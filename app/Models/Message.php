<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'id',
        'firebase_id',
        'sender_id',
        'sender_type',
        'receiver_id',
        'receiver_type',
        'body',
        'is_read',
        'sent_at',
        'created_at',
        'updated_at',
    ];

    public function sender()
    {
        return $this->morphTo(null, 'sender_type', 'sender_id');
    }

    public function receiver()
    {
        return $this->morphTo(null, 'receiver_type', 'receiver_id');
    }
}

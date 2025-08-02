<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'wallet_id', 'type', 'amount', 'balance_before', 'balance_after',
        'description', 'related_wallet_id', 'related_transaction_id'
    ];

    public function wallet() {
        return $this->belongsTo(Wallet::class);
    }
    public function relatedWallet() {
        return $this->belongsTo(Wallet::class, 'related_wallet_id');
    }
    public function relatedTransaction() {
        return $this->belongsTo(Transaction::class, 'related_transaction_id');
    }
}
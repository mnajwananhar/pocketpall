<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'balance',
        'user_id',
        'color_hex',
        'emoji',
    ];

    /**
     * Relasi ke User
     * Satu Wallet dimiliki oleh satu User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Transactions
     * Satu Wallet memiliki banyak Transaksi
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    // public $timestamps = false;

    protected $fillable = [
        'type',
        'amount',
        'description',
        'wallet_id',
        'category_id',
        'created_at',
        'updated_at',
        'user_id',
        'tx_date',
    ];

    protected $casts = [
        'tx_date' => 'date',
    ];

    /**
     * Relasi ke Wallet
     * Satu Transaksi dimiliki oleh satu Wallet
     */
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    /**
     * Relasi ke Category
     * Satu Transaksi dimiliki oleh satu Kategori
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

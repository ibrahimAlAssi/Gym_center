<?php

namespace App\Domains\Operations\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallets';

    protected $fillable = [
        'pending',
        'available',
    ];

    protected $casts = [
        'pending' => 'integer',
        'available' => 'integer',
    ];

    public function findMyWallet(int $walletId)
    {
        return self::select([
            'id',
            'pending',
            'available',
        ])
            ->where('id', $walletId)
            ->first();
    }
}

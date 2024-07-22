<?php

namespace App\Domains\Operations\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallets';

    protected $fillable = [
        'total',
        'pending',
        'available',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'pending' => 'decimal:2',
        'available' => 'decimal:2',
    ];
}

<?php

namespace App\Domains\Plans\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    public $timestamps = true;

    protected $fillable = [
        'subscribe_id',
        'cart_id',
        'payment_method',
        'transaction_data',
        'transaction_id',
    ];

    public function subscribe(): BelongsTo
    {
        return $this->BelongsTo(Subscribe::class);
    }
}

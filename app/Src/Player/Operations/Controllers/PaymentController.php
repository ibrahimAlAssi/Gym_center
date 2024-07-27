<?php

namespace App\Src\Player\Operations\Controllers;

use App\Domains\Plans\Models\Payment;
use App\Http\Controllers\Controller;
use App\Src\Player\Operations\Resources\PaymentGridResource;

class PaymentController extends Controller
{
    public function __construct(protected Payment $payment)
    {
    }

    public function index()
    {
        return PaymentGridResource::collection(
            $this->payment->getForGrid(playerId: request()->user('player')->id)
        )
            ->additional(['message' => __('shared.response_messages.success')]);
    }
}

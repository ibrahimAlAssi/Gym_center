<?php

namespace App\Src\Coach\Operations\Controllers;

use App\Domains\Plans\Models\Payment;
use App\Http\Controllers\Controller;
use App\Src\Coach\Operations\Resources\PaymentGridResource;

class PaymentController extends Controller
{
    public function __construct(protected Payment $payment)
    {
    }

    public function index()
    {
        return PaymentGridResource::collection(
            $this->payment->getForGrid(coachId: request()->user('coach')->id)
        )
            ->additional(['message' => __('shared.response_messages.success')]);
    }
}

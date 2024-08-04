<?php

namespace App\Src\Player\Operations\Controllers;

use App\Domains\Operations\Models\Wallet;
use App\Http\Controllers\Controller;
use App\Src\Player\Operations\Resources\WalletResource;

class WalletController extends Controller
{
    public function __construct(protected Wallet $wallet)
    {
    }

    public function index()
    {
        return $this->successResponse(
            WalletResource::make(
                $this->wallet->findMyWallet(walletId: request()->user('player')->wallet_id),
            ),
            __('shared.response_messages.success')
        );
    }
}

<?php

namespace App\Src\Player\Plans\Controllers;

use App\Domains\Plans\Models\Subscription;
use App\Http\Controllers\Controller;
use App\Src\Player\Plans\Resources\SubscriptionGridResource;

class SubscriptionController extends Controller
{
    public function __construct(protected Subscription $subscription)
    {
    }

    public function index()
    {
        return SubscriptionGridResource::collection(
            $this->subscription->getForGrid(playerId: request()->user('player')->id)
        )
            ->additional(['message' => __('shared.response_messages.success')]);
    }
}

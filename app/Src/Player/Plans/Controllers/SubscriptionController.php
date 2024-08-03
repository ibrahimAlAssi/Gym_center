<?php

namespace App\Src\Player\Plans\Controllers;

use App\Domains\Plans\Models\Discount;
use App\Domains\Plans\Models\Plan;
use App\Domains\Plans\Models\Subscription;
use App\Domains\Plans\Services\SubscriptionService;
use App\Http\Controllers\Controller;
use App\Src\Player\Plans\Requests\StoreSubscriptionRequest;
use App\Src\Player\Plans\Resources\SubscriptionGridResource;
use App\Src\Player\Plans\Resources\SubscriptionResource;

class SubscriptionController extends Controller
{
    public function __construct(
        protected Subscription $subscription,
        protected Plan $plan,
        protected Discount $discount,
    ) {
    }

    public function index()
    {
        return SubscriptionGridResource::collection(
            $this->subscription->getForGrid(playerId: request()->user('player')->id)
        )
            ->additional(['message' => __('shared.response_messages.success')]);
    }

    public function store(StoreSubscriptionRequest $request, SubscriptionService $subscriptionService)
    {
        $subscription = $subscriptionService->create(
            data: $request->validated(),
            player: $request->user()
        );

        return $this->createdResponse(
            SubscriptionResource::make($subscription->load('player', 'coach', 'plan')),
            __('shared.response_messages.created_success')
        );
    }
}

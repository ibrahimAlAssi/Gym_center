<?php

namespace App\Src\Player\Plans\Controllers;

use App\Domains\Plans\Models\Discount;
use App\Domains\Plans\Models\Plan;
use App\Domains\Plans\Models\Subscription;
use App\Http\Controllers\Controller;
use App\Src\Player\Plans\Requests\StoreSubscriptionRequest;
use App\Src\Player\Plans\Resources\SubscriptionGridResource;
use App\Src\Player\Plans\Resources\SubscriptionResource;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Support\Facades\Log;

use function App\Src\Shared\getPlayerWallet;

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

    public function store(StoreSubscriptionRequest $request)
    {
        $plan = $this->plan->find($request->plan_id);
        throw_if(empty($plan), new ValidationException(
            __('validation.exists', ['attribute' => 'plan_id'])
        ));

        // check if wallet has the cost
        $discount = $this->discount->findActiveDiscountByPlan($plan->id);
        $discount = $discount->value ?? 0;
        $data['cost'] = $plan->cost * (1 - $discount / 100);
        $player_wallet = getPlayerWallet($request['player_id']);
        throw_if(
            $data['cost'] > $player_wallet->available,
            new HttpClientException('Your need to charge your wallet :)')
        );

        try {
            $data = $request->validated();
            $data['discount_id'] = $discount?->id;
            $data['start_date'] = Carbon::now();
            $player_wallet->available -= $data['cost'];
            $player_wallet->pending += $data['cost'];
            $player_wallet->save();
            $subscription = $this->subscription->create($data);

            return $this->createdResponse(
                SubscriptionResource::make($subscription->load('player', 'coach', 'plan')),
                __('shared.response_messages.created_success')
            );
        } catch (\Throwable $th) {
            Log::error("error on store subscription in player app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

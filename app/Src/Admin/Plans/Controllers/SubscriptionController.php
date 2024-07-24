<?php

namespace App\Src\Admin\Plans\Controllers;

use App\Domains\Plans\Models\Discount;
use App\Domains\Plans\Models\Plan;
use App\Domains\Plans\Models\Subscription;
use App\Http\Controllers\Controller;
use App\Src\Admin\Plans\Requests\StoreSubscriptionRequest;
use App\Src\Admin\Plans\Requests\UpdateSubscriptionRequest;
use App\Src\Admin\Plans\Resources\SubscriptionGridResource;
use App\Src\Admin\Plans\Resources\SubscriptionResource;
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
            $this->subscription->getForGrid()
        )
            ->additional(['message' => __('shared.response_messages.success')]);
    }

    public function store(StoreSubscriptionRequest $request)
    {
        $plan = $this->plan->find($request->plan_id);
        throw_if(empty($plan), new ValidationException(
            __('validation.exists', ['attribute' => 'plan_id'])
        ));
        $subscription = $this->subscription->activeSubscription($request->player_id);

        // throw_if(!empty($subscription), new HttpClientException('Your subscription not ended yet.'));
        try {
            $data = $request->validated();
            $discount = $this->discount->findActiveDiscountByPlan($plan->id);
            $data['discount_id'] = $discount?->id;
            $discount = $discount->value ?? 0;
            $data['cost'] = $plan->cost * (1 - $discount / 100);
            $data['start_date'] = Carbon::now();
            // check if wallet has the cost
            $player_wallet = getPlayerWallet($data['player_id']);
            throw_if(
                $data['cost'] > $player_wallet->available,
                new HttpClientException('Your subscription not ended yet.')
            );
            $player_wallet->available -= $data['cost'];
            $player_wallet->pending += $data['cost'];
            $player_wallet->save();
            $subscription = $this->subscription->create($data);

            return $this->createdResponse(
                SubscriptionResource::make($subscription->load('player', 'coach', 'plan')),
                __('shared.response_messages.created_success')
            );
        } catch (\Throwable $th) {
            Log::error("error on store subscription in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        $plan = $this->plan->find($request->plan_id);
        throw_if(empty($plan), new ValidationException(
            __('validation.exists', ['attribute' => 'plan_id'])
        ));
        try {
            $data = $request->validated();
            $data['cost'] = $plan->cost;
            $subscription->update($data);

            return $this->successResponse(
                SubscriptionResource::make($subscription->load('player', 'coach', 'plan')),
                __('shared.response_messages.success')
            );
        } catch (\Throwable $th) {
            Log::error("error on update subscription in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function destroy(Subscription $subscription)
    {
        try {
            $subscription->delete();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            Log::error("error on delete subscription in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

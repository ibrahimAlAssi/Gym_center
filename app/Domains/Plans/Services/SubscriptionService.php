<?php

namespace App\Domains\Plans\Services;

use App\Domains\Entities\Models\Player;
use App\Domains\Plans\Models\Discount;
use App\Domains\Plans\Models\Plan;
use App\Domains\Plans\Models\Subscription;
use App\Src\Shared\Traits\ApiResponseHelper;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SubscriptionService
{
    public function __construct(
        protected Plan $plan,
        protected Discount $discount,
        protected Subscription $subscription,
    ) {
    }

    use ApiResponseHelper;

    public function create(array $data, Player $player)
    {
        $result = $this->check($data, $player);
        try {
            $data['discount_id'] = $result['discount']?->id;
            $data['cost'] = $result['cost'];
            $data['player_id'] = $player->id;
            $data['start_date'] = Carbon::now();
            $result['player_wallet']->available -= $data['cost'];
            $result['player_wallet']->pending += $data['cost'];
            $result['player_wallet']->save();

            return $this->subscription->create($data);
        } catch (\Throwable $th) {
            Log::error("error on store subscription in player app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function check(array $data, Player $player)
    {
        $plan = $this->plan->find($data['plan_id']);
        throw_if(empty($plan), new ValidationException(
            __('validation.exists', ['attribute' => 'plan_id'])
        ));

        $data['discount'] = $this->discount->findActiveDiscountByPlan($plan->id);
        $discountValue = $data['discount']->value ?? 0;
        $data['cost'] = $plan->cost * (1 - $discountValue / 100);
        $data['player_wallet'] = $player->wallet;
        throw_if(
            $data['cost'] > $data['player_wallet']->available,
            new HttpException(
                statusCode: Response::HTTP_NOT_ACCEPTABLE,
                message: 'Your need to charge your wallet :'
            )
        );

        return $data;
    }
}

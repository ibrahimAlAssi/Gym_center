<?php

namespace App\Src\Player\Club\Controllers;

use App\Domains\Club\Models\OrderDiet;
use App\Http\Controllers\Controller;
use App\Src\Player\Club\Controllers\Resources\OrderDietGridResource;
use App\Src\Player\Club\Requests\StoreOrderDietRequest;
use App\Src\Player\Club\Requests\UpdateOrderDietRequest;
use App\Src\Player\Club\Resources\OrderDietResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderDietController extends Controller
{
    public function __construct(protected OrderDiet $orderDiet)
    {
    }

    public function index(Request $request)
    {
        return OrderDietGridResource::collection(
            $this->orderDiet->getForGrid(playerId: $request->user('player')->id)
        )->additional(['message' => __('shared.response_messages.success')]);
    }

    public function store(StoreOrderDietRequest $request)
    {
        $playerId = $request->user('player')->id;
        $orderDiet = $this->orderDiet->findRecentlyOrderDietByPlayerId(playerId: $playerId);
        if (!$orderDiet) {
            return $this->successResponse(message: 'wait until admin response to your order');
        }
        try {
            $orderDiet = $this->orderDiet->create(
                array_merge(
                    $request->validated(),
                    ['player_id' => $playerId, 'status' => 0]
                )
            );

            return $this->createdResponse(
                OrderDietResource::make($orderDiet),
                __('shared.response_messages.created_success')
            );
        } catch (\Throwable $th) {
            Log::error("error on store order diet in player app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function update(UpdateOrderDietRequest $request, OrderDiet $orderDiet)
    {
        throw_if(
            $orderDiet->status == 1,
            new AuthorizationException('you can not update order Response')
        );
        try {
            $orderDiet->update($request->validated());

            return $this->successResponse(
                OrderDietResource::make($orderDiet),
                __('shared.response_messages.success')
            );
        } catch (\Throwable $th) {
            Log::error("error on update  order diet in player app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

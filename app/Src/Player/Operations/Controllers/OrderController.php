<?php

namespace App\Src\Player\Operations\Controllers;

use App\Domains\Operations\Models\Order;
use App\Domains\Operations\Services\ProcessStoreOrderService;
use App\Http\Controllers\Controller;
use App\Src\Player\Operations\Requests\StoreOrderRequest;
use App\Src\Player\Operations\Resources\OrderGridResource;
use App\Src\Player\Operations\Resources\OrderResource;

class OrderController extends Controller
{
    public function __construct(protected Order $order)
    {
    }

    public function index()
    {
        return OrderGridResource::collection(
            $this->order->getForGrid()
        )->additional(['message' => __('shared.response_messages.success')]);
    }

    public function store(StoreOrderRequest $request, ProcessStoreOrderService $processStoreOrderService)
    {
        $order = $processStoreOrderService->execute(
            data: $request->validated(),
            playerId: $request->user()->id,
        );

        // return $this->order->getById($order->id);
        return $this->successResponse(
            OrderResource::make($this->order->getById($order->id)),
            __('shared.response_messages.success')
        );
    }
}

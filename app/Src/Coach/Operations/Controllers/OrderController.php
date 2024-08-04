<?php

namespace App\Src\Coach\Operations\Controllers;

use App\Domains\Operations\Models\Order;
use App\Domains\Operations\Services\ProcessStoreOrderService;
use App\Http\Controllers\Controller;
use App\Src\Coach\Operations\Requests\StoreOrderRequest;
use App\Src\Coach\Operations\Resources\OrderGridResource;
use App\Src\Coach\Operations\Resources\OrderResource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class OrderController extends Controller
{
    public function __construct(protected Order $order)
    {
    }

    public function index()
    {
        return OrderGridResource::collection(
            $this->order->getForGrid(coachId: request()->user('coach')->id)
        )->additional(['message' => __('shared.response_messages.success')]);
    }

    public function store(StoreOrderRequest $request, ProcessStoreOrderService $processStoreOrderService)
    {
        $order = $processStoreOrderService->execute(
            data: $request->validated(),
            coachId: $request->user()->id,
        );
        throw_if(
            $order === Response::HTTP_NOT_ACCEPTABLE,
            new HttpException(
                statusCode: Response::HTTP_NOT_ACCEPTABLE,
                message: 'Your need to charge your wallet :'
            )
        );

        return $this->successResponse(
            OrderResource::make($this->order->getById($order->id)),
            __('shared.response_messages.success')
        );
    }
}

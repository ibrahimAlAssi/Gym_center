<?php

namespace App\Src\Admin\Club\Controllers;

use App\Domains\Club\Models\OrderDiet;
use App\Http\Controllers\Controller;
use App\Src\Admin\Club\Requests\UpdateOrderDietRequest;
use App\Src\Admin\Club\Resources\OrderDietGridResource;
use Illuminate\Support\Facades\Log;

class OrderDietController extends Controller
{
    public function __construct(protected OrderDiet $orderDiet)
    {
    }

    public function index()
    {
        return OrderDietGridResource::collection(
            $this->orderDiet->getForGrid()
        )->additional(['message' => __('shared.response_messages.success')]);
    }

    public function update(UpdateOrderDietRequest $request, OrderDiet $orderDiet)
    {
        try {
            $orderDiet->update(array_merge($request->validated(), ['status' => 1]));

            return $this->successResponse(message: __('shared.response_messages.success'));
        } catch (\Throwable $th) {
            Log::error("error on update food , exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

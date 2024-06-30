<?php

namespace App\Src\Admin\Club\Controllers;

use App\Domains\Club\Models\OrderDiet;
use App\Domains\Entities\Models\Player;
use App\Http\Controllers\Controller;
use App\Src\Admin\Club\Requests\UpdateOrderDietRequest;
use App\Src\Admin\Club\Resources\OrderDietGridResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderDietController extends Controller
{
    public function __construct(protected OrderDiet $orderDiet, protected Player $player)
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
            DB::beginTransaction();
            $orderDiet->update(array_merge($request->validated(), ['status' => 1]));
            $player = $this->player->find($orderDiet->player_id);
            $player->update(['diet_id' => $request->diet_id]);
            DB::commit();

            return $this->successResponse(message: __('shared.response_messages.success'));
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on update food , exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

<?php

namespace App\Domains\Operations\Services;

use App\Domains\Club\Models\Cart;
use App\Domains\Operations\Models\Order;
use App\Domains\Plans\Models\Payment;
use App\Src\Shared\Traits\ApiResponseHelper;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProcessStoreOrderService
{
    use ApiResponseHelper;

    public function __construct(
        protected Cart $cart,
        protected Order $order,
        protected Payment $payment,
    ) {
    }

    public function execute(array $data, ?int $coachId = null, ?int $playerId = null)
    {
        $carts = $this->cart->getMyCart(coachId: $coachId, playerId: $playerId);
        throw_if(
            $carts->count() != count($data['cart_ids']),
            new HttpException(
                statusCode: Response::HTTP_NOT_ACCEPTABLE,
                message: 'error one of the cart does not belong to you.'
            )
        );
        try {
            DB::beginTransaction();

            $order = $this->order->create(
                array_merge($data, ['player_id' => $playerId, 'coach_id' => $coachId])
            );

            $totalPrice = $this->handleOrderDetails($carts, $order);

            $this->payment->insert([
                'order_id' => $order->id,
                'player_id' => $playerId,
                'coach_id' => $coachId,
                'total' => $totalPrice,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->cart->whereIn('id', $data['cart_ids'])->delete();

            DB::commit();

            return $order;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on process order , exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function handleOrderDetails(Collection $carts, Order $order)
    {
        $totalPrice = 0;
        foreach ($carts as $cart) {
            $detailsData[] = [
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->price,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $totalPrice += $cart->price;
        }
        $order->orderDetails()->insert($detailsData);

        return $totalPrice;
    }
}

<?php

namespace App\Src\Player\Club\Controllers;

use App\Domains\Club\Models\Cart;
use App\Http\Controllers\Controller;
use App\Src\Player\Club\Requests\StoreCartRequest;
use App\Src\Player\Club\Requests\UpdateCartRequest;
use App\Src\Player\Club\Resources\CartGridResource;
use App\Src\Player\Club\Resources\CartResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function __construct(protected Cart $cart)
    {
    }

    public function index()
    {
        return $this->successResponse(
            CartGridResource::collection(
                $this->cart->getForGrid(playerId: request()->user('player')->id)
            ),
            __('shared.response_messages.success')
        );
    }

    public function store(StoreCartRequest $request)
    {
        try {
            $cart = $this->cart->create(
                array_merge($request->validated(), ['player_id' => $request->user('player')->id])
            );

            return $this->createdResponse(
                CartResource::make($cart->load('product.media'), __('shared.response_messages.created_success'))
            );
        } catch (\Throwable $th) {
            Log::error("error on create Cart in player app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function update(UpdateCartRequest $request, Cart $cart)
    {
        throw_if($cart->player_id != $request->user('player')->id, new AuthorizationException());
        try {
            $cart->update($request->validated());

            return $this->successResponse(
                CartResource::make($cart->load('product.media')),
                __('shared.response_messages.success')
            );
        } catch (\Throwable $th) {
            Log::error("error on update Cart in player app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function destroy(Cart $cart)
    {
        throw_if($cart->player_id != request()->user('player')->id, new AuthorizationException());

        try {
            $cart->delete();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            Log::error("error on delete Cart in player app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

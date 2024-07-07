<?php

namespace App\Src\Coach\Club\Controllers;

use App\Domains\Club\Models\Cart;
use App\Http\Controllers\Controller;
use App\Src\Coach\Club\Requests\StoreCartRequest;
use App\Src\Coach\Club\Requests\UpdateCartRequest;
use App\Src\Coach\Club\Resources\CartGridResource;
use App\Src\Coach\Club\Resources\CartResource;
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
                $this->cart->getForGrid(coachId: request()->user('coach')->id)
            ),
            __('shared.response_messages.success')
        );
    }

    public function store(StoreCartRequest $request)
    {
        try {
            $cart = $this->cart->create(
                array_merge($request->validated(), ['coach_id' => $request->user('coach')->id])
            );

            return $this->createdResponse(
                CartResource::make($cart->load('product.media'), __('shared.response_messages.created_success'))
            );
        } catch (\Throwable $th) {
            Log::error("error on create Cart in coach app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function update(UpdateCartRequest $request, Cart $cart)
    {
        throw_if($cart->coach_id != $request->user('coach')->id, new AuthorizationException());
        try {
            $cart->update($request->validated());

            return $this->successResponse(
                CartResource::make($cart->load('product.media')),
                __('shared.response_messages.success')
            );
        } catch (\Throwable $th) {
            Log::error("error on update Cart in coach app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function destroy(Cart $cart)
    {
        throw_if($cart->coach_id != request()->user('coach')->id, new AuthorizationException());

        try {
            $cart->delete();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            Log::error("error on delete Cart in coach app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

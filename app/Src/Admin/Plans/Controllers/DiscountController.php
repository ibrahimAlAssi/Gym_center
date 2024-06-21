<?php

namespace App\Src\Admin\Plans\Controllers;

use App\Domains\Plans\Models\Discount;
use App\Http\Controllers\Controller;
use App\Src\Admin\Plans\Requests\StoreDiscountRequest;
use App\Src\Admin\Plans\Requests\UpdateDiscountRequest;
use App\Src\Admin\Plans\Resources\DiscountGridResource;
use App\Src\Admin\Plans\Resources\DiscountResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class DiscountController extends Controller
{
    public function __construct(protected Discount $discount)
    {
    }

    public function index(Request $request)
    {
        return $this->successResponse(
            DiscountGridResource::collection(
                $this->discount->getForGrid(active: $request->boolean('active'))
            ),
            __('shared.response_messages.success')
        );
    }

    public function store(StoreDiscountRequest $request)
    {
        try {
            $discount = $this->discount->create($request->validated());

            return $this->createdResponse(
                DiscountResource::make($discount->load('plan')),
                __('shared.response_messages.created_success')
            );
        } catch (\Throwable $th) {
            Log::error("error on store discount in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function update(UpdateDiscountRequest $request, Discount $discount)
    {
        throw_if(
            $request->has('end_date') && ! $request->has('start_date') && $discount->start_date > $discount->end_date,
            ValidationException::withMessages([
                'end_date' => 'end_date must be after start_date',
            ])
        );
        try {
            $discount->update($request->validated());

            return $this->successResponse(
                DiscountResource::make($discount->load('plan')),
                __('shared.response_messages.success')
            );
        } catch (\Throwable $th) {
            Log::error("error on update discount in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function destroy(Discount $discount)
    {
        try {
            $discount->delete();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            Log::error("error on delete discount in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

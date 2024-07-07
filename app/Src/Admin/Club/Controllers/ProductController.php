<?php

namespace App\Src\Admin\Club\Controllers;

use App\Domains\Club\Models\Product;
use App\Http\Controllers\Controller;
use App\Src\Admin\Club\Requests\StoreProductRequest;
use App\Src\Admin\Club\Requests\UpdateProductRequest;
use App\Src\Admin\Club\Resources\ProductGridResource;
use App\Src\Admin\Club\Resources\ProductResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function __construct(protected Product $product)
    {
    }

    public function index()
    {
        return ProductGridResource::collection(
            $this->product->getForGrid()
        )->additional(['message' => __('shared.response_messages.success')]);
    }

    public function store(StoreProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $product = $this->product->create($request->validated());
            $product->addMediaFromRequest('image')->toMediaCollection('products');
            DB::commit();

            return $this->createdResponse(
                ProductResource::make($product->load('media'), __('shared.response_messages.created_success'))
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on create Product in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $product->update($request->validated());
            if ($request->has('image')) {
                $product->clearMediaCollection('products');
                $product->addMediaFromRequest('image')->toMediaCollection('products');
            }
            DB::commit();

            return $this->successResponse(
                ProductResource::make($product->load('media'), __('shared.response_messages.success'))
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on updates Product in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            Log::error("error on delete Product in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

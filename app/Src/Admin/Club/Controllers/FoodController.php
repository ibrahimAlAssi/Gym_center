<?php

namespace App\Src\Admin\Club\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Domains\Club\Models\Food;
use App\Domains\Club\Models\NutritionalValue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Src\Admin\Club\Requests\StoreFoodRequest;
use App\Src\Admin\Club\Requests\UpdateFoodRequest;
use App\Src\Admin\Club\Resources\FoodResource;
use App\Src\Admin\Club\Resources\FoodGridResource;

class FoodController extends Controller
{
    public function __construct(protected Food $food)
    {
    }

    public function index(Request $request)
    {
        return $this->successResponse(
            FoodGridResource::collection(
                $this->food->getForGrid()
            ),
            __('shared.response_messages.success')
        );
    }

    public function store(StoreFoodRequest $request)
    {
        try {
            DB::beginTransaction();
            $food = $this->food->create([
                "name" => $request->name
            ]);

            // Collect nutritional values for batch insertion
            $nutritionalValuesData = [];
            foreach ($request->nutritionalValues as $value) {
                $nutritionalValuesData[] = [
                    'food_id' => $food->id,
                    'name'    => $value["name"],
                    'value'   => $value["value"],
                ];
            }
            NutritionalValue::insert($nutritionalValuesData);

            if ($request->hasFile('image')) {
                $food->addMediaFromRequest('image')->toMediaCollection('foods');
            }
            DB::commit();

            return $this->createdResponse(new FoodGridResource($food->load('media', 'nutritionalValues')), 'created');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on create  food , exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function show(Food $food)
    {
        return $this->successResponse(new FoodResource($food->load('media', 'nutritionalValues')), 'success');
    }

    public function update(UpdateFoodRequest $request, Food $food)
    {
        try {
            DB::beginTransaction();
            $food->update($request->validated());
            $food->nutritionalValues()->delete();
            $nutritionalValuesData = [];
            foreach ($request->nutritionalValues as $value) {
                $nutritionalValuesData[] = [
                    'food_id' => $food->id,
                    'name'    => $value["name"],
                    'value'   => $value["value"],
                ];
            }
            NutritionalValue::insert($nutritionalValuesData);
            DB::commit();

            return $this->successResponse(new FoodGridResource($food->load('media', 'nutritionalValues')), 'updated');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on update food , exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function updateImage(Request $request, Food $food)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'image' => [
                'required',
                'file',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048', // Maximum file size in kilobytes
            ],
        ]);
        try {
            // Remove the existing image from the media library
            $food->clearMediaCollection('foods');
            // Store the new image in the media library
            $food->addMediaFromRequest('image')->toMediaCollection('foods');

            return $this->successResponse(new FoodResource($food->load('media')), 'updated');
        } catch (\Throwable $th) {
            return $this->failedResponse($th->getMessage());
        }
    }

    public function destroy(Food $food)
    {
        try {
            $food->delete();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            Log::error("error on delete food , exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

<?php

namespace App\Src\Admin\Club\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Domains\Club\Models\Food;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:food,name',
            'image' => [
                'required',
                'file',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048', // Maximum file size in kilobytes
                Rule::dimensions()->maxWidth(1000)->maxHeight(1000), // Maximum dimensions in pixels
            ],
        ]);
        try {
            DB::beginTransaction();
            $food = $this->food->create(
                ["name" => $request->name]
            );

            if ($request->hasFile('image')) {
                $food->addMediaFromRequest('image')->toMediaCollection('foods');
            }
            DB::commit();

            return $this->createdResponse(new FoodGridResource($food->load('media')), 'created');
        } catch (\Throwable $th) {
            Log::error("error on create  food , exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function show(Food $food)
    {
        return $this->successResponse(new FoodResource($food->load('media')), 'success');
    }

    public function update(Request $request, Food $food)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('food', 'name')->ignore($food->id)],
        ]);
        try {
            $food->update($validatedData);

            return $this->successResponse(new FoodGridResource($food), 'updated');
        } catch (\Throwable $th) {
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
                Rule::dimensions()->maxWidth(1000)->maxHeight(1000), // Maximum dimensions in pixels
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

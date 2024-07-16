<?php

namespace App\Src\Admin\Entities\Controllers;

use App\Domains\Entities\Models\Coach;
use App\Domains\Operations\Models\Wallet;
use App\Http\Controllers\Controller;
use App\Src\Admin\Entities\Requests\StoreCoachRequest;
use App\Src\Admin\Entities\Requests\UpdateCoachRequest;
use App\Src\Admin\Entities\Requests\UpdateImageRequest;
use App\Src\Admin\Entities\Resources\CoachGridResource;
use App\Src\Admin\Entities\Resources\CoachResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CoachController extends Controller
{
    public function __construct(protected Coach $coach, protected Wallet $wallet)
    {
    }

    public function index(Request $request)
    {
        return CoachGridResource::collection(
            $this->coach->getForGrid($request->random)
        )->additional(['message' => __('shared.response_messages.success')]);
    }

    public function store(StoreCoachRequest $request)
    {
        try {
            DB::beginTransaction();
            $wallet = $this->wallet->create([
                'available' => $request->available, 'total' => $request->available,
            ]);
            $coach = $this->coach->create(
                array_merge($request->validated(), ['wallet_id' => $wallet->id])
            );

            if ($request->hasFile('avatar')) {
                $coach->addMediaFromRequest('avatar')->toMediaCollection('coaches');
            }
            DB::commit();

            return $this->createdResponse(new CoachResource($coach->load('media')), 'created');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function show(Coach $coach)
    {
        return $this->successResponse(new CoachResource($coach->load('roles', 'media')), 'success');
    }

    public function update(UpdateCoachRequest $request, Coach $coach)
    {
        try {
            $coach->update($request->validated());
            $wallet = $coach->wallet;
            if ($request->has('available')) {
                $this->wallet->where('id', $coach->wallet_id)->update([
                    'available' => $request->available,
                    'total' => $wallet->total + $request->available,
                ]);
            } elseif ($request->has('pending')) {
                $this->wallet->where('id', $coach->wallet_id)->update([
                    'pending' => $request->pending,
                    'total' => $wallet->total - $request->pending,
                ]);
            }

            return $this->successResponse(new CoachResource($coach->load('media')), 'updated');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function updateImage(UpdateImageRequest $request, Coach $coach)
    {
        try {
            // Remove the existing image from the media library
            $coach->clearMediaCollection('coaches');
            // Store the new image in the media library
            $coach->addMediaFromRequest('avatar')->toMediaCollection('coaches');

            return $this->successResponse(new CoachResource($coach->load('media')), 'updated');
        } catch (\Throwable $th) {
            return $this->failedResponse($th->getMessage());
        }
    }

    public function destroy(Coach $coach)
    {
        try {
            DB::beginTransaction();
            // Remove the existing image from the media library
            // Remove the item
            $coach->delete();
            DB::commit();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

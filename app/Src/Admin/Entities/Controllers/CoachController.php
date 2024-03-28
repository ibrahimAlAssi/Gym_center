<?php

namespace App\Src\Admin\Entities\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Domains\Entities\Models\Coach;
use App\Src\Admin\Entities\Resources\CoachResource;
use App\Src\Admin\Entities\Requests\StoreCoachRequest;
use App\Src\Admin\Entities\Requests\UpdateCoachRequest;
use App\Src\Admin\Entities\Requests\UpdateImageRequest;
use App\Src\Admin\Entities\Resources\CoachGridResource;

class CoachController extends Controller
{
    public function __construct(protected Coach $coach)
    {
    }

    public function index()
    {
        $coaches = $this->coach->getForGrid();

        return $this->successResponse(CoachGridResource::collection($coaches), 'success');
    }

    public function store(StoreCoachRequest $request)
    {
        try {
            DB::beginTransaction();
            $coach = $this->coach->create($request->validated());

            if ($request->hasFile('avatar')) {
                $coach->addMediaFromRequest('avatar')->toMediaCollection('coaches');
            }
            DB::commit();


            return $this->createdResponse(new CoachResource($coach->load('media')), 'created');
        } catch (\Throwable $th) {
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
        return $request;
        try {
            $coach->update($request->validated());

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
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

<?php

namespace App\Src\Coach\Entities\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Domains\Entities\Models\Coach;
use App\Src\Coach\Entities\Resources\CoachResource;
use App\Src\Coach\Entities\Requests\UpdateCoachRequest;
use App\Src\Coach\Entities\Requests\UpdateImageRequest;
use App\Src\Coach\Entities\Resources\CoachGridResource;

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

    public function show(Coach $coach)
    {
        return $this->successResponse(new CoachResource($coach->load('roles', 'media')), 'success');
    }

    public function update(UpdateCoachRequest $request)
    {
        try {
            $coach = Coach::findOrFail(auth()->user('coach')->id);
            $coach->update($request->validated());

            return $this->successResponse(new CoachResource($coach->load('media')), 'updated');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function updateImage(UpdateImageRequest $request)
    {
        try {
            $coach = Coach::findOrFail(auth()->user('coach')->id);
            // Remove the existing image from the media library
            $coach->clearMediaCollection('coaches');
            // Store the new image in the media library
            $coach->addMediaFromRequest('avatar')->toMediaCollection('coaches');
            return $this->successResponse(new CoachResource($coach->load('media')), 'updated');
        } catch (\Throwable $th) {
            return $this->failedResponse($th->getMessage());
        }
    }
}

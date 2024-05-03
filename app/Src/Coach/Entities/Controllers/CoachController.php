<?php

namespace App\Src\Coach\Entities\Controllers;

use App\Domains\Entities\Models\Coach;
use App\Http\Controllers\Controller;
use App\Src\Coach\Entities\Requests\UpdateCoachRequest;
use App\Src\Coach\Entities\Requests\UpdateImageRequest;
use App\Src\Coach\Entities\Resources\CoachGridResource;
use App\Src\Coach\Entities\Resources\CoachResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CoachController extends Controller
{
    public function __construct(protected Coach $coach)
    {
    }

    public function index(Request $request)
    {
        return CoachGridResource::collection(
            $this->coach->getForGrid($request->random)
        )->additional(['message' => __('shared.response_messages.success')]);
    }

    public function show(Coach $coach)
    {
        return $this->successResponse(new CoachResource($coach->load('roles', 'media')), 'success');
    }

    public function update(UpdateCoachRequest $request, Coach $coach)
    {
        try {
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

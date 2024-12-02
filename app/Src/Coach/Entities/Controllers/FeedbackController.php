<?php

namespace App\Src\Coach\Entities\Controllers;

use App\Domains\Entities\Models\Feedback;
use App\Http\Controllers\Controller;
use App\Src\Coach\Entities\Requests\StoreFeedbackRequest;
use App\Src\Coach\Entities\Requests\UpdateFeedBackRequest;
use App\Src\Coach\Entities\Resources\FeedbackGridResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    public function __construct(protected Feedback $feedback)
    {
    }

    public function index(Request $request)
    {
        return $this->successResponse(
            FeedbackGridResource::collection(
                $this->feedback->getForGrid(
                    coachId: $request->user('coach')->id
                )
            ),
            __('shared.response_messages.success')
        );
    }

    public function store(StoreFeedbackRequest $request)
    {
        try {
            $feedback = $this->feedback->create(array_merge(
                $request->validated(),
                ['coach_id' => $request->user('coach')->id]
            ));

            return $this->createdResponse(new FeedbackGridResource($feedback), 'created');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function update(UpdateFeedBackRequest $request, Feedback $feedback)
    {
        throw_if($request->user()->id != $feedback->coach_id, new AuthorizationException());
        try {
            $feedback->update($request->validated());

            return $this->successResponse(new FeedbackGridResource($feedback), 'updated');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function destroy(Request $request, Feedback $feedback)
    {
        throw_if($request->user()->id != $feedback->coach_id, new AuthorizationException());

        try {
            $feedback->delete();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

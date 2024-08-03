<?php

namespace App\Src\Player\Entities\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Domains\Entities\Models\Admin;
use App\Domains\Entities\Models\Feedback;
use App\Src\Shared\Notifications\NewReview;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Access\AuthorizationException;
use App\Src\Player\Entities\Requests\StoreFeedbackRequest;
use App\Src\Player\Entities\Requests\UpdateFeedBackRequest;
use App\Src\Player\Entities\Resources\FeedbackGridResource;

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
                    playerId: $request->user('player')->id
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
                ['player_id' => $request->user('player')->id]
            ));
            // Send notification to admin
            Notification::send(Admin::All(), new NewReview($request->user()));

            return $this->createdResponse(new FeedbackGridResource($feedback), 'created');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function update(UpdateFeedBackRequest $request, Feedback $feedback)
    {
        throw_if($request->user()->id != $feedback->player_id, new AuthorizationException());
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
        throw_if($request->user()->id != $feedback->player_id, new AuthorizationException());

        try {
            $feedback->delete();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

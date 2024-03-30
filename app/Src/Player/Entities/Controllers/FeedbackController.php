<?php

namespace App\Src\Player\Entities\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Domains\Entities\Models\Feedback;
use App\Src\Player\Entities\Requests\StoreFeedbackRequest;
use App\Src\Player\Entities\Resources\FeedbackGridResource;

class FeedbackController extends Controller
{
    public function __construct(protected Feedback $feedback)
    {
    }

    public function store(StoreFeedbackRequest $request)
    {
        try {
            $feedback = $this->feedback->create($request->validated());

            return $this->createdResponse(new FeedbackGridResource($feedback->load('player')), 'created');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function update(StoreFeedbackRequest $request, Feedback $feedback)
    {
        try {
            $feedback->update($request->validated());

            return $this->successResponse(new FeedbackGridResource($feedback), 'updated');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function destroy(Feedback $feedback)
    {
        try {
            $feedback->delete();
            return $this->deletedResponse();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

<?php

namespace App\Src\Admin\Entities\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Domains\Entities\Models\Feedback;
use App\Src\Admin\Entities\Requests\StoreFeedbackRequest;
use App\Src\Admin\Entities\Resources\FeedbackGridResource;

class FeedbackController extends Controller
{
    public function __construct(protected Feedback $feedback)
    {
    }

    public function index()
    {
        $feedbacks = $this->feedback->getForGrid();

        return $this->successResponse(FeedbackGridResource::collection($feedbacks), 'success');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        return $this->successResponse(new FeedbackGridResource($feedback->load('player')), 'success');
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
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

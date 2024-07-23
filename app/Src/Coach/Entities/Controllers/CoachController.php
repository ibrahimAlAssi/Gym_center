<?php

namespace App\Src\Coach\Entities\Controllers;

use App\Domains\Entities\Models\Coach;
use App\Domains\Entities\Models\Player;
use App\Http\Controllers\Controller;
use App\Src\Coach\Entities\Requests\UpdateCoachRequest;
use App\Src\Coach\Entities\Resources\CoachGridResource;
use App\Src\Coach\Entities\Resources\CoachResource;
use App\Src\Coach\Entities\Resources\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CoachController extends Controller
{
    public function __construct(protected Coach $coach, protected Player $player)
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
        $coach['total_trainers'] = $this->player->where('coach_id', $coach->id)->count();

        return $this->successResponse(new ProfileResource($coach->load('roles', 'media', 'wallet')), 'success');
    }

    public function update(UpdateCoachRequest $request)
    {
        try {
            $coach = $request->user();
            $coach->update($request->validated());
            if ($request->has('avatar')) {
                $coach->clearMediaCollection('coaches');
                $coach->addMediaFromRequest('avatar')->toMediaCollection('coaches');
            }

            return $this->successResponse(
                new CoachResource($coach->load('media')),
                __('shared.response_messages.success')
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function myPlayers()
    {
        $players = $this->player->where('coach_id', auth()->user('coach')->id)
            ->with(['media'])
            ->paginate(request()->get('per_page'));

        return $this->successResponse($players, 'success');
    }
}

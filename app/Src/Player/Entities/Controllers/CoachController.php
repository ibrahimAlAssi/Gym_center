<?php

namespace App\Src\Player\Entities\Controllers;

use App\Domains\Entities\Models\Coach;
use App\Domains\Entities\Models\Player;
use App\Http\Controllers\Controller;
use App\Src\Player\Entities\Resources\CoachGridResource;
use App\Src\Player\Entities\Resources\CoachResource;
use Illuminate\Http\Request;

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

        return $this->successResponse(new CoachResource($coach->load('roles', 'media')), 'success');
    }
}

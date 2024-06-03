<?php

namespace App\Src\Player\Entities\Controllers;

use App\Domains\Entities\Models\Coach;
use App\Http\Controllers\Controller;
use App\Src\Player\Entities\Resources\CoachGridResource;
use App\Src\Player\Entities\Resources\CoachResource;
use Illuminate\Http\Request;

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
}

<?php

namespace App\Src\Player\Entities\Controllers;

use App\Domains\Entities\Models\Coach;
use App\Http\Controllers\Controller;
use App\Src\Player\Entities\Resources\CoachGridResource;
use App\Src\Player\Entities\Resources\CoachResource;

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
}

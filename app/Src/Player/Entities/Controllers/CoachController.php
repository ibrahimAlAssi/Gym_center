<?php

namespace App\Src\Player\Entities\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Domains\Entities\Models\Coach;
use App\Src\Player\Entities\Resources\CoachResource;
use App\Src\Player\Entities\Requests\UpdateCoachRequest;
use App\Src\Player\Entities\Requests\UpdateImageRequest;
use App\Src\Player\Entities\Resources\CoachGridResource;

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

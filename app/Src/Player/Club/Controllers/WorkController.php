<?php

namespace App\Src\Player\Club\Controllers;

use App\Domains\Club\Models\Work;
use App\Http\Controllers\Controller;
use App\Src\Player\Club\Resources\WorkGridResource;

class WorkController extends Controller
{
    public function __construct(protected Work $work)
    {
    }

    public function index()
    {
        return $this->successResponse(
            WorkGridResource::collection($this->work->getForGrid()),
            __('shared.response_messages.success')
        );
    }
}

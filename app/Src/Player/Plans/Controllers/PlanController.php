<?php

namespace App\Src\Player\Plans\Controllers;

use App\Domains\Plans\Models\Plan;
use App\Http\Controllers\Controller;
use App\Src\Player\Plans\Resources\PlanGridResource;
use App\Src\Player\Plans\Resources\PlanResource;

class PlanController extends Controller
{
    public function __construct(protected Plan $plan)
    {
    }

    public function index()
    {
        return $this->successResponse(
            PlanGridResource::collection($this->plan->getForGrid()),
            __('shared.response_messages.success')
        );
    }

    public function show(Plan $plan)
    {
        return $this->successResponse(
            PlanResource::make($plan->load('services', 'media')),
            __('shared.response_messages.success')
        );
    }
}

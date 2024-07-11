<?php

namespace App\Src\Player\Club\Controllers;

use App\Domains\Club\Models\Diet;
use App\Http\Controllers\Controller;
use App\Src\Admin\Club\Resources\DietGridResource;

class DietController extends Controller
{
    public function __construct(protected Diet $diet)
    {
    }

    public function index()
    {

        return $this->successResponse(
            DietGridResource::collection(
                $this->diet->getForGrid(playerId: request()->user('player')->id)
            ),
            __('shared.response_messages.success')
        );
    }
}

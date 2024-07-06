<?php

namespace App\Src\Admin\Club\Controllers;

use App\Domains\Club\Models\Work;
use App\Http\Controllers\Controller;
use App\Src\Admin\Club\Requests\StoreWorkRequest;
use App\Src\Admin\Club\Resources\WorkGridResource;
use Illuminate\Support\Facades\Log;

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

    public function store(StoreWorkRequest $request)
    {
        try {
            $man = $request->has('man_from') ? $request->man_from.' - '.$request->man_to : 'CLOSED';
            $woman = $request->has('woman_from') ? $request->woman_from.' - '.$request->woman_to : 'CLOSED';
            $work = $this->work->updateOrCreate(
                ['day' => $request->day],
                array_merge($request->validated(), ['man' => $man, 'woman' => $woman])
            );

            return $this->successResponse(
                WorkGridResource::make($work),
                __('shared.response_messages.success')
            );
        } catch (\Throwable $th) {
            Log::error("error on store working hours in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

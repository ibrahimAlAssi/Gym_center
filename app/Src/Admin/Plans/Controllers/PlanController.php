<?php

namespace App\Src\Admin\Plans\Controllers;

use App\Domains\Plans\Models\Plan;
use App\Http\Controllers\Controller;
use App\Src\Admin\Plans\Requests\StorePlanRequest;
use App\Src\Admin\Plans\Requests\UpdatePlanRequest;
use App\Src\Admin\Plans\Resources\PlanGridResource;
use App\Src\Admin\Plans\Resources\PlanResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function store(StorePlanRequest $request)
    {
        try {
            DB::beginTransaction();
            $plan = $this->plan->create($request->validated());
            if ($request->hasFile('image')) {
                $plan->addMediaFromRequest('image')->toMediaCollection('plan');
            }
            $plan->services()->attach($request->services);
            DB::commit();

            return $this->createdResponse(
                PlanResource::make($plan->load('services', 'media')),
                __('shared.response_messages.created_success')
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on store plan in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function update(UpdatePlanRequest $request, Plan $plan)
    {
        try {
            DB::beginTransaction();
            $plan->update($request->validated());
            if ($request->has('image')) {
                $plan->clearMediaCollection('plan');
                $plan->addMediaFromRequest('image')->toMediaCollection('plan');
            }
            $plan->services()->sync($request->services);
            DB::commit();

            return $this->successResponse(
                PlanResource::make($plan->load('services', 'media')),
                __('shared.response_messages.success')
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on update plan in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function destroy(Plan $plan)
    {
        try {
            DB::beginTransaction(); //transaction for image when it delete automatic
            $plan->delete();
            DB::commit();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on delete plan in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

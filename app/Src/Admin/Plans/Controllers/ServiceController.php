<?php

namespace App\Src\Admin\Plans\Controllers;

use App\Domains\Plans\Models\Service;
use App\Http\Controllers\Controller;
use App\Src\Admin\Plans\Requests\storeServiceRequest;
use App\Src\Admin\Plans\Requests\updateServiceRequest;
use App\Src\Admin\Plans\Resources\ServiceResource;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    public function __construct(protected Service $service)
    {
    }

    public function index()
    {
        return $this->successResponse(
            $this->service->getForGrid(),
            __('shared.response_messages.success')
        );
    }

    public function store(storeServiceRequest $request)
    {
        try {
            $service = $this->service->create($request->validated());

            return $this->createdResponse(
                ServiceResource::make($service),
                __('shared.response_messages.created_success')
            );
        } catch (\Throwable $th) {
            Log::error("error on store service in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function update(updateServiceRequest $request, Service $service)
    {
        try {
            $service->update($request->validated());

            return $this->successResponse(
                ServiceResource::make($service),
                __('shared.response_messages.success')
            );
        } catch (\Throwable $th) {
            Log::error("error on update service in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function destroy(Service $service)
    {
        try {
            $service->delete();
            $this->deletedResponse();
        } catch (\Throwable $th) {
            Log::error("error on delete service in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

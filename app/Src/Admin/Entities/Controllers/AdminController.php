<?php

namespace App\Src\Admin\Entities\Controllers;

use App\Domains\Entities\Models\Admin;
use App\Http\Controllers\Controller;
use App\Src\Admin\Entities\Requests\StoreAdminRequest;
use App\Src\Admin\Entities\Requests\UpdateAdminRequest;
use App\Src\Admin\Entities\Resources\AdminGridResource;
use App\Src\Admin\Entities\Resources\AdminResource;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function __construct(protected Admin $admin)
    {
    }

    public function index()
    {
        $admins = $this->admin->getForGrid();

        return $this->successResponse(AdminGridResource::collection($admins), 'success');
    }

    public function store(StoreAdminRequest $request)
    {
        try {
            $admin = $this->admin->create($request->validated());

            return $this->createdResponse(new AdminResource($admin), 'created');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function show(Admin $admin)
    {
        return $this->successResponse(new AdminResource($admin->load('roles')), 'success');
    }

    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        try {
            $admin->update($request->validated());

            return $this->successResponse(new AdminResource($admin), 'updated');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function destroy(Admin $admin)
    {
        try {
            $admin->delete();

            return $this->deletedResponse('deleted');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

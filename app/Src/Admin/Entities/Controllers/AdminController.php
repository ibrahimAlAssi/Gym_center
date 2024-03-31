<?php

namespace App\Src\Admin\Entities\Controllers;

use App\Domains\Entities\Models\Admin;
use App\Http\Controllers\Controller;
use App\Src\Admin\Entities\Requests\StoreAdminRequest;
use App\Src\Admin\Entities\Requests\UpdateAdminRequest;
use App\Src\Admin\Entities\Requests\UpdateImageRequest;
use App\Src\Admin\Entities\Resources\AdminGridResource;
use App\Src\Admin\Entities\Resources\AdminResource;
use Illuminate\Support\Facades\DB;
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
            DB::beginTransaction();
            $admin = $this->admin->create($request->validated());

            if ($request->hasFile('avatar')) {
                $admin->addMediaFromRequest('avatar')->toMediaCollection('admins');
            }
            DB::commit();

            return $this->createdResponse(new AdminResource($admin->load('media')), 'created');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function show(Admin $admin)
    {
        return $this->successResponse(new AdminResource($admin->load('roles', 'media')), 'success');
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

    public function updateImage(UpdateImageRequest $request, Admin $admin)
    {
        try {
            // Remove the existing image from the media library
            $admin->clearMediaCollection('admins');
            // Store the new image in the media library
            $admin->addMediaFromRequest('avatar')->toMediaCollection('admins');

            return $this->successResponse(new AdminResource($admin->load('media')), 'updated');
        } catch (\Throwable $th) {
            return $this->failedResponse($th->getMessage());
        }
    }

    public function destroy(Admin $admin)
    {
        try {
            DB::beginTransaction();
            // Remove the existing image from the media library
            $admin->clearMediaCollection('admins');
            // Remove the item
            $admin->delete();
            DB::commit();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

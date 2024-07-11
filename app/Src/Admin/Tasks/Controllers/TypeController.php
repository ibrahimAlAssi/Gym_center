<?php

namespace App\Src\Admin\Tasks\Controllers;

use App\Domains\Tasks\Models\Type;
use App\Http\Controllers\Controller;
use App\Src\Admin\Tasks\Requests\StoreTypeRequest;
use App\Src\Admin\Tasks\Requests\UpdateTypeRequest;
use App\Src\Admin\Tasks\Resources\TypeGridResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TypeController extends Controller
{
    public function __construct(protected Type $type)
    {
    }

    public function index()
    {
        return $this->successResponse(
            TypeGridResource::collection($this->type->getForGrid()),
            __('shared.response_messages.success')
        );
    }

    public function store(StoreTypeRequest $request)
    {
        try {
            DB::beginTransaction();
            $type = $this->type->create($request->validated());
            if ($request->has('image')) {
                $type->addMedia($request->image)->toMediaCollection('types');
            }
            DB::commit();

            return $this->createdResponse(
                TypeGridResource::make($type->load('media')),
                __('shared.response_messages.created_success')
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on store types in admin, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function update(UpdateTypeRequest $request, Type $type)
    {
        try {
            DB::beginTransaction();
            $type->update($request->validated());
            if ($request->has('image')) {
                $type->clearMediaCollection('types');
                $type->addMedia($request->image)->toMediaCollection('types');
            }
            DB::commit();

            return $this->createdResponse(
                TypeGridResource::make($type->load('media')),
                __('shared.response_messages.created_success')
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on store types in admin, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function destroy(Type $type)
    {
        try {
            $type->delete();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            Log::error("error on delete type in admin, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

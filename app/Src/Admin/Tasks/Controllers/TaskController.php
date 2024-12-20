<?php

namespace App\Src\Admin\Tasks\Controllers;

use App\Domains\Tasks\Enums\TaskTypeEnum;
use App\Domains\Tasks\Models\Task;
use App\Http\Controllers\Controller;
use App\Src\Admin\Tasks\Requests\StoreTaskRequest;
use App\Src\Admin\Tasks\Requests\UpdateTaskRequest;
use App\Src\Admin\Tasks\Resources\TaskGridResource;
use App\Src\Admin\Tasks\Resources\TaskResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function __construct(protected Task $task)
    {
    }

    public function metadata()
    {
        return $this->successResponse(
            [
                'types' => TaskTypeEnum::getValues(),
            ],
            __('shared.response_messages.success')
        );
    }

    public function index(Request $request)
    {
        return TaskGridResource::collection($this->task->getForGrid($request->random))
            ->additional(['message' => __('shared.response_messages.success')]);
    }

    public function store(StoreTaskRequest $request)
    {
        try {
            DB::beginTransaction();
            $task = $this->task->create($request->validated());
            if ($request->has('image')) {
                $task->addMedia($request->image)->toMediaCollection('tasks');
            }
            DB::commit();

            return $this->createdResponse(
                TaskResource::make($task->load('media', 'type')),
                __('shared.response_messages.created_success')
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on store Task in coach, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        try {
            DB::beginTransaction();
            $task->update($request->validated());
            if ($request->has('image')) {
                $task->clearMediaCollection('tasks');
                $task->addMedia($request->image)->toMediaCollection('tasks');
            }
            DB::commit();

            return $this->createdResponse(
                TaskResource::make($task->load('media', 'type')),
                __('shared.response_messages.success')
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on update Task in coach, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function destroy(Task $task)
    {
        try {
            DB::beginTransaction();
            $task->delete();
            DB::commit();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on delete Task in coach, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

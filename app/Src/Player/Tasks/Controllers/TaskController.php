<?php

namespace App\Src\Player\Tasks\Controllers;

use App\Domains\Tasks\Models\Task;
use App\Http\Controllers\Controller;
use App\Src\Player\Tasks\Resources\TaskResource;

class TaskController extends Controller
{
    public function __construct(protected Task $task)
    {
    }

    public function index()
    {
        return $this->successResponse(
            TaskResource::collection($this->task->getForGrid()),
            __('shared.response_messages.success')
        );
    }
}

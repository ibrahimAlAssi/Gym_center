<?php

namespace App\Src\Player\Tasks\Controllers;

use App\Domains\Tasks\Models\Task;
use App\Http\Controllers\Controller;
use App\Src\Player\Tasks\Resources\TaskResource;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected Task $task)
    {
    }

    public function index(Request $request)
    {
        return TaskResource::collection($this->task->getForGrid($request->random))
            ->additional(['message' => __('shared.response_messages.success')]);
    }
}

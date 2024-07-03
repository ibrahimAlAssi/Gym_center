<?php

namespace App\Src\Player\Tasks\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Domains\Tasks\Models\Schedule;
use App\Src\Player\Tasks\Resources\ScheduleGridResource;
use App\Src\Player\Tasks\Requests\UpdateTaskStatusRequest;

class ScheduleController extends Controller
{
    public function __construct(protected Schedule $schedule)
    {
    }

    public function index()
    {
        return $this->successResponse(
            ScheduleGridResource::collection(
                $this->schedule->getForGridPlayer(request()->user('player')->id)
            ),
            __('shared.response_messages.success')
        );
    }

    public function updateTaskStatus(UpdateTaskStatusRequest $request)
    {
        try {
            $res = DB::table('schedule_task')
                ->where('schedule_id', $request->schedule_id)
                ->where('task_id', $request->task_id)
                ->update(['is_complete' => true]);
            if ($res) {
                $allTasksComplete = DB::table('schedule_task')
                    ->where('schedule_id', $request->schedule_id)
                    ->where('is_complete', false)
                    ->exists();

                if (!$allTasksComplete) {
                    DB::table('schedules')
                        ->where('id', $request->schedule_id)
                        ->update(['is_complete' => true]);
                }
                return $this->successResponse(message: __('shared.response_messages.success'));
            }
            return $this->notFoundResponse('task not found');
        } catch (\Throwable $th) {
            Log::error("error on player when update Task Status , exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

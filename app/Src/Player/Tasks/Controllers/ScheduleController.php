<?php

namespace App\Src\Player\Tasks\Controllers;

use App\Domains\Tasks\Models\Schedule;
use App\Http\Controllers\Controller;
use App\Src\Player\Tasks\Requests\UpdateTaskStatusRequest;
use App\Src\Player\Tasks\Resources\ScheduleGridResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ScheduleController extends Controller
{
    public function __construct(protected Schedule $schedule)
    {
    }

    public function index()
    {
        return $this->successResponse(
            ScheduleGridResource::make(
                $this->schedule->getForGrid(playerId: request()->user('player')->id)[0]
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

                if (! $allTasksComplete) {
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

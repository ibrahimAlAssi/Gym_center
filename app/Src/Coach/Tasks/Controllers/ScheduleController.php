<?php

namespace App\Src\Coach\Tasks\Controllers;

use App\Domains\Entities\Models\Player;
use App\Domains\Tasks\Models\Schedule;
use App\Http\Controllers\Controller;
use App\Src\Coach\Tasks\Requests\StoreScheduleRequest;
use App\Src\Coach\Tasks\Requests\UpdateScheduleRequest;
use App\Src\Coach\Tasks\Resources\ScheduleGridResource;
use App\Src\Coach\Tasks\Resources\ScheduleResource;
use App\Src\Shared\Notifications\NewScheduleForPlayer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class ScheduleController extends Controller
{
    public function __construct(protected Schedule $schedule)
    {
    }

    public function index()
    {
        return $this->successResponse(
            ScheduleGridResource::collection(
                $this->schedule->getForGrid(coachId: request()->user('coach')->id)
            ),
            __('shared.response_messages.success')
        );
    }

    public function store(StoreScheduleRequest $request)
    {
        try {
            DB::beginTransaction();
            $schedule = $this->schedule->create($request->validated());
            foreach ($request->schedule_tasks as $task) {
                $data[] = [
                    'schedule_id' => $schedule->id,
                    'task_id' => $task['id'],
                    'repeat' => $task['repeat'],
                    'weight' => $task['weight'] ?? null,
                ];
            }
            $this->schedule->scheduleTasks()->insert($data);
            DB::commit();
            Notification::send(
                Player::find($request->player_id),
                new NewScheduleForPlayer(
                    'You have a new schedule by coach '.$request->user('coach')->name
                )
            );

            return $this->createdResponse(
                ScheduleResource::make($schedule->load('tasks')),
                __('shared.response_messages.created_success')
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on store schedule in coach, exception: {$th->getMessage()}");

            return $this->failedResponse($th->getMessage());
            // return $this->failedResponse(__('An error occurred. Please try again later. '));
        }
    }

    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        try {
            DB::beginTransaction();
            $schedule->scheduleTasks()->delete();
            $schedule->update($request->validated());
            if ($request->has('schedule_tasks')) {
                foreach ($request->schedule_tasks as $task) {
                    $data[] = [
                        'schedule_id' => $schedule->id,
                        'task_id' => $task['id'],
                        'repeat' => $task['repeat'],
                        'weight' => $task['weight'] ?? null,
                    ];
                }
                $this->schedule->scheduleTasks()->insert($data);
            }
            DB::commit();
            Notification::send(
                Player::find($request->player_id),
                new NewScheduleForPlayer(
                    'Your schedule has been updated by coach '.$request->use('coach')->name
                )
            );

            return $this->createdResponse(
                ScheduleResource::make($schedule->load('tasks')),
                __('shared.response_messages.success')
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on update schedule in coach, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function destroy(Schedule $schedule)
    {
        try {
            DB::beginTransaction();
            $schedule->delete();
            DB::commit();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on delete schedule in coach, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}

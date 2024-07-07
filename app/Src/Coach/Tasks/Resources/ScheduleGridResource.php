<?php

namespace App\Src\Coach\Tasks\Resources;

use App\Src\Player\Tasks\Resources\TaskResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleGridResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'player_name' => $this->name,
            'player_active' => (bool) $this->active,
            'day' => $this->day,
            'schedule_complete' => (bool) $this->schedule_complete,
            'tasks' => TaskResource::Collection($this->whenLoaded('tasks')),
        ];
    }
}

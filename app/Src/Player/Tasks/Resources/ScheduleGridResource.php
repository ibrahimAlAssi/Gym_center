<?php

namespace App\Src\Player\Tasks\Resources;

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
            'id'  => $this->id,
            'day' => $this->day,
            'schedule_complete' => $this->schedule_complete,
            'tasks'       => TaskResource::collection($this->whenLoaded('tasks')),
        ];
    }
}

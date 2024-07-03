<?php

namespace App\Src\Coach\Tasks\Resources;

use App\Src\Player\Tasks\Resources\TaskResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"          => $this->id,
            "day"         => $this->day,
            "is_complete" => $this->is_complete,
            'tasks'       => TaskResource::collection($this->whenLoaded('tasks')),
        ];
    }
}

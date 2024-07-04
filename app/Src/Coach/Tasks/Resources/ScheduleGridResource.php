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
            'name' => $this->name,
            'active' => (bool) $this->active,
            'tasks' => TaskResource::Collection($this->whenLoaded('tasks')),
        ];
    }
}

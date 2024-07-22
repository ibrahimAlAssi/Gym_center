<?php

namespace App\Src\Player\Tasks\Resources;

use App\Src\Shared\Resources\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $pivotData = $this->pivot ? $this->pivot->only(['repeat', 'weight', 'is_complete']) : [];

        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => [
                'id' => $this->type_id,
                'name' => $this->type_name,
            ],
            'number' => $this->number,
            'description' => $this->when($this->description != null, $this->description),
            ...$pivotData,
            'image' => $this->whenLoaded('media', fn () => new MediaResource($this->getFirstMedia('tasks'))),
        ];
    }
}

<?php

namespace App\Src\Coach\Tasks\Resources;

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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->when($this->description != null, $this->description),
            'image' => $this->whenLoaded('media', fn () => new MediaResource($this->getFirstMedia('task'))),
        ];
    }
}

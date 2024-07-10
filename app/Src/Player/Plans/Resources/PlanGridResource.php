<?php

namespace App\Src\Player\Plans\Resources;

use App\Src\Shared\Resources\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanGridResource extends JsonResource
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
            'cost' => $this->cost,
            'discount' => $this->when($this->discount_id != null, fn () => [
                'id' => $this->discount_id,
                'value' => $this->discount_value,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]),
            'image' => $this->whenLoaded('media', fn () => new MediaResource($this->getFirstMedia('plans'))),
            'services' => ServiceResource::collection($this->whenLoaded('services')),
        ];
    }
}

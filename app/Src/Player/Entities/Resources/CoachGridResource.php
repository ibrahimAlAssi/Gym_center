<?php

namespace App\Src\Player\Entities\Resources;

use App\Src\Shared\Resources\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoachGridResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'gym' => [
                'id' => $this->gym_id,
                'name' => $this->whenLoaded('gym', fn () => $this->gym->name),
            ],
            'avatar' => $this->whenLoaded('media', fn () => new MediaResource($this->getFirstMedia('coaches'))),
        ];
    }
}

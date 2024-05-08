<?php

namespace App\Src\Player\Entities\Resources;

use App\Src\Shared\Resources\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatGridResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'chat' => [
                'id' => $this->id,
            ],
            'coach' => $this->whenLoaded('coach', fn () => [
                'id' => $this->coach->id,
                'name' => $this->coach->name,
                'avatar' => $this->when(
                    $this->coach->relationLoaded('media') && $this->coach->getFirstMedia('coaches') != null,
                    fn () => new MediaResource($this->coach->getFirstMedia('coaches')),
                ),
            ]),
            'message' => $this->whenLoaded(
                'messages',
                fn () => count($this->messages) > 0 ?
                    MessageGridResource::make($this->messages[0]) : null
            ),
        ];
    }
}

<?php

namespace App\Src\Coach\Entities\Resources;

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
                'created_at' => $this->created_at,
            ],
            'player' => $this->whenLoaded('player', fn () => [
                'id' => $this->player->id,
                'name' => $this->player->name,
                'avatar' => $this->when($this->player->getFirstMedia('players') != null,
                    fn () => new MediaResource($this->player->getFirstMedia('players')),
                ),
            ]),
            'message' => $this->whenLoaded('messages',
                fn () => count($this->messages) > 0 ?
                MessageGridResource::make($this->messages[0]) : null),
        ];
    }
}

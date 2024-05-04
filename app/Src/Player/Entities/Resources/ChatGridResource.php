<?php

namespace App\Src\Player\Entities\Resources;

use Illuminate\Http\Request;
use App\Domains\Entities\Models\Player;
use App\Src\Shared\Resources\MediaResource;
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
        $player = Player::findById($this->player_id);
        return [
            'chat_id'     => $this->id,
            'coach_id'    => $this->coach_id,
            'coach_name' => $this->coach->name,
            'avatar'      =>  new MediaResource($player->getFirstMedia('players')),
            'message'     => MessageGridResource::collection($this->messages),
        ];
    }
}

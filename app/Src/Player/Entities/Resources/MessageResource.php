<?php

namespace App\Src\Player\Entities\Resources;

use App\Src\Shared\Resources\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            // 'sender_name' => $this->sender->name,
            'sender_id'   => $this->senderable_id,
            'chat_id'     => $this->chat_id,
            'message'     => $this->message,
            'avatar'      => $this->whenLoaded('media', fn () => new MediaResource($this->sender->getFirstMedia('players'))),
            'read_at'     => $this->read_at,
        ];
    }
}

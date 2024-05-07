<?php

namespace App\Src\Player\Entities\Resources;

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
            'id' => $this->id,
            'sender_id' => $this->senderable_id,
            'chat_id' => $this->chat_id,
            'message' => $this->message,
            'read_at' => $this->read_at,
        ];
    }
}

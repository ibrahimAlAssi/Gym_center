<?php

namespace App\Src\Player\Entities\Resources;

use App\Domains\Shared\Enums\AppTypesEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageGridResource extends JsonResource
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
            'message' => $this->message,
            'is_sender' => ($this->senderable_id == auth()->user()->id) && ($this->senderable_type == AppTypesEnum::PLAYER),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

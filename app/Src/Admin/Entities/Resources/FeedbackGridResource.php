<?php

namespace App\Src\Admin\Entities\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackGridResource extends JsonResource
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
            'is_complaint' => (bool) $this->is_complaint,
            'player' => [
                'id' => $this->player_id,
                'name' => $this->player_name,
            ],
        ];
    }
}

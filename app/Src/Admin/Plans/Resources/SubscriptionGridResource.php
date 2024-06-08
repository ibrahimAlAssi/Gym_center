<?php

namespace App\Src\Admin\Plans\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionGridResource extends JsonResource
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
            'cost' => $this->cost,
            'description' => $this->when($this->description != null, $this->description),
            'player' => [
                'id' => $this->player_id,
                'name' => $this->player_name,
            ],
            'coach' => $this->when($this->coach_id != null, [
                'id' => $this->coach_id,
                'name' => $this->coach_name,
            ]),
            'plan' => [
                'id' => $this->plan_id,
                'name' => $this->plan_name,
                'type' => $this->plan_type,
            ],
        ];
    }
}

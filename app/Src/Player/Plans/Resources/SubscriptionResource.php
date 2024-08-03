<?php

namespace App\Src\Player\Plans\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
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
            'cost' => (float) number_format($this->cost, 2),
            'player' => $this->whenLoaded('player', fn () => [
                'id' => $this->player->id,
                'name' => $this->player->name,
            ]),
            'coach' => $this->whenLoaded('coach', fn () => [
                'id' => $this->coach->id,
                'name' => $this->coach->name,
            ]),
            'plan' => $this->whenLoaded('plan', fn () => [
                'id' => $this->plan->id,
                'name' => $this->plan->name,
                'type' => $this->plan->type,
            ]),
            'description' => $this->when($this->description != null, $this->description),
        ];
    }
}

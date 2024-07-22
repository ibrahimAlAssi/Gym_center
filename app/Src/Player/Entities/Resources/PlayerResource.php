<?php

namespace App\Src\Player\Entities\Resources;

use App\Src\Shared\Resources\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
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
            'avatar' => $this->whenLoaded('media', fn () => new MediaResource($this->getFirstMedia('avatar'))),
            'role' => $this->whenLoaded('roles', fn () => $this->roles),
            'wallet' => $this->whenLoaded('wallet', fn () => [
                'id' => $this->wallet->id,
                'total' => $this->wallet->total,
                'pending' => $this->wallet->pending,
                'available' => $this->wallet->available,
            ]),
            'coach' => $this->whenLoaded('coach', fn () => [
                'id' => $this->coach->id,
                'name' => $this->coach->name,
            ]),
            'description' => $this->description,
        ];
    }
}

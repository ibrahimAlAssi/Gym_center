<?php

namespace App\Src\Coach\Entities\Resources;

use App\Src\Shared\Resources\MediaResource;
use App\Src\Shared\Resources\NotificationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoachResource extends JsonResource
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
            'role' => $this->whenLoaded('roles', fn () => $this->roles),
            'wallet' => $this->whenLoaded('wallet', fn () => [
                'id' => $this->wallet->id,
                'total' => $this->wallet->pending + $this->wallet->available,
                'pending' => $this->wallet->pending,
                'available' => $this->wallet->available,
            ]),
            'avatar' => $this->whenLoaded('media', fn () => new MediaResource($this->getFirstMedia('coaches'))),
            'notifications' => NotificationResource::collection($this->unreadNotifications),
        ];
    }
}

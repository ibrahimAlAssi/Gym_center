<?php

namespace App\Src\Admin\Entities\Resources;

use Illuminate\Http\Request;
use App\Src\Shared\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Src\Shared\Resources\NotificationResource;

class AdminResource extends JsonResource
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
            'avatar' => $this->whenLoaded('media', fn () => new MediaResource($this->getFirstMedia('admins'))),
            'role' => $this->whenLoaded('roles', fn () => $this->roles),
            'description' => $this->description,
            "notifications" => NotificationResource::collection($this->unreadNotifications),
        ];
    }
}

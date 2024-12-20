<?php

namespace App\Src\Coach\Entities\Resources;

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
            'birthday' => $this->birthday->format('Y-m-d'),
            'avatar' => $this->whenLoaded('media', fn () => new MediaResource($this->getFirstMedia('avatar'))),
            'role' => $this->whenLoaded('roles', fn () => $this->roles),
        ];
    }
}

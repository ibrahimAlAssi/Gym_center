<?php

namespace App\Src\Admin\Entities\Resources;

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
            'coach' => $this->whenLoaded('coach', fn () => [
                'id' => $this->coach->id,
                'name' => $this->coach->name,
            ]),
            'wallet' => $this->whenLoaded('wallet', fn () => [
                'id' => $this->wallet->id,
                'total' => $this->wallet->total,
                'pending' => $this->wallet->pending,
                'available' => $this->wallet->available,
            ]),
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
        ];
    }
}

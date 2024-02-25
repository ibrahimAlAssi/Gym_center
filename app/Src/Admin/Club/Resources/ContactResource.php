<?php

namespace App\Src\Admin\Club\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            'gym' => [
                'id' => $this->gym_id,
                'name' => $this->whenLoaded('gym', fn () => $this->gym->name),
            ],
            'platform' => $this->platform,
            'contact' => $this->contact,
        ];
    }
}

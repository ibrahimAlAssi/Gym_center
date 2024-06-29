<?php

namespace App\Src\Player\Club\Controllers\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DietFoodResource extends JsonResource
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
            'allowed' => $this->when($this->pivot['allowed'] != null,
                fn () => (bool) $this->pivot['allowed']),
        ];
    }
}

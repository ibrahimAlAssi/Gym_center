<?php

namespace App\Src\Admin\Club\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DietGridResource extends JsonResource
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
            'is_free' => $this->is_free,
            'created_at' => $this->created_at,
            'foods' => DietFoodResource::collection($this->whenLoaded('foods')),
        ];
    }
}

<?php

namespace App\Src\Admin\Club\Resources;

use Illuminate\Http\Request;
use App\Src\Shared\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodGridResource extends JsonResource
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
            'image' => $this->whenLoaded('media', fn () => new MediaResource($this->getFirstMedia('foods'))),
            'nutritionalValues' => $this->whenLoaded('nutritionalValues', fn () => NutritionalValues::collection($this->nutritionalValues)),
        ];
    }
}

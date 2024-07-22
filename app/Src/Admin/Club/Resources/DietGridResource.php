<?php

namespace App\Src\Admin\Club\Resources;

use App\Src\Shared\Resources\MediaResource;
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
            'image' => $this->whenLoaded('media', fn () => new MediaResource($this->getFirstMedia('diet'))),
            'allowedFoodsList' => DietFoodResource::collection($this->whenLoaded('allowedFoods')),
            'notAllowedFoodsList' => DietFoodResource::collection($this->whenLoaded('notAllowedFoods')),
        ];
    }
}

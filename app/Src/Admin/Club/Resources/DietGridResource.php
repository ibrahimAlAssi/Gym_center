<?php

namespace App\Src\Admin\Club\Resources;

use Illuminate\Http\Request;
use App\Src\Shared\Resources\MediaResource;
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
            'id'         => $this->id,
            'name'       => $this->name,
            'is_free'    => $this->is_free,
            'allowedFoodsList'      => DietFoodResource::collection($this->allowedFoodsList),
            'notAllowedFoodsList'   => DietFoodResource::collection($this->notAllowedFoodsList),
            'image' => $this->whenLoaded('media', fn () => new MediaResource($this->getFirstMedia('products'))),
        ];
    }
}

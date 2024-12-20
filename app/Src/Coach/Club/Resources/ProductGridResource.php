<?php

namespace App\Src\Coach\Club\Resources;

use App\Src\Shared\Resources\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductGridResource extends JsonResource
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
            'price' => $this->price,
            'brand' => $this->brand,
            'image' => $this->whenLoaded('media', fn () => new MediaResource($this->getFirstMedia('products'))),
        ];
    }
}

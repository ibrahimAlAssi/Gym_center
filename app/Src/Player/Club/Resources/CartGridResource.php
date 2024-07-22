<?php

namespace App\Src\Player\Club\Resources;

use App\Src\Shared\Resources\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartGridResource extends JsonResource
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
            'product' => $this->whenLoaded('product', fn () => [
                'id' => $this->product->id,
                'name' => $this->product->name,
                'price' => $this->product->price,
                'brand' => $this->product->brand,
                'image' => $this->when(
                    $this->product->relationLoaded('media'), new MediaResource($this->product->getFirstMedia('products'))),
            ]),
            'quantity' => $this->quantity,
        ];
    }
}

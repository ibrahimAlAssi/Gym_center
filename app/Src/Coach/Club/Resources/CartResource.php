<?php

namespace App\Src\Coach\Club\Resources;

use App\Src\Shared\Resources\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
                'image' => $this->when(
                    $this->product->relationLoaded('media'), new MediaResource($this->product->getFirstMedia('products'))),
            ]),
            'quantity' => $this->quantity,
        ];
    }
}

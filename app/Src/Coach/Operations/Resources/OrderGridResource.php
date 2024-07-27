<?php

namespace App\Src\Coach\Operations\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderGridResource extends JsonResource
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
            'Details' => OrderDetailResource::collection($this->whenLoaded('orderDetails')),
        ];
    }
}

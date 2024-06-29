<?php

namespace App\Src\Player\Club\Controllers\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDietGridResource extends JsonResource
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
            'description' => $this->description,
            'status' => $this->status,
            'diet' => $this->when($this->diet_id != null, fn () => [
                'id' => $this->diet_id,
                'name' => $this->diet_name,
            ]),
        ];
    }
}

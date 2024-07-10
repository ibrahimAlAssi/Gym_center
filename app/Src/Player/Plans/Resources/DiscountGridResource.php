<?php

namespace App\Src\Player\Plans\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscountGridResource extends JsonResource
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
            'start_date' => $this->start_date->format('Y-m-d'),
            'end_date' => $this->end_date->format('Y-m-d'),
            'value' => $this->value,
            'plan' => $this->when($this->plan_id != null, fn () => [
                'id' => $this->plan_id,
                'name' => $this->plan_name,
            ]),
        ];
    }
}

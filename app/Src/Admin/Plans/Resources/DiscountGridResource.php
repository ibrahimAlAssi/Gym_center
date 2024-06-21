<?php

namespace App\Src\Admin\Plans\Resources;

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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'value' => $this->value,
            'plan' => $this->when($this->plan_id != null, fn () => [
                'id' => $this->plan_id,
                'name' => $this->plan_name,
            ]),
        ];
    }
}

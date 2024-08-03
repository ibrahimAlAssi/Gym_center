<?php

namespace App\Src\Coach\Operations\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentGridResource extends JsonResource
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
            'total' => $this->total,
            'order_id' => $this->order_id,
            'subscription' => $this->when($this->plan_name != null, fn () => [
                'id' => $this->subscription_id,
                'plan' => [
                    'name' => $this->plan_name,
                    'cost' => $this->plan_cost,
                ],
            ]),
        ];
    }
}

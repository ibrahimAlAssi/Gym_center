<?php

namespace App\Src\Admin\Entities\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayerGridResource extends JsonResource
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
            'diet_id' => $this->diet_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'coach' => $this->when($this->coach_id != null, fn () => [
                'id' => $this->coach_id,
                'name' => $this->coach_name,
            ]),
            'wallet' => $this->when($this->wallet_id != null, fn () => [
                'id' => $this->wallet_id,
                'total' => $this->total,
                'pending' => $this->pending,
                'available' => $this->available,
            ]),
        ];
    }
}

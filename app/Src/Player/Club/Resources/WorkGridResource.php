<?php

namespace App\Src\Player\Club\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkGridResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            $this->day => [
                'man' => $this->man,
                'woman' => $this->woman,
            ],
        ];
    }
}

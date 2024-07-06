<?php

namespace App\Src\Admin\Entities\Resources;

use App\Src\Shared\Resources\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoachResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'specialization' => $this->specialization,
            'experienceYears' => $this->experienceYears,
            'subscribePrice' => $this->subscribePrice,
            'avatar' => $this->whenLoaded('media', fn () => new MediaResource($this->getFirstMedia('coaches'))),
            'description' => $this->description,
        ];
    }
}

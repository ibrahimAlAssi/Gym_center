<?php

namespace App\Src\Player\Entities\Resources;

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
            'total_trainers' => $this->when($this->total_trainers != null, $this->total_trainers, 0),
            'avatar' => $this->whenLoaded('media', fn () => new MediaResource($this->getFirstMedia('coaches'))),
            'description' => $this->description,
        ];
    }
}

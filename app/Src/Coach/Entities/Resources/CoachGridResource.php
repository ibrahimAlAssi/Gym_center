<?php

namespace App\Src\Coach\Entities\Resources;

use App\Src\Shared\Resources\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoachGridResource extends JsonResource
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
            'specialization'  => $this->when($this->specialization, $this->specialization),
            'experienceYears' => $this->when($this->experienceYears != null, $this->experienceYears),
            'subscribePrice' => $this->when($this->subscribePrice != null, $this->subscribePrice),
            'total_trainers' => $this->total_trainers,
            'avatar' => $this->whenLoaded('media', fn () => new MediaResource($this->getFirstMedia('coaches'))),
        ];
    }
}

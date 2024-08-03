<?php

namespace App\Src\Player\Entities\Resources;

use Illuminate\Http\Request;
use App\Src\Shared\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Src\Shared\Resources\NotificationResource;
use function App\Src\Shared\getActiveSubscription;

class PlayerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $active_subscription = getActiveSubscription($this->id);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'avatar' => $this->whenLoaded('media', fn () => new MediaResource($this->getFirstMedia('avatar'))),
            'role' => $this->whenLoaded('roles', fn () => $this->roles),
            "notifications" => NotificationResource::collection($this->unreadNotifications),
            'wallet' => $this->whenLoaded('wallet', fn () => [
                'id' => $this->wallet->id,
                'total' => $this->wallet->total,
                'pending' => $this->wallet->pending,
                'available' => $this->wallet->available,
            ]),
            'coach' => $this->whenLoaded('coach', fn () => [
                'id' => $this->coach->id,
                'name' => $this->coach->name,
            ]),
            'subscription' => $this->when(!empty($active_subscription), [
                'active_plan' => $active_subscription?->plan->name,
                'end_date'    => $active_subscription?->end_date,
            ]),
        ];
    }
}

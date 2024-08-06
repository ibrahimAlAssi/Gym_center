<?php

namespace App\Http\Middleware;

use App\Src\Shared\Traits\ApiResponseHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use function App\Src\Shared\getActiveSubscription;

class CheckSubscription
{
    use ApiResponseHelper;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the authenticated user
        $user = Auth::guard('player')->user();

        // Check if user is authenticated
        if ($user) {
            // Assuming you have a 'subscription_end' column in your users table
            $subscriptionEnd = getActiveSubscription($user->id);

            // Check if the subscription end date is greater than now
            if ($subscriptionEnd) {
                return $next($request);
            } else {
                // Log the user out if subscription is expired
                // $user->currentAccessToken()->delete();

                return $this->customResponse(
                    __('shared.response_messages.you need to subscribe in new plan'),
                    499
                );
            }
        }

        return $next($request);
    }
}

<?php

namespace App\Policies;

use Illuminate\Foundation\Auth\User;

class FeedbackPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->is_super_admin == 1;
    }
}

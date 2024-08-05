<?php

namespace App\Policies;

use Illuminate\Foundation\Auth\User;

class ProductPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->is_super_admin == 1;
    }
}

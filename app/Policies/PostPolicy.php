<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

    public function viewAny(User $user)
    {
        return $user->hasRole("blogs writer") && $user->hasPermissionTo("blogsView");
    }
}

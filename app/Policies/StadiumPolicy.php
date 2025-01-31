<?php

namespace App\Policies;

use App\Models\Stadium;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StadiumPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Stadium $stadium): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    
     public function update(User $user, Stadium $stadium)
{
    return $user->id === $stadium->user_id || $user->isAdmin();
}

public function delete(User $user, Stadium $stadium)
{
    return $user->id === $stadium->user_id || $user->isAdmin();
}
    

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Stadium $stadium): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Stadium $stadium): bool
    {
        return false;
    }
}

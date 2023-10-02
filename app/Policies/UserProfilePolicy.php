<?php

namespace App\Policies;

use App\Models\Role;
use Illuminate\Auth\Access\Response;
use App\Models\UserProfile;
use App\Models\User;

class UserProfilePolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role_id, [Role::CANDIDATE, Role::ADMIN]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UserProfile $userProfile): bool
    {
        return $user->id == $userProfile->user_id || $user->role_id == Role::ADMIN;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UserProfile $userProfile): bool
    {
        return $user->id == $userProfile->user_id || $user->role_id == Role::ADMIN;
    }

}

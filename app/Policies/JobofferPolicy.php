<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Joboffer;
use App\Models\Role;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;

use function PHPUnit\Framework\isNull;

class JobofferPolicy
{

    /**
     * Determine whether the user can view models.
     */
    public function view(?User $user, Joboffer $joboffer): bool
    {
        if(!$user){
            return true;
        }else{
            return $user?->company_id == $joboffer->company_id || in_array($user?->role_id, [Role::ADMIN, Role::CANDIDATE]);
        }
        // return true;
        
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {

        // return in_array($user->role_id,  [Role::EMPLOYER, Role::ADMIN]);
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Joboffer $joboffer): bool
    {
        return $user->company_id == $joboffer->company_id || $user->role_id == Role::ADMIN;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Joboffer $joboffer): bool
    {
        return $user->company_id == $joboffer->company_id || $user->role_id == Role::ADMIN;
    }

    /**
     * Determine whether the candidate can request their joboffers.
     */
    public function candidate(User $user): bool
    {
        return $user->role_id == Role::CANDIDATE;
    }

    /**
     * Determine whether the candidate can request their invites.
     */
    public function candidate_invites(User $user): bool
    {

        return $user->role_id == Role::CANDIDATE;
    }

    /**
     * Determine whether the user can apply for the joboffer
     */
    public function apply(User $user)
    {
        return $user->role_id == Role::CANDIDATE;
    }

    /**
     * Determine whether the user can apply for the joboffer
     */
    public function accept(User $user)
    {
        return $user->role_id == Role::EMPLOYER;
    }

    /**
     * Determine whether the user can get all candidates
     */
    public function get_candidates(User $user)
    {
        // Debugbar::addMessage('test');
        // return in_array($user->role_id,  [Role::EMPLOYER, Role::ADMIN]);
        return true;
    }
}

<?php

namespace App\Policies;

use App\Models\Resource;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ResourcePolicy{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool{
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Resource $resource): bool{
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool{
        return false;
    }

    /**
     * Determine if the given resource can be updated by the user.
     *
     * @param User $user
     * @param Resource $resource
     * @return bool
     */
    public function update(User $user, Resource $resource): bool{
        return $user->id === $resource->user_id;
    }

    /**
     * Determine if the given resource can be deleted by the user.
     *
     * @param User $user
     * @param Resource $resource
     * @return bool
     */
    public function delete(User $user, Resource $resource): bool{
        return $user->id === $resource->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Resource $resource): bool{
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Resource $resource): bool{
        return false;
    }
}

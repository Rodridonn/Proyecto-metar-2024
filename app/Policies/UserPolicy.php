<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class UserPolicy
{
    use HandlesAuthorization;

    public function view(User $user, User $model)
    {
        // return true if the user is allowed to view other users
        return true;
    }

    public function edit(User $user, User $model)
    {
        // return true if the user is allowed to edit other users
        return true;
    }

    public function delete(User $user, User $model)
    {
        // return true if the user is allowed to delete other users
        return true;
    }
}

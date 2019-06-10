<?php

namespace Khall\Chat;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
    }

    public function talkTo(User $user, User $to)
    {
        return $user->id !== $to->id;
    }
}

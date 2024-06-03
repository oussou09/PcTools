<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    public function view(User $authenticatedUser, User $user): bool
    {
        return $authenticatedUser->id === $user->id;
    }

    public function create(): bool
    {
        return true;
    }

    public function update(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }
}

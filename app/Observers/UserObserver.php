<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Definir a reputação antes de criar o usuário
     *
     * @param User $user
     * @return void
     */
    public function creating(User $user): void
    {
        if (User::count() === 0) {
            $user->reputacao = 5;
            return;
        }

        $user->reputacao = User::avg('reputacao');
    }
}

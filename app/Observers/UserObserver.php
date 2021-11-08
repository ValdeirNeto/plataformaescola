<?php

namespace App\Observers;

use App\User;
use App\Helpers\LoggerHelper;

class UserObserver
{
    /**
     * Nome da tabela do log.
     *
     * @var string
     */
    private $source = 'USER';

    /**
     * Metodo de callback que e executado após criar um usuário.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user)
    {
        $userData = $user->toArray();
        LoggerHelper::write($this->source, LoggerHelper::ACTION_CREATE, $userData);
    }

    /**
     * Metodo de callback que e executado antes de fazer o update do usuário.
     *
     * @param User $user
     * @return void
     */
    public function updating(User $user)
    {
        $oldData = $user->getRawOriginal();
        $newData = $user->toArray();
        LoggerHelper::write($this->source, LoggerHelper::ACTION_EDITION, $newData, $oldData);
    }
}

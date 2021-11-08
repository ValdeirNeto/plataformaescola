<?php

namespace App\Observers;

use App\Turma;
use App\Helpers\LoggerHelper;

class TurmaObserver
{
    /**
     * Nome da tabela do log.
     *
     * @var string
     */
    private $source = 'CLASS';

    /**
     * Metodo de callback que e executado após criar uma turma.
     *
     * @param Turma $class
     * @return void
     */
    public function created(Turma $class)
    {
        $classData = $class->toArray();
        LoggerHelper::write($this->source, LoggerHelper::ACTION_CREATE, $classData);
    }

    /**
     * Metodo de callback que e executado antes de fazer o update de uma turma.
     *
     * @param User $user
     * @return void
     */
    public function updating(Turma $classData)
    {
        $oldData = $classData->getRawOriginal();
        $newData = $classData->toArray();
        LoggerHelper::write($this->source, LoggerHelper::ACTION_EDITION, $newData, $oldData);
    }
}

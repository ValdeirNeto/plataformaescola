<?php

namespace App\Observers;

use App\Aluno;
use App\Helpers\LoggerHelper;

class AlunoObserver
{
    /**
     * Nome da tabela do log.
     *
     * @var string
     */ 
    private $source = 'STUDENT';

    /**
     * Metodo de callback que e executado após criar um aluno.
     *
     * @param Aluno $student
     * @return void
     */
    public function created(Aluno $student)
    {
        $studentData = $student->toArray();
        LoggerHelper::write($this->source, LoggerHelper::ACTION_CREATE, $studentData);
    }

    /**
     * Metodo de callback que e executado antes de fazer o update de um aluno.
     *
     * @param User $user
     * @return void
     */
    public function updating(Aluno $student)
    {
        $oldData = $student->getRawOriginal();
        $newData = $student->toArray();
        LoggerHelper::write($this->source, LoggerHelper::ACTION_EDITION, $newData, $oldData);
    }
}

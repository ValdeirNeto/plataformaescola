<?php

namespace App\Observers;

use App\Professor;
use App\Helpers\LoggerHelper;

class ProfessorObserver
{
    /**
     * Nome da tabela do log.
     *
     * @var string
     */
    private $source = 'TEACHER';

     /**
     * Metodo de callback que e executado após criar um professor.
     *
     * @param Professor $teacher
     * @return void
     */
    public function created(Professor $teacher)
    {
        $teacherData = $teacher->toArray();
        LoggerHelper::write($this->source, LoggerHelper::ACTION_CREATE, $teacherData);
    }

    /**
     * Metodo de callback que e executado antes de fazer o update de um professor.
     *
     * @param User $user
     * @return void
     */
    public function updating(Professor $teacher)
    {
        $oldData = $teacher->getRawOriginal();
        $newData = $teacher->toArray();
        LoggerHelper::write($this->source, LoggerHelper::ACTION_EDITION, $newData, $oldData);
    }
}

<?php

namespace App\Observers;

use App\Escola;
use App\Helpers\LoggerHelper;

class EscolaObserver
{
    /**
     * Nome da tabela do log.
     *
     * @var string
     */
    private $source = 'SCHOOL';

    /**
     * Metodo de callback que e executado após criar uma escola.
     *
     * @param Escola $school
     * @return void
     */
    public function created(Escola $school)
    {
        $schoolData = $school->toArray();
        LoggerHelper::write($this->source, LoggerHelper::ACTION_CREATE, $schoolData);
    }

    /**
     * Metodo de callback que e executado antes de fazer o update de uma escola.
     *
     * @param User $user
     * @return void
     */
    public function updating(Escola $school)
    {
        $oldData = $school->getRawOriginal();
        $newData = $school->toArray();
        LoggerHelper::write($this->source, LoggerHelper::ACTION_EDITION, $newData, $oldData);
    }
}

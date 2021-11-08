<?php

namespace App\Observers;

use App\Comunicado;
use App\Helpers\LoggerHelper;

class ComunicadoObserver
{
    /**
     * Nome da tabela do log.
     *
     * @var string
     */    
    private $source = 'COMMUNICATION';

    /**
     * Metodo de callback que e executado após criar um comunicado.
     *
     * @param Comunicado $communication
     * @return void
     */
    public function created(Comunicado $communication)
    {
        $communicationData = $communication->toArray();
        LoggerHelper::write($this->source, LoggerHelper::ACTION_CREATE, $communicationData);
    }

    /**
     * Metodo de callback que e executado antes de fazer o update de um comunicado.
     *
     * @param User $user
     * @return void
     */
    public function updating(Comunicado $communication)
    {
        $oldData = $communication->getRawOriginal();
        $newData = $communication->toArray();
        LoggerHelper::write($this->source, LoggerHelper::ACTION_EDITION, $newData, $oldData);
    }
}

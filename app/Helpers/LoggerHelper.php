<?php

namespace App\Helpers;
use App\Log;
use App\Helpers\Funcoes;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoggerHelper
{   
    /**
    * Ação de edição
    *
    * @var string
    */ 
    public const ACTION_EDITION = 'edition';

    /**
    * Ação de criação
    *
    * @var string
    */
    public const ACTION_CREATE = 'create';

    /**
    * Ação exclusão
    *
    * @var string
    */    
    public const ACTION_DELETE = 'delete';

    /**
    * Ação de aula ao vivo.
    *
    * @var string
    */    
    public const ACTION_LIVE = 'live class';

    /**
     * Metodo para gravação de logs.
     *
     * @param String $source
     * @param String $action
     * @param array $newData
     * @param array $oldData
     * @return void
     */
    public static function write(String $source, String $action, array $newData = [], array $oldData = [])
    {
        $userData = UserHelper::getLoggedUserData();
        Log::create([
            'name'          => $userData['name'],
            'email'         => $userData['email'],
            'type'          => $source,
            'action'        => $action,
            'date'          => date('Y-m-d H:i:s'),
            'before_action' => empty($oldData) ? '': json_encode($oldData),
            'after_action'  => json_encode($newData)
        ]);
    }

    /**
     * Metodo que retorna todos os logs.
     *
     * @return Log
     */
    public static function read()
    {
        return Log::all();
    }
}
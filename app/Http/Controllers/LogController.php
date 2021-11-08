<?php

namespace App\Http\Controllers;

use App\Helpers\{Funcoes,LoggerHelper};


class LogController extends Controller
{
    public function index()
    {
        $log = LoggerHelper::read();
        $isMobile = Funcoes::isMobile();
        return view('log.log', compact('log','isMobile'));
    }
 
}

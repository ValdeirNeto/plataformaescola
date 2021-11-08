<?php

namespace App\Http\Controllers;

use App\Helpers\LoggerHelper;
use App\User;
use App\Turma;
use App\TurmaAluno;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    /**
     * Rota aula ao vivo.
     *
     * @param integer $id
     * @return Aula
     */
    public function aula(int $id){
        $classe_nome = $this->getClassName($id);
        $classData = ["Class Name" => $classe_nome];
        $this->writeLog($classData);
        return view('atividade.aula', ['classe_nome' => $classe_nome]);
    }

    /**
     * Metodo que retorna o nome da sala de aula.
     *
     * @param integer $idUser
     * @return string Nome da sala
     */
    private function getClassName(int $idUser)
    {
        $user = User::where('id', $idUser)->get();
        if ($user[0]->permissao == 'aluno') {
            $studentClass = TurmaAluno::where('aluno_id', $user[0]->id)->get();
            $class = Turma::where('id', $studentClass[0]->turma_id)->get();
            return "Sala de aula do {$class[0]->descricao}";
        }

        if ($user[0]->permissao == 'professor') {
            $class = Turma::where('professor_id', $user[0]->id)->get();
            return "Sala de aula do {$class[0]->descricao}";
        }

        return "Sala de Reunião";
    }

    /**
     * Grava log da aula ao vivo.
     *
     * @param array $classData
     * @return void
     */
    private function writeLog(array $classData)
    {
        LoggerHelper::write("LIVE CLASS", LoggerHelper::ACTION_LIVE, $classData);
    }
}

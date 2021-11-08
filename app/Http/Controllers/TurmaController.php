<?php

namespace App\Http\Controllers;

use App\User;
use App\Turma;
use App\TurmaAluno;
use App\Helpers\Funcoes;
use Illuminate\Http\Request;
use App\Http\Requests\TurmaFormRequest;

class TurmaController extends Controller
{
    public function index()
    {
        $turmafinal = null;
        $turmas = Turma::all();
        foreach($turmas as $turma){
            $professor = User::where('id', $turma->professor_id)->get();
            $turmafinal[] = [
                'id'        => $turma->id,
                'descricao' => $turma->descricao,
                'horario'   => ($turma->horario == 'manha') ? 'Manhã': (($turma->horario == 'tarde') ? 'Tarde':'Noite'),
                'professor' =>  $professor[0]->name
            ];
        }
        $isMobile = Funcoes::isMobile();
        return view('turma.listturma', ['turmas' => $turmafinal, 'isMobile'=>$isMobile]);
    }

    public function formAdd()
    {
        $local = 'Incluir';
        $professor = User::where('permissao', 'professor')->get();
        return view('turma.formturma', ['local' => $local, 'professores' => $professor]);
    }

    public function formEdit($id)
    {
        $local = 'Editar';
        $turma = Turma::where('id', $id)->get();
        $professor = User::where('permissao', 'professor')->get();
        return view('turma.formturma', ['turma' => $turma, 'local' => $local,  'professores' => $professor]);
    }

    public function create(TurmaFormRequest $request)
    {
        dd($request);
        $turma = new Turma;
        $turma->descricao    = $request->descricao;
        $turma->horario      = $request->horario;
        $turma->professor_id = $request->professor; 

        $turma->save();

        return redirect('turma')->with('mensagem', 'Turma cadastrada com sucesso!')->with('icon', 'success'); 
    } 

    public function edit(TurmaFormRequest $request)
    {
        $turma = Turma::find($request->id);
        $turma->descricao    = $request->descricao;
        $turma->horario      = $request->horario;
        $turma->professor_id = $request->professor; 

        $turma->save();
        return redirect('turma')->with('mensagem', 'Turma editada com sucesso!')->with('icon', 'success'); 
    } 

    public function delete($id)
    {
        Turma::where('id', $id)->delete();
        return redirect('turma')->with('mensagem', 'Turma excluida com sucesso!')->with('icon', 'success'); 
    }
    
    public function alunoporturma($id)
    {
        $alunodisponivel=null;
        $alunos = User::where('permissao', 'aluno')->get();
        foreach($alunos as $aluno){
            $turmaaluno = TurmaAluno::where('aluno_id', $aluno->id)->get();
            if(!isset($turmaaluno[0]->aluno_id)){
                $alunodisponivel[] = [
                    'id' => $aluno->id,
                    'name' =>$aluno->name
                ];
            }
        }
        $turma = Turma::where('id', $id)->get();
        return view('turma.alunoporturma', ['turma' => $turma, 'alunos' => $alunodisponivel]);
    } 

    public function alunoporturmacreate(Request $request)
    {
        $turmaaluno = $request->aluno;
        for($i =0;$i<count($turmaaluno);$i++ ){
            $turmaalunocreate = new TurmaAluno;
            $turmaalunocreate->aluno_id = $turmaaluno[$i];
            $turmaalunocreate->turma_id = $request->id; 
            $turmaalunocreate->save();
        }
        return redirect('turma')->with('mensagem', 'Aluno vinculado com sucesso!')->with('icon', 'success'); 
    }
}

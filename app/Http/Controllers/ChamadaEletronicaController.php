<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Turma;
use App\TurmaAluno;
use App\User;
use App\Aluno;
use App\Chamada;
use App\Helpers\Funcoes;

class ChamadaEletronicaController extends Controller
{
    public function index()
    {
        $turmafinal = null;
        $permissao = \Auth::user()->permissao;
        $id_user = \Auth::user()->id;
        if($permissao === 'professor'){
            $turmas = Turma::where('professor_id', $id_user)->get();
            foreach($turmas as $turma){
                $turmafinal[] = [
                    'id'        => $turma->id,
                    'descricao' => $turma->descricao,
                    'horario'   => $turma->horario,
                ];
            }

        }elseif(in_array($permissao, ['coordenador', 'admin'])){
            $turmas = Turma::all();
            foreach($turmas as $turma){
                $professor = User::where('id', $turma->professor_id)->get();
                $turmafinal[] = [
                    'id'        => $turma->id,
                    'descricao' => $turma->descricao,
                    'horario'   => $turma->horario,
                    'professor' =>  $professor[0]->name
                ];
            }
        }
        $isMobile = Funcoes::isMobile();
        return view('chamada_eletronica.listturma', ['turmas' => $turmafinal, 'isMobile'=> $isMobile]);
    }

    public function formchamada($id)
    {
        $turmaaluno = TurmaAluno::where('turma_id', $id)->join('users','turma_aluno.aluno_id', '=', 'users.id')->orderBy('users.name', 'asc')->get();
        foreach($turmaaluno as $aluno){
            $alunoturma = User::where('id', $aluno->aluno_id)->get();
            $alunos[] = [
                'id' => $alunoturma[0]->id,
                'name' =>$alunoturma[0]->name
            ];
        }
        $turma = Turma::where('id', $id)->get();
        return view('chamada_eletronica.chamada_eletronica', ['turma' => $turma, 'alunos' => $alunos]);
    } 

    public function visualizarchamada($id)
    {
        $chamada = Chamada::where('turma_id', $id)->get();
        $turma = Turma::where('id', $id)->get();
    
        return view('chamada_eletronica.chamada_eletronicavisualizar', ['turma' => $turma, 'chamada_data' => $chamada]);
    } 

    public function visualizarchamadapost($id, Request $request)
    {
        $chamada_data = Chamada::where('turma_id', $id)->get();
        $turmaaluno = TurmaAluno::where('turma_id', $id)->get();
        $chamada = Chamada::where('turma_id', $id)->where('id', $request->data_chamada)->get();
        $chamada->alunos_presentes = explode(';', $chamada[0]->alunos_presentes);

        foreach($turmaaluno as $aluno){

            $alunoturma = User::where('id', $aluno->aluno_id)->get();

            if(in_array($aluno->aluno_id, $chamada->alunos_presentes)){
                $alunos[] = [
                    'id' => $alunoturma[0]->id,
                    'name' =>$alunoturma[0]->name,
                    'presente' => true
                ];
            }else{
                $alunos[] = [
                    'id' => $alunoturma[0]->id,
                    'name' =>$alunoturma[0]->name,
                    'presente' => false
                ];
            }
        }
        $turma = Turma::where('id', $id)->get();
       
        return view('chamada_eletronica.chamada_eletronicavisualizar', ['turma' => $turma, 'chamada' => $chamada, 'alunos' => $alunos, 'chamada_data' => $chamada_data, 'data_filtro' => $request->data_chamada]);
    } 

    public function chamadaadd(Request $request)
    {
        $chamada = new Chamada;
        $chamada->alunos_presentes = implode(';', $request->aluno);
        $chamada->data_chamada = $request->data_chamada;
        $chamada->turma_id = $request->turma;
        $chamada->diario = $request->diario;
        $chamada->save();

        return redirect('chamada_eletronica')->with('mensagem', 'Chamada realizada com sucesso!')->with('icon', 'success');
    }
}

<?php

namespace App\Http\Controllers;

use App\{Aluno, User};
use App\Helpers\{Funcoes,UserHelper};
use Illuminate\Http\Request;
use App\Http\Requests\AlunoFormRequest;
use Illuminate\Support\Facades\Crypt;

class AlunoController extends Controller
{
    public function index()
    {
        $aluno_new = Aluno::all();
        foreach($aluno_new as $aluno){
            $user = User::where('name', '=', $aluno->nome)->get(['email']);
            foreach($user as $u){
                $alunos[] = [
                    'id' => $aluno->id,
                    'nome' => $aluno->nome,
                    'email' => $aluno->email,
                    'usuario' => $u->email
                ];
            }
            
        }
        $isMobile = Funcoes::isMobile();
        return view('aluno.listaluno', compact('alunos','isMobile'));
    }

    public function formAdd()
    {
        $local = 'Incluir';
        return view('aluno.formaluno', ['local' => $local]);
    }

    public function formEdit($id)
    {
        $local = 'Editar';
        if(\Auth::user()->permissao != 'aluno'){
            $aluno = Aluno::where('id', $id)->get()->toArray();
            $data_nascimento = explode('-',$aluno[0]['data_nascimento']);
            $aluno[0]['data_nascimento'] = $data_nascimento[2] ."/".$data_nascimento[1] ."/".$data_nascimento[0];
            $aluno[0]['password'] = '';
        }else{
            $user = User::where('id', $id)->get()->toArray();
            $aluno = Aluno::where('nome', $user[0]['name'])->get()->toArray();
            $data_nascimento = explode('-',$aluno[0]['data_nascimento']);
            $aluno[0]['data_nascimento'] = $data_nascimento[2] ."/".$data_nascimento[1] ."/".$data_nascimento[0];
            $aluno[0]['password'] = '';
        }
        
        return view('aluno.formaluno', compact('aluno','local'));
    }

    public function create(AlunoFormRequest $request)
    {
        UserHelper::createUser($request, 'aluno');
        $this->createStudent($request);

        return redirect('aluno')->with('mensagem', 'Aluno cadastrado com sucesso!')->with('icon', 'success'); 
    }

    public function edit(AlunoFormRequest $request)
    {
        UserHelper::editUser($request);
        $this->editStudent($request);
        return redirect('aluno')->with('mensagem', 'Aluno alterado com sucesso!')->with('icon', 'success'); 
    }

    public function createStudent(Request $request)
    {
        $aluno = new Aluno();
        $data_nascimento             = explode('/',$request->data_nascimento);
        $aluno->nome                 = $request->nome;
        $aluno->nome_social          = $request->nome_social;
        $aluno->data_nascimento      = $data_nascimento[2] ."-".$data_nascimento[1] ."-".$data_nascimento[0];
        $aluno->email                = $request->email;
        $aluno->cpf                  = $request->cpf;
        $aluno->rg                   = $request->rg;
        $aluno->telefone             = $request->telefone;
        $aluno->celular              = $request->celular;
        $aluno->genero               = $request->genero;
        $aluno->cep                  = $request->cep;
        $aluno->rua                  = $request->rua;
        $aluno->numero               = $request->numero;
        $aluno->cidade               = $request->cidade;
        $aluno->estado               = $request->estado;
        $aluno->nome_mae             = $request->nome_mae;
        $aluno->email_mae            = $request->email_mae;
        $aluno->cpf_mae              = $request->cpf_mae;
        $aluno->rg_mae               = $request->rg_mae;
        $aluno->nome_pai             = $request->nome_pai;
        $aluno->email_pai            = $request->email_pai;
        $aluno->cpf_pai              = $request->cpf_pai;
        $aluno->rg_pai               = $request->rg_pai;
        $aluno->nome_responsavel     = $request->nome_responsavel;
        $aluno->email_responsavel    = $request->email_responsavel;
        $aluno->cpf_responsavel      = $request->cpf_responsavel;
        $aluno->rg_responsavel       = $request->rg_responsavel;
        $aluno->observacao           = $request->observacao;
        $aluno->foto                 = $request->foto;
        $aluno->telefone_pai         = $request->telefone_pai;
        $aluno->telefone_mae         = $request->telefone_mae;
        $aluno->telefone_responsavel = $request->telefone_responsavel;
        $aluno->celular_pai          = $request->celular_pai;
        $aluno->celular_mae          = $request->celular_mae;
        $aluno->celular_responsavel  = $request->celular_responsavel;
        $aluno->alergia              = $request->alergia; 
        $aluno->deficiencia          = $request->deficiencia;
        $aluno->ra                   = $request->ra; 
        $aluno->data_cadastro     = date('Y-m-d H:i:s');
        $aluno->save();
    }

    public function editStudent(Request $request)
    {
        $aluno = Aluno::find($request->id);
        $data_nascimento             = explode('/',$request->data_nascimento);
        $aluno->nome                 = $request->nome;
        $aluno->nome_social          = $request->nome_social;
        $aluno->data_nascimento      = $data_nascimento[2] ."-".$data_nascimento[1] ."-".$data_nascimento[0];
        $aluno->email                = $request->email;
        $aluno->cpf                  = $request->cpf;
        $aluno->rg                   = $request->rg;
        $aluno->telefone             = $request->telefone;
        $aluno->celular              = $request->celular;
        $aluno->genero               = $request->genero;
        $aluno->cep                  = $request->cep;
        $aluno->rua                  = $request->rua;
        $aluno->numero               = $request->numero;
        $aluno->cidade               = $request->cidade;
        $aluno->estado               = $request->estado;
        $aluno->nome_mae             = $request->nome_mae;
        $aluno->email_mae            = $request->email_mae;
        $aluno->cpf_mae              = $request->cpf_mae;
        $aluno->rg_mae               = $request->rg_mae;
        $aluno->nome_pai             = $request->nome_pai;
        $aluno->email_pai            = $request->email_pai;
        $aluno->cpf_pai              = $request->cpf_pai;
        $aluno->rg_pai               = $request->rg_pai;
        $aluno->nome_responsavel     = $request->nome_responsavel;
        $aluno->email_responsavel    = $request->email_responsavel;
        $aluno->cpf_responsavel      = $request->cpf_responsavel;
        $aluno->rg_responsavel       = $request->rg_responsavel;
        $aluno->observacao           = $request->observacao;
        $aluno->foto                 = $request->url_foto;
        $aluno->telefone_pai         = $request->telefone_pai;
        $aluno->telefone_mae         = $request->telefone_mae;
        $aluno->telefone_responsavel = $request->telefone_responsavel;
        $aluno->celular_pai          = $request->celular_pai;
        $aluno->celular_mae          = $request->celular_mae;
        $aluno->celular_responsavel  = $request->celular_responsavel;        
        $aluno->alergia              = $request->alergia;
        $aluno->ra                   = $request->ra;
        $aluno->deficiencia          = $request->deficiencia;
        $aluno->push();
    }

    public function delete(int $id)
    {
        UserHelper::deleteUser($this->getEmailStudent($id));
        Aluno::where('id', $id)->delete();
        return redirect('aluno')->with('mensagem', 'Aluno excluido com sucesso!')->with('icon', 'success'); 
    }

    public function getEmailStudent(int $id)
    {
        $student = Aluno::find($id);
        return $student->email;
    }    

    public function getupload(){
        $local = 'Upload';
        return view('aluno.formupload', compact('local'));
    }

    public function postupload(Request $request){
        $retorno = Funcoes::carga_cadastro($request, 'aluno', 'arquivo');
        if(!$retorno['error']){
            return redirect('aluno')->with('mensagem', 'Upload de alunos realizado com sucesso!')->with('icon', 'success'); 
        }else{
            return redirect('aluno')->with('mensagem', 'Entre em contato com o administrador do sistema!')->with('icon', 'error'); 
        }
    }
}

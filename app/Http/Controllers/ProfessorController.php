<?php

namespace App\Http\Controllers;

use App\{Professor, User};
use App\Helpers\{Funcoes,UserHelper};
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\ProfessorFormRequest;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function index()
    {
        $professor = Professor::all();
        $isMobile = Funcoes::isMobile();
        return view('professor.listprofessor', compact('professor', 'isMobile'));
    }

    public function formAdd()
    {
        $local = 'Incluir';
        return view('professor.formprofessor', compact('local'));
    }

    public function formEdit($id)
    {
        $local = 'Editar';
        if(\Auth::user()->permissao != 'professor'){
            $professor = Professor::where('id', $id)->get()->toArray();
            $data_nascimento = explode('-',$professor[0]['data_nascimento']);
            $professor[0]['data_nascimento'] = $data_nascimento[2] ."/".$data_nascimento[1] ."/".$data_nascimento[0];
        }else{
            $user = User::where('id', $id)->get()->toArray();
            $professor = Professor::where('nome', $user[0]['name'])->get()->toArray();
            $data_nascimento = explode('-',$professor[0]['data_nascimento']);
            $professor[0]['data_nascimento'] = $data_nascimento[2] ."/".$data_nascimento[1] ."/".$data_nascimento[0];
        }
        return view('professor.formprofessor', compact('professor', 'local'));
    }

    public function create(ProfessorFormRequest $request)
    {        
        UserHelper::createUser($request, 'professor');
        $this->createTeacher($request);
        return redirect('professor')->with('mensagem', 'Professor cadastrado com sucesso!')->with('icon', 'success'); 
    }

    public function edit(ProfessorFormRequest $request)
    {
        UserHelper::editUser($request);
        $this->editTeacher($request);
        return redirect('professor')->with('mensagem', 'Professor atualizado com sucesso!')->with('icon', 'success'); 
    }     

    public function createTeacher($request)
    {
        $professor = new Professor();
        $data_nascimento            = explode('/',$request->data_nascimento);
        $professor->nome            = $request->nome;
        $professor->data_nascimento = $data_nascimento[2] ."-".$data_nascimento[1] ."-".$data_nascimento[0];
        $professor->email           = $request->email;
        $professor->cpf             = $request->cpf;
        $professor->rg              = $request->rg;
        $professor->telefone        = $request->telefone;
        $professor->celular         = $request->celular;
        $professor->genero          = $request->genero;
        $professor->cep             = $request->cep;
        $professor->rua             = $request->rua;
        $professor->numero          = $request->numero;
        $professor->cidade          = $request->cidade;
        $professor->estado          = $request->estado;
        $professor->foto            = $request->url_foto;
        $professor->data_cadastro       = date('Y-m-d H:i:s');

        $professor->save();
    }

    public function editTeacher(Request $request)
    {
        $professor = Professor::find($request->id);
        $data_nascimento            = explode('/',$request->data_nascimento);
        $professor->nome            = $request->nome;
        $professor->data_nascimento = $data_nascimento[2] ."-".$data_nascimento[1] ."-".$data_nascimento[0];
        $professor->email           = $request->email;
        $professor->cpf             = $request->cpf;
        $professor->rg              = $request->rg;
        $professor->telefone        = $request->telefone;
        $professor->celular         = $request->celular;
        $professor->genero          = $request->genero;
        $professor->cep             = $request->cep;
        $professor->rua             = $request->rua;
        $professor->numero          = $request->numero;
        $professor->cidade          = $request->cidade;
        $professor->estado          = $request->estado;
        $professor->foto            = $request->url_foto;
        
        $professor->push();
    }

    public function delete(int $id)
    {
        UserHelper::deleteUser($this->getEmailTeacher($id));
        Professor::where('id', $id)->delete();
        return redirect('professor')->with('mensagem', 'Professor removido com sucesso!')->with('icon', 'success'); 
    }

    public function getEmailTeacher(int $id)
    {
        $teacher = Professor::find($id);
        return $teacher->email;
    }

    public function getupload(){
        $local = 'Upload';
        return view('professor.formupload', compact('local'));
    }
    
    public function postupload(Request $request){
        $retorno = Funcoes::carga_cadastro($request, 'professor', 'arquivo');
        if(!$retorno['error']){
            return redirect('professor')->with('mensagem', 'Upload de professores realizado com sucesso!')->with('icon', 'success'); 
        }else{
            return redirect('professor')->with('mensagem', 'Entre em contato com o administrador do sistema!')->with('icon', 'error'); 
        }
    }
}

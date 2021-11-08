<?php

namespace App\Http\Controllers;

use App\Escola;
use Illuminate\Http\Request;
use App\Http\Requests\EscolaFormRequest;

class EscolaController extends Controller
{
    public function index()
    {
        $schools = Escola::all();
        $isMobile = false;
        return view('escola.listaescola', compact('schools', 'isMobile'));
    }

    public function add()
    {
        $local = 'Incluir';
        return view('escola.formescola', compact('local'));
    }

    public function edit(int $id)
    {
        $local = 'Editar';
        $school = Escola::where(['id' => $id])->get()->toArray();
        return view('escola.formescola', compact('local', 'school'));
    }    

    public function create(EscolaFormRequest $request)
    {
        $school = new Escola();
        $this->dataSave($school, $request);
        return redirect('escola/index')->with('mensagem', 'Escola cadastrada com sucesso!')->with('icon', 'success'); 
    }

    public function save(EscolaFormRequest $request)
    {
        $school = Escola::find($request->id);
        $this->dataSave($school, $request);
        return redirect('escola/index')->with('mensagem', 'Escola editada com sucesso!')->with('icon', 'success'); 
    }

    public function delete(int $id)
    {
        Escola::where('id', $id)->delete();
        return redirect('escola/index')->with('mensagem', 'Escola removida com sucesso!')->with('icon', 'success'); 
    }    

    private function dataSave(Escola $school, Request $request)
    {
        $school->nome = $request->nome;
        $school->cnpj = $request->cnpj;
        $school->cep = $request->cep;
        $school->rua = $request->rua;
        $school->numero = $request->numero;
        $school->cidade = $request->cidade;
        $school->estado = $request->estado;
        $school->situacao = $request->status;
        $school->save();
    }
}

<?php

namespace App\Http\Controllers;
use App\Comunicado;
use Illuminate\Http\Request;
use App\Helpers\Funcoes;

class ComunicadoController extends Controller
{
    public function index()
    {
        $comunicado = Comunicado::all();
        $isMobile = Funcoes::isMobile();
        return view('comunicado.listcomunicado', compact('comunicado','isMobile'));
    }

    public function formAdd()
    {
        $local = 'Incluir';
        return view('comunicado.formcomunicado', ['local' => $local]);
    }

    public function create(Request $request)
    {
        $comunicado = new Comunicado();
        $this->dataSave($comunicado, $request);
        return redirect('comunicado')->with('mensagem', 'Comunicado cadastrado com sucesso!')->with('icon', 'success'); 
    }

    public function formEdit($id)
    {
        $local = 'Editar';
        $comunicado = Comunicado::where('id', $id)->get()->toArray();
        return view('comunicado.formcomunicado', compact('comunicado','local'));
    }

    public function edit(Request $request)
    {
        $comunicado = Comunicado::find($request->id);
        $this->dataSave($comunicado, $request);
        return redirect('comunicado')->with('mensagem', 'Comunicado alterado com sucesso!')->with('icon', 'success');
    }

    public function delete(int $id)
    {
        Comunicado::where('id', $id)->delete();
        return redirect('comunicado')->with('mensagem', 'Comunicado excluido com sucesso!')->with('icon', 'success'); 
    }

    
    private function dataSave(Comunicado $comunicado, Request $request)
    {
        $comunicado->de = \Auth::user()->permissao;
        $comunicado->para = $request->para;
        $comunicado->mensagem = $request->mensagem;
        $comunicado->data_cadastro = new \DateTime();
        $comunicado->data_validade = $request->data_validade;
        $comunicado->save();
    }
}

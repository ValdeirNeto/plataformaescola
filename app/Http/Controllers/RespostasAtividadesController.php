<?php

namespace App\Http\Controllers;

use App\{AtividadeRespondida, Atividade, Pergunta, Resposta};
use App\Helpers\{Funcoes,UserHelper};
use Illuminate\Http\Request;
use App\Http\Requests\AlunoFormRequest;
use Illuminate\Support\Facades\Crypt;

class RespostasAtividadesController extends Controller
{
    public function index()
    {

    }

    public function save(Request $request)
    {
        $data = $this->handleData($request);
        $ids = $data[0]['idsPerguntas'];

        foreach ($ids as $id) {
            $respostaatividade = new AtividadeRespondida();

            $key = 'resposta_pergunta_'.$id;
            $pergunta = $data[0][$key];
            $respostaatividade->atividade_id = $request->atividade;
            $respostaatividade->pergunta_id = $id;
            $respostaatividade->usuario_id = $request->usuario;
            if(is_array($pergunta)){
                $respostaatividade->resposta_id  = $pergunta[0];
                $respostaaluno = $pergunta[0];
            }else{
                $respostaatividade->resposta_dissertativa  = $pergunta;
                $resposta_dissertativa = $pergunta;
            }

            $respostaatividade->save();
        }

        $atividades = Atividade::find($request->atividade);
        $perguntas_result = Pergunta::where('atividade_id', $request->atividade)->get();
        foreach($perguntas_result as $pergunta){
            $resposta = Resposta::where('pergunta_id', $pergunta->id)->get();
            if(count($resposta) > 0){
                $perguntas[] = 
                    [
                        'id_pergunta' => $pergunta->id,
                        'tipo' => '1',
                        'pergunta'=> $pergunta->descricao,
                    ];
                    $verdadeira = '';
                    foreach($resposta as $res){
                        if($verdadeira === ''){
                            $verdadeira = ($res->verdadeira == 1) ? $res->id : '';
                            $correcao = ($verdadeira == $respostaaluno) ? 'true' : 'false';
                        }
                        
                        $respostas[] = [
                            'id_pergunta' => $pergunta->id,
                            'id' => $res->id,
                            'descricao'=> $res->descricao,
                            'resposta_aluno' => $respostaaluno,
                            'certa' => $correcao,
                            'resposta_certa' => $verdadeira
                        ];
                    }
                      
            }else{
                $perguntas[] = [
                        'id_pergunta' => $pergunta->id,
                        'tipo' => '2',
                        'pergunta'=> $pergunta->descricao,
                        'resposta_dissertativa' => $resposta_dissertativa
                ];
            }
        }
// dd($respostas);
        return view('atividade.viewatividadecorrecao', compact('perguntas', 'respostas', 'atividades'));
        // $retorno['perguntas'] = $perguntas;
        // $retorno['respostas'] = $respostas;
        // $retorno['atividades'] = $atividades;
        
        // return redirect()->route('atividadecorrecao', [$retorno]);
        // return redirect('atividadecorrecao')->with('retorno',$retorno);
    }



    public function correcao($retorno){
        dd($retorno);
        return view('atividade.viewatividadecorrecao', compact('perguntas', 'respostas', 'atividades'));
    }

    private function handleData(Request $request)
    {
        $result[] = $request;
        return $result;
    }
}
<?php

namespace App\Http\Controllers;

use Exception;
use App\Helpers\Funcoes;
use Illuminate\Http\Request;
use App\{Atividade, Pergunta, Resposta, TurmaAluno, Turma, User, AtividadeRespondida};

class AtividadeController extends Controller
{
    public function index()
    {
        $atividades = Atividade::query()->get();
        $isMobile = Funcoes::isMobile();
        return view('atividade.index', compact('atividades', 'isMobile'));
    }

    public function edit(int $id)
    {
        $local = 'Editar';
        $atividade = Atividade::find($id);
        $pergunta = $atividade->perguntas;
        $respostas = Resposta::where(['pergunta_id' => $pergunta[0]->id])->get();
        $isMobile = Funcoes::isMobile();
        return view('atividade.formAtividade', compact('local', 'atividade', 'pergunta', 'respostas', 'isMobile'));
    }

    public function add()
    {
        $local = 'Incluir';
        return view('atividade.formAtividade', compact('local'));
    }

    public function create(Request $request)
    {
        $this->createActivity($request);
        return redirect('atividade');
    }

    public function delete(int $id)
    {
        $this->deleteQuestion($id);
        $this->deleteActivity($id);
        return redirect('atividade');
    }

    public function save(Request $request)
    {
        $this->saveActivity($request);
        return redirect('atividade');
    }

    private function deleteActivity($id)
    {
        $activity = Atividade::find($id);
        $activity->delete();
    }

    private function deleteQuestion(int $idActivity)
    {
        $pergunta = Pergunta::find(['atividade_id' => $idActivity]);
        $this->deleteResponse($pergunta[0]->id);
        Pergunta::where(['atividade_id' => $idActivity])->delete();
    }
    
    private function deleteResponse($idQuestion)
    {
        Resposta::where(['pergunta_id' => $idQuestion])->delete();
    }

    private function saveActivity(Request $request)
    {
        $atividade = Atividade::find($request->id);
        $atividade->descricao = $request->descricao;
        $atividade->save();

        $data = $this->handleData($request);
        $this->beforeSaveQuestion($data);
        $this->beforeSaveResponse($data);
    }

    private function createActivity(Request $request)
    {
        $url_file = Funcoes::upload($request, 'atividade', 'arquivo');
        $activity = Atividade::create(['descricao' => $request->descricao, 'url_anexos' => $url_file->getPathName()]);
        $this->createQuestion($activity, $request);
    }

    private function createQuestion(Atividade $atividade, Request $request)
    {
        $data = $this->handleData($request);
        for ($i=0; $i < $request->qtd; $i++) { 
            $position = 'pergunta_'.$i;
            $positionResponse = $position.'_resposta'; 
            $positionCerta    = $position.'_certa';
            $pergunta = $data[0][$position];
            
            $question = $atividade->perguntas()->create(['descricao' => $pergunta]);

            if (isset($data[0][$positionResponse])){
                $response = $data[0][$positionResponse];
                $certa    = $data[0][$positionCerta];
                $this->createResponse($question, $response, $certa);
            }
        }
    }

    private function createResponse(Pergunta $pergunta, array $response, array $certa)
    {
        $arrayData = $this->buildResponse($response, $certa);
        foreach ($arrayData as $data) {
            $pergunta->respostas()->create([
                'descricao' => $data['descricao'], 
                'alternativa' => $data['alternativa'], 
                'verdadeira' => $data['verdadeira']
                ]
            );
        }
    }

    private function buildResponse(array $responses, array $certa)
    {
        $verdadeira = 0;
        $alternativas = range('A', 'Z');
        $i = 0;
        foreach ($responses as $response){
            if($response == $certa[0]){
                $verdadeira = 1;
            }
            $data[] = ['descricao' => $response, 'verdadeira' => $verdadeira, 'alternativa' => $alternativas[$i]];
            $i++;
            $verdadeira = 0;
        }

        return $data;
    }

    private function handleData(Request $request)
    {
        $result[] = $request;
        return $result;
    }

    public function viewatividade(int $id)
    {
        $perguntas = null;
        $respostas = null;
        $atividades = Atividade::find($id);
        $perguntas_result = Pergunta::where('atividade_id', $id)->get();
        foreach($perguntas_result as $pergunta){
            $resposta = Resposta::where('pergunta_id', $pergunta->id)->get();
            if(count($resposta) > 0){
                $perguntas[] = 
                    [
                        'id_pergunta' => $pergunta->id,
                        'tipo' => '1',
                        'pergunta'=> $pergunta->descricao,
                    ];
                    foreach($resposta as $res){
                        $respostas[] = [
                            'id_pergunta' => $pergunta->id,
                            'id' => $res->id,
                            'descricao'=> $res->descricao
                        ];
                    }
                      
            }else{
                $perguntas[] = [
                        'id_pergunta' => $pergunta->id,
                        'tipo' => '2',
                        'pergunta'=> $pergunta->descricao,
                ];
            }
        }
        return view('atividade.viewatividade', compact('perguntas', 'respostas', 'atividades'));
    }

    public function editatividade(int $id)
    {
        $perguntas = null;
        $respostas = null;
        $atividades = Atividade::find($id);
        $perguntas_result = Pergunta::where('atividade_id', $id)->get();
        foreach($perguntas_result as $pergunta){
            $resposta = Resposta::where('pergunta_id', $pergunta->id)->get();
            if(count($resposta) > 0){
                $perguntas[] = 
                    [
                        'id_pergunta' => $pergunta->id,
                        'tipo' => '1',
                        'pergunta'=> $pergunta->descricao,
                    ];
                    foreach($resposta as $res){
                        $respostas[] = [
                            'id_pergunta' => $pergunta->id,
                            'id' => $res->id,
                            'descricao'=> $res->descricao
                        ];
                    }
                      
            }else{
                $perguntas[] = [
                        'id_pergunta' => $pergunta->id,
                        'tipo' => '2',
                        'pergunta'=> $pergunta->descricao,
                ];
            }
        }
        return view('atividade.formEditAtividade', compact('perguntas', 'respostas', 'atividades'));
    }   
    
    public function beforeSaveQuestion(array $data)
    {
        $ids = $data[0]['idsPerguntas'];

        foreach ($ids as $id) {
            $key = 'pergunta_'.$id;
            $description = $data[0][$key];
            $this->saveQuestion($id, $description);
        }
    }

    public function beforeSaveResponse(array $data)
    {
        $ids = $data[0]['idsRespostas'];

        foreach ($ids as $id) {
            $key = 'resposta_'.$id;
            $description = $data[0][$key];

            $this->saveResponse($id, $description);
        }
    }

    private function saveQuestion(int $id, string $description)
    {
        $question = Pergunta::find($id);
        $question->descricao = $description;
        $question->save();
    }

    private function saveResponse(int $id, string $description)
    {
        $question = Resposta::find($id);
        $question->descricao = $description;
        $question->save();
    }    

    private function upload($file){
        try{
            $uploaddir = 'uploads/';
        
            $uploadfile = $uploaddir . basename($file['name']);
    
            if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
                return $uploadfile;
            } else {
                return "Arquivo corrompido!\n";
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}

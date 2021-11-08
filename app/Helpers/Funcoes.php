<?php
namespace App\Helpers;
use Exception;
use Illuminate\Http\Request;
use App\Helpers\ChunkReadFilter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\{Professor,Aluno,User,Turma,TurmaAluno};

class Funcoes
 {
    public static function upload(Request $request, $pasta, $fileinput){
        try{
            $file = $request->file($fileinput);
            $extension = $request->$fileinput->getClientOriginalExtension();  //Get Image Extension
            $fileName =  $request->$fileinput->getClientOriginalName(); //Concatenate both to get FileName (eg: file.jpg)
            $url_file = $file->move('uploads/'.$pasta.'', $fileName);  
            
            return $url_file;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public static function isMobile() {
        $is_mobile = false;
 
        //Se tiver em branco, não é mobile
        if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
            $is_mobile = false;
 
        //Senão, se encontrar alguma das expressões abaixo, será mobile
        } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
                $is_mobile = true;
 
        //Senão encontrar nada, não será mobile
        } else {
            $is_mobile = false;
        }
        return $is_mobile;
    }

    public static function encrypt(string $data)
    {
        return Crypt::encryptString($data);
    }

    public static function decrypt(string $data)
    {
        return Crypt::decryptString($data);
    }

    public static function carga_cadastro(Request $request, $local, $fileinput)
    {
        $baseLocation =  'uploads/cadastro/';//BASE_PATH . DIRECTORY_SEPARATOR . 'public'. DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . 'arquivos' . DIRECTORY_SEPARATOR ;
        if(!is_dir($baseLocation)){
            mkdir($baseLocation, 0777, true);
        }
        $file = $request->file($fileinput);
        if ($request->$fileinput->getClientOriginalExtension() === 'xlsx') {
            $fileName =  $request->$fileinput->getClientOriginalName();
            $path = $baseLocation . str_replace(' ', '_', $request->$fileinput->getClientOriginalName()).'';
            $file->move($baseLocation, $fileName);

            if ($path !== false) {

                $respota = [
                    'count' => 0,
                    'sucess' => 0,
                    'error' => 0,
                    'messages' => []
                ];

                $chunkFilter = new ChunkReadFilter();
                $reader = IOFactory::createReader('Xlsx');
                $reader->setReadFilter($chunkFilter);

                $objectXls = new Xlsx();
                $excel = $objectXls->load($path);
                $rows = count($excel->getActiveSheet()->toArray(null, true, true, true));
                $chunkFilter = $chunkFilter;
                $reader = $reader;
                $file = $file;
                $chunkSize = 1000;

                $resp = [];
                set_time_limit(3600);
                try {
                    for ($startRow = 2; $startRow <= $rows; $startRow += $chunkSize) {
                        $chunkFilter->setRows($startRow, $chunkSize);
                        $spreadsheet = $reader->load($path);
                        $pRange = 'A' . $startRow . ':' . $spreadsheet->getActiveSheet()->getHighestColumn() . $spreadsheet->getActiveSheet()->getHighestRow();
                        $sheetData = $spreadsheet->getActiveSheet()->rangeToArray($pRange, true, true, true);

                        if($local == 'professor'){
                            Funcoes::carga_professor($sheetData);
                        }
                        if($local == 'aluno'){
                            Funcoes::carga_aluno($sheetData);
                        }
                    }
                } catch (\Exception $e) {
                    $respota['error']++;
                    $respota['messages'][] = [
                        'message' => $e->getMessage()
                    ];
                }

                $excel->garbageCollect();
                unlink($path);
                return $respota;
            } else {
                $messages = 'Falha localizar o arquivo importado! Tente novamente, caso persistir contatar a ONCLICK';
            }
        } else {
            $messages = "Arquivo fora do padrão, só é aceito o formato xlsx";
        }
        return [
            'count' => 0,
            'sucess' => 0,
            'error' => 0,
            'message' => [$messages]
        ];
    }

    public static function carga_professor(Array $sheetData)
    {
        foreach ($sheetData as $key => $item) {
            $dados = [];
            $email = (strlen($item[0]) > 0) ?  (string)trim($item[0]): ' ';
            $nome = (strlen($item[1]) > 0) ?  (string)trim($item[1]) : ' ';
            $data_nascimento = (strlen($item[2]) > 0) ?  (string)trim($item[2]) : ' ';
            $rg = (strlen($item[5]) > 0) ?  (string)trim($item[5]) : ' ';
            $cpf = (strlen($item[7]) > 0) ?  trim($item[7]) : ' ';
            $telefone = (strlen($item[8]) > 0) ?  ($item[8]) : ' ';

            $professor = new Professor();
            $professor->nome            = $nome;
            $professor->data_nascimento = date("Y-m-d", strtotime($data_nascimento));
            $professor->email           = $email;
            $professor->cpf             = $cpf;
            $professor->rg              = $rg;
            $professor->telefone        = $telefone;
            $professor->celular         = ' ';
            $professor->genero          = ' ';
            $professor->cep             = ' ';
            $professor->rua             = ' ';
            $professor->numero          = ' ';
            $professor->cidade          = ' ';
            $professor->estado          = ' ';

            $professor->data_cadastro       = date('Y-m-d H:i:s');
            $professor->save();
            $dados = [
                0 => $item[1],
                1 => $item[0]
            ];
            Funcoes::createUser($dados, 'professor');
        }
    }

    public static function carga_aluno(Array $sheetData)
    {
        foreach($sheetData as $key => $item)
        {
            $user = [];
            $turma = [];
            $aluno = new Aluno();
            $aluno->nome                 =(strlen($item[1]) > 0) ?  (string)trim($item[1]): ' '; 
            $aluno->data_nascimento      =(strlen($item[5]) > 0) ?  date("Y-m-d", strtotime($item[5])): ' '; 
            $aluno->email                =(strlen($item[24]) > 0) ?  (string)trim($item[24]): ' '; 
            $aluno->cpf                  = ' '; 
            $aluno->rg                   = ' '; 
            $aluno->telefone             =(strlen($item[34]) > 0) ?  (string)trim($item[34]): ' '; 
            $aluno->celular              =(strlen($item[35]) > 0) ?  (string)trim($item[35]): ' '; 
            $aluno->genero               =(strlen($item[3]) > 0) ?  (string)trim($item[3]): ' '; 
            $aluno->cep                  =(strlen($item[32]) > 0) ?  (string)trim($item[32]): ' '; 
            $aluno->rua                  =(strlen($item[28]) > 0) ?  (string)trim($item[28]): ' '; 
            $aluno->numero               =(strlen($item[29]) > 0) ?  (string)trim($item[29]): ' ';
            $aluno->cidade               =(strlen($item[33]) > 0) ?  (string)trim($item[33]): ' '; 
            $aluno->estado               =' '; 
            $aluno->nome_mae             =(strlen($item[7]) > 0) ?  (string)trim($item[7]): ' '; 
            $aluno->email_mae            =' '; 
            $aluno->cpf_mae              =' '; 
            $aluno->rg_mae               =' '; 
            $aluno->nome_pai             =(strlen($item[8]) > 0) ?  (string)trim($item[8]): ' '; 
            $aluno->email_pai            =' '; 
            $aluno->cpf_pai              =' '; 
            $aluno->rg_pai               =' '; 
            $aluno->nome_responsavel     =' '; 
            $aluno->email_responsavel    =' '; 
            $aluno->cpf_responsavel      =' ';
            $aluno->rg_responsavel       =' ';
            $aluno->observacao           =' ';
            $aluno->foto                 =' ';
            $aluno->telefone_pai         =' ';
            $aluno->telefone_mae         =' ';
            $aluno->telefone_responsavel =' ';
            $aluno->celular_pai          =' ';
            $aluno->celular_mae          =' ';
            $aluno->celular_responsavel  =' '; 
            $aluno->alergia              =' '; 
            $aluno->deficiencia          =' ';
            $aluno->data_cadastro     = date('Y-m-d H:i:s');
            $aluno->save();

            $user = [
                0 => $item[1],
                1 => $item[24]
            ];
            $explodeturma = explode('-', $item[2]);
            $turma = [
                0 => $explodeturma[0],
                1 => $explodeturma[1],
                2 => $item[1]
            ];
            Funcoes::createUser($user, 'aluno');
            Funcoes::createTurma($turma);
        }
    }

    public static function createUser(Array $request, $permission)
    {
        $user = new User();
        $user->name      = $request[0];
        $user->email     = $request[1];
        $user->password  = Hash::make($request[1]);
        $user->permissao = $permission;
        $user->save();
    }

    public static function createTurma(Array $request)
    {
        $nome = str_replace('Profª','', $request[1]);
        $nome = str_replace('   ','', $nome);
        $nome = explode(' ', $nome);

        if(count($nome) > 1){$nome = $nome[1];}else{$nome = $nome[0];}
        
        $professor_id = DB::select("select id from users where name LIKE '%$nome%'");

        foreach ($professor_id as $key => $value) {
            $professor_id = $value->id;
        }
        $turma = Turma::where('descricao', $request[0])->get();
        
        if(count($turma) == 0){
            $turma = new Turma();
            $turma->descricao      = $request[0];
            $turma->horario        = '';
            $turma->professor_id   = $professor_id;
            $turma->save();
        }
        $aluno = $request[2];
        $aluno_id = DB::select("select id from users where name LIKE '%$aluno%'");
        foreach ($aluno_id as $key => $value) {
            $aluno_id = $value->id;
        }

        $turma = $request[0];
        $turma_id = DB::select("select id from turma where descricao LIKE '%$turma%'");
        foreach ($turma_id as $key => $value) {
            $turma_id = $value->id;
        }

        $turmaaluno = [
            0 => $aluno_id,
            1 => $turma_id
        ];
        Funcoes::createTurmaAluno($turmaaluno);
    }

    public static function createTurmaAluno(Array $request)
    {
        $turmaalunocreate = new TurmaAluno;
        $turmaalunocreate->aluno_id = $request[0];
        $turmaalunocreate->turma_id = $request[1]; 
        $turmaalunocreate->save();
    }
}

 
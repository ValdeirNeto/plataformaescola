@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' => $local .' Aluno', 'viewanterior' => 'Alunos', 'local' =>$local])
    @include('errors', ['errors' => $errors])    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php $valor = isset($aluno) ? $aluno : null; 
                    $valor_id = isset($aluno) ? $aluno[0]['genero']  : '' ;
                    $genero = [['id' => 'masculino', 'name' => 'Masculino'],['id' => 'feminino', 'name' => 'Feminino'],['id' => 'outros', 'name' => 'Outros']]?>
            @include('componentes.form', 
            ['local' => $local, 
            'label' => ['Nome', 'Nome Social', 'Data de Nascimento', 'Email','CPF','RG', 'RA', 'Telefone','Celular','Gênero','CEP','Rua','Número','Cidade','Estado','Nome da Mãe', 'Email da Mãe','CPF da Mãe','RG da Mãe', 'Telefone Residencial Mãe',
            'Celular Mãe', 'Nome do Pai', 'Email do Pai','CPF do Pai','RG do Pai', 'Telefone Residencial Pai', 'Celular Pai', 'Nome do Responsável','Email do Responsável','CPF do Responsável','RG do Responsável', 'Telefone Residencial Responsável',
            'Celular Responsável', 'Alergia', 'Deficiência', 'Observação','Foto'],
            'campos' => ['nome', 'nome_social', 'data_nascimento', 'email','cpf', 'rg', 'ra', 'telefone', 'celular', 'genero', 'cep', 'rua', 'numero','cidade', 'estado', 'nome_mae', 'email_mae', 'cpf_mae', 'rg_mae', 'telefone_mae',
            'celular_mae', 'nome_pai', 'email_pai', 'cpf_pai', 'rg_pai', 'telefone_pai', 'celular_pai', 'nome_responsavel', 'email_responsavel', 'cpf_responsavel', 'rg_responsavel', 'telefone_responsavel', 'celular_responsavel', 'alergia', 
            'deficiencia', 'observacao','foto'],
            'tipo' => ['text','text','text','text','text','text','text','text','text','select','text','text','text','text','text','text','text','text','text','text','text','text','text','text','text','text','text','text','text','text','text',
            'text','text', 'text','text', 'textarea','file'],
            'rotaedit'=>'alunoeditpost',
            'rotapost' => 'alunoaddpost',
            'rotacancela' => 'aluno',
            'valor' => $valor,
            'valorselect' => $genero,
            'valor_id' => $valor_id])
        </div>
    </div>
</div>
@endsection
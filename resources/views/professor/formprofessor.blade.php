@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' => $local.' Professor', 'viewanterior' => 'Professores', 'local' => $local])
    @include('errors', ['errors' => $errors])
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php $valor = isset($professor) ? $professor : null; 
                    $valor_id = isset($professor) ? $professor[0]['genero']  : '' ;
                    $genero = [['id' => 'masculino', 'name' => 'Masculino'],['id' => 'feminino', 'name' => 'Feminino'],['id' => 'outros', 'name' => 'Outros']]?>
            @include('componentes.form', 
            ['local' => $local, 
            'label' => ['Nome', 'Data de Nascimento', 'Email', 'CPF','RG', 'Telefone','Celular','Gênero','CEP','Rua','Número','Cidade','Estado','Foto', 'Status'],
            'campos' => ['nome', 'data_nascimento', 'email', 'cpf', 'rg', 'telefone', 'celular', 'genero', 'cep', 'rua', 'numero','cidade','estado','foto', 'status'],
            'tipo' => ['text','text','text', 'text','text','text','text', 'select','text','text','text','text','text','file','radio'],
            'rotaedit'=>'professoreditpost',
            'rotapost' => 'professoraddpost',
            'rotacancela' => 'professor',
            'valor' => $valor,
            'valorselect' => $genero,
            'valor_id' => $valor_id])
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' => $local .' Comunicado', 'viewanterior' => 'Comunicados', 'local' =>$local])
    @include('errors', ['errors' => $errors])    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php $valor = isset($comunicado) ? $comunicado : null; 
                    $valor_id = isset($comunicado) ? $comunicado[0]['para']  : '' ;
                    $para = [
                        ['id' => 'coordenador', 'name' => 'Coordenador/Direção'],
                        ['id' => 'professor', 'name' => 'Professores'],
                        ['id' => 'aluno', 'name' => 'Alunos'],
                        ['id' => 'todos', 'name' => 'Todos']
                        ]?>
            @include('componentes.form', 
            ['local' => $local, 
            'label' => ['Para', 'Mensagem', 'Data de Validade'],
            'campos' => ['para', 'mensagem', 'data_validade'],
            'tipo' => ['select','textarea','text'],
            'rotaedit'=>'comunicadoeditpost',
            'rotapost' => 'comunicadoaddpost',
            'rotacancela' => 'comunicado',
            'valor' => $valor,
            'valorselect' => $para,
            'valor_id' => $valor_id])
        </div>
    </div>
</div>
@endsection
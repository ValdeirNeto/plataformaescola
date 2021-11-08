@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' => $local.' Turma', 'viewanterior' => 'Turmas', 'local' => $local])
    @include('errors', ['errors' => $errors])
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php $valor = isset($turma) ? $turma : null; 
                    $valor_id = isset($turma) ? $turma[0]->professor_id  : '' ;
                    $valor_id_periodo = isset($turma) ? $turma[0]->horario  : '' ;
                    $periodo = [['id' => 'manha', 'name' => 'Manhã'],['id' => 'tarde', 'name' => 'Tarde'],['id' => 'noite', 'name' => 'Noite']]?>
            @include('componentes.form', 
            ['local' =>$local, 
            'label' => ['Descrição', 'Periodo', 'Professor'],
            'campos' => ['descricao', 'horario', 'professor'],
            'tipo' => ['text','select','select'],
            'rotaedit'=>'turmaeditpost',
            'rotapost' => 'turmaaddpost',
            'rotacancela' => 'turma',
            'valor' => $valor,
            'valorselect' => $professores,
            'valor_id' => $valor_id,
            'valorperido' => $periodo,
            'valor_id_periodo' => $valor_id_periodo])
        </div>
    </div>
</div>
@endsection
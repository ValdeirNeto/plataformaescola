@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' => $local.' Aluno', 'viewanterior' => 'Alunos', 'local' => $local])
    @include('errors', ['errors' => $errors])
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @include('componentes.form', 
            ['local' => $local, 
            'label' => ['Cadastro via Upload'],
            'campos' => ['upload'],
            'tipo' => ['file'],
            'rotapost' => 'alunouploadpost',
            'rotacancela' => 'aluno',])
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' => $local.' Professor', 'viewanterior' => 'Professores', 'local' => $local])
    @include('errors', ['errors' => $errors])
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @include('componentes.form', 
            ['local' => $local, 
            'label' => ['Cadastro via Upload'],
            'campos' => ['upload'],
            'tipo' => ['file'],
            'rotapost' => 'professoruploadpost',
            'rotacancela' => 'professor',])
        </div>
    </div>
</div>
@endsection
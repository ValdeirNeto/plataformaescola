@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' => $local .' Escola', 'viewanterior' => 'Escolas', 'local' =>$local])
    @include('errors', ['errors' => $errors])    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php $valor = isset($school) ? $school : null; ?>
            @include('componentes.form', 
            ['local' => $local, 
            'label' => ['Nome', 'CNPJ', 'CEP', 'Rua', 'Número', 'Cidade', 'Estado', 'Status'],
            'campos' => ['nome', 'cnpj', 'cep', 'rua', 'numero', 'cidade', 'estado', 'situacao'],
            'tipo' => ['text','text','text','text','text','text','text','radio'],
            'rotaedit'=>'schoolSave',
            'rotapost' => 'schoolCreate',
            'rotacancela' => 'schoolIndex',
            'valor' => $valor])
        </div>
    </div>
</div>
@endsection
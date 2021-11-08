@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' => $local .' Usuario', 'viewanterior' => 'Usuario', 'local' => $local])
    @include('errors', ['errors' => $errors])
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php $valor = isset($user) ? $user : null; ?>
            @include('componentes.form', 
            ['local' => $local, 
            'label' => ['Nome', 'Email', 'Senha', 'Permissão', 'Status'],
            'campos' => ['name', 'email', 'password', 'permissao', 'status'],
            'tipo' => ['text','text','password','text','radio'],
            'rotaedit'=>'userseditpost',
            'rotapost' => 'usersaddpost',
            'rotacancela' => 'users',
            'valor' => $valor])
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' => 'Usuários', 'viewanterior' => 'Usuários', 'local' => 'Lista', 'rotanovo'=>'usersadd'])
    <div class="data-table-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline13-list">
                        @if($isMobile)
                            @include('componentes.listmobile', ['valores' => $users, 'campos' => ['id', 'name', 'email', 'permissao'], 'rotaedit' => 'usersedit', 'rotadelete' => 'usersdelete'])
                        @else
                        @include('componentes.list', ['colluns' => ['Código', 'Nome', 'Email', 'Permissão'], 'valores' => $users, 
                                'campos' => ['id', 'name', 'email', 'permissao'],'rotaedit' => 'usersedit', 'rotadelete' => 'usersdelete'])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

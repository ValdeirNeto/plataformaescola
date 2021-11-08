@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' => 'Alunos', 'viewanterior' => 'Alunos', 'local' => 'Lista',  'rotanovo'=>'alunoadd', 'rotacarregaupload' => 'alunoupload'])
    <div class="data-table-area mg-b-15 ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline13-list">
                        @if($isMobile)
                            @include('componentes.listmobile', ['valores' => $alunos, 
                                'campos' => ['id', 'nome', 'usuario','email'],'rotaedit' => 'alunoedit', 'rotadelete' => 'alunodelete'])
                        @else
                        @include('componentes.list', ['colluns' => ['Código', 'Nome', 'Usuario de Acesso','Email de Contato'], 'valores' => $alunos, 
                                'campos' => ['id', 'nome', 'usuario', 'email'],'rotaedit' => 'alunoedit', 'rotadelete' => 'alunodelete'])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' => 'Atividades', 'viewanterior' => 'Atividades', 'local' => 'Lista', 'rotanovo'=>'atividadeAdd'])
    <div class="data-table-area mg-b-15 ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline13-list">
                        @if($isMobile)
                            @include('componentes.listmobile', ['valores' => $atividades, 
                                'campos' => ['id', 'descricao'],'rotaedit' => 'atividadeEdit', 'rotadelete' => 'atividadeDelete', 'rotaatividade' => 'viewatividade'])
                        @else
                        @include('componentes.list', ['colluns' => ['Código', 'Descrição'], 'valores' => $atividades, 
                                'campos' => ['id', 'descricao'],'rotaedit' => 'atividadeEdit', 'rotadelete' => 'atividadeDelete', 'rotaatividade' => 'viewatividade'])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
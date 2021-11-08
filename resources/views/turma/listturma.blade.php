@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' => 'Turmas', 'viewanterior' => 'Turmas', 'local' =>'Lista', 'rotanovo'=>'turmaadd'])
    <div class="data-table-area mg-b-15 ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline13-list">
                        @if($isMobile)
                            @include('componentes.listmobile', ['valores' => $turmas, 
                                'campos' => ['id', 'descricao', 'horario', 'professor'],'rotaedit' => 'turmaedit', 'rotadelete' => 'turmadelete', 'rotaalunoporturma' => 'alunoporturma'])
                        @else
                        @include('componentes.list', ['colluns' => ['Código', 'Descrição', 'Horário', 'Professor'], 'valores' => $turmas, 
                                'campos' => ['id', 'descricao', 'horario', 'professor'],'rotaedit' => 'turmaedit', 'rotadelete' => 'turmadelete', 'rotaalunoporturma' => 'alunoporturma'])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

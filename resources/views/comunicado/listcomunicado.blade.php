@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' => 'Comunicado', 'viewanterior' => 'Comunicado', 'local' => 'Lista',  'rotanovo'=>'comunicadoadd'])
    <div class="data-table-area mg-b-15 ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline13-list">
                        @if($isMobile)
                            @include('componentes.listmobile', ['valores' => $comunicado, 
                                'campos' => ['id', 'de', 'para', 'data_validade'],'rotaedit' => 'comunicadoedit', 'rotadelete' => 'comunicadodelete'])
                        @else
                        @include('componentes.list', ['colluns' => ['Código', 'De', 'Para', 'Validade'], 'valores' => $comunicado, 
                                'campos' => ['id', 'de', 'para', 'data_validade'],'rotaedit' => 'comunicadoedit', 'rotadelete' => 'comunicadodelete'])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

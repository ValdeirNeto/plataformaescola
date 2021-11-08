@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' => 'Escolas', 'viewanterior' => 'Escolas', 'local' => 'Lista',  'rotanovo'=>'schoolAdd'])
    <div class="data-table-area mg-b-15 ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline13-list">
                        @if($isMobile)
                            @include('componentes.listmobile', 
                            [
                                'valores' => $schools, 
                                'campos' => [
                                    'id', 
                                    'nome', 
                                    'cnpj',
                                    'situacao'
                                ],
                                'rotaedit' => 'schoolEdit', 
                                'rotadelete' => 'schoolDelete'
                            ])
                        @else
                            @include('componentes.list',
                            [
                                'colluns' => [
                                    'Código', 
                                    'Nome', 
                                    'CNPJ',
                                    'Situção'
                                ],
                                'valores' => $schools,
                                'campos' => [
                                    'id', 
                                    'nome', 
                                    'cnpj',
                                    'situacao'
                                ],
                                'rotaedit' => 'schoolEdit', 
                                'rotadelete' => 'schoolDelete'
                            ])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' => 'Logs', 'viewanterior' => 'Log', 'local' => 'Log'])
    <div class="data-table-area mg-b-15 ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline13-list">
                        @if($isMobile)
                            @include('componentes.listmobile', 
                            [
                                'valores' => $log, 
                                'campos' => [
                                    'id', 
                                    'name', 
                                    'email',
                                    'type',
                                    'action',
                                    'date',
                                ]
                            ])
                        @else
                            @include('componentes.list',
                            [
                                'colluns' => [
                                    'Código', 
                                    'Nome', 
                                    'E-mail',
                                    'Local',
                                    'Ação',
                                    'Data'
                                ],
                                'valores' => $log,
                                'campos' => [
                                    'id', 
                                    'name', 
                                    'email',
                                    'type',
                                    'action',
                                    'date'
                                ]
                            ])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

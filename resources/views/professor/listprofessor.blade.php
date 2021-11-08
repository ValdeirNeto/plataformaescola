@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' => 'Professores', 'viewanterior' => 'Professores', 'local' => 'Lista', 'rotanovo'=>'professoradd', 'rotacarregaupload' => 'professorupload'])
    <div class="data-table-area mg-b-15 ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline13-list">
                        @if($isMobile)
                            @include('componentes.listmobile', ['valores' => $professor, 
                                'campos' => ['id', 'nome', 'email'],'rotaedit' => 'professoredit', 'rotadelete' => 'professordelete'])
                        @else
                        @include('componentes.list', ['colluns' => ['Código', 'Nome', 'Email'], 'valores' => $professor, 
                                'campos' => ['id', 'nome', 'email'],'rotaedit' => 'professoredit', 'rotadelete' => 'professordelete'])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' =>'Chamada Eletrônica', 'viewanterior' => 'Chamada Eletrônica', 'local' =>'Lista'])
    <div class="data-table-area mg-b-15 ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline13-list">
                        <div class="sparkline13-hd">
                            <div class="main-sparkline13-hd col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            </div>
                        </div>
                        <div class="sparkline10-graph">
                            <div class="static-table-list">
                                <table class="table border-table">
                                    <thead>
                                        <tr>
                                            <th data-field="id">Código</th>
                                            <th data-field="name" data-editable="true">Descrição</th>
                                            <th data-field="email" data-editable="true">Horário</th>
                                            <?php if(Auth::user()->permissao != 'professor'): ?>
                                                <th data-field="email" data-editable="true">Professor</th>
                                            <?php endif; ?>
                                            <th data-field="action">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($turmas) && count($turmas) > 0)
                                            @foreach($turmas as $turma)
                                                <tr>
                                                    <td><?= str_pad($turma['id'], 4, "0", STR_PAD_LEFT); ?></td>
                                                    <td>{{$turma['descricao']}}</td>
                                                    <td>{{$turma['horario']}}</td>
                                                    <?php if(Auth::user()->permissao != 'professor'): ?>
                                                        <td>{{$turma['professor']}}</td>
                                                    <?php endif; ?>
                                                    <td class="datatable-ct">
                                                    <div class="btn-group btn-custom-groups">
                                                        <a type="button" href="<?= route('chamadaform', [$turma['id']]);?>" style="margin-right: 5px" title="Realizar Chamada" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                        <a type="button" href="<?= route('visualizarchamada', [$turma['id']]);?>" title="Visualizar Chamada" class="btn btn-success"><i class="fa fa-user edu-avatar" aria-hidden="true"></i></a>
                                                    </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" align="center">Nenhum registro encontrado</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

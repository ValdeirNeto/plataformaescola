<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true"  data-cookie="true"
                                    data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <?php if(isset($colluns)):?>
                                            <?php for($i=0; $i < count($colluns); $i++):?>
                                                <th data-field="<?=$colluns[$i] ?>"><?=$colluns[$i] ?></th>
                                            <?php endfor;?>
                                        <?php endif;?>
                                        <th data-field="action" align='right'></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($valores) && count($valores) > 0)
                                        @foreach($valores as $valor)
                                            <tr>
                                                <?php if(isset($campos)):?>
                                                    <?php for($i=0; $i < count($campos); $i++):?>
                                                        <?php if($campos[$i] == 'id'):?>
                                                            <td><?= str_pad($valor[$campos[$i]], 4, "0", STR_PAD_LEFT); ?></td>
                                                        <?php else:?>
                                                            <?php $valor_list = ($campos[$i] == 'situacao' || $campos[$i] == 'status') ? ($valor[$campos[$i]] == '1' ? 'Ativo' : 'Inativo' ): $valor[$campos[$i]];?>
                                                            <td><?= $valor_list?></td>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                <?php endif;?>
                                                <td id="ultima">
                                                    <div>
                                                        <?php $id = isset($valor->id) ? $valor->id : $valor['id'];?>
                                                        <?php if(isset($rotaedit)):?>
                                                            <a type="button" href="<?= route($rotaedit , [$id]);?>" class="btn btn-primary" title="Editar" style="margin-right: 5px; color: white" ><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                        <?php endif;?>
                                                        <?php if(isset($rotaalunoporturma)):?>
                                                            <a type="button" href="<?= route($rotaalunoporturma, [$id]);?>" class="btn btn-success" title="Aluno por Turma" style="margin-right: 5px; color: white"><i class="fa fa-user edu-avatar" aria-hidden="true"></i></a>
                                                        <?php endif;?>
                                                        @if(isset($rotaatividade))
                                                        <a type="button" href="<?= route($rotaatividade, [$id]);?>" class="btn btn-success" title="Realizar Atividade" style="margin-right: 5px; color: white"><i class="fa fa-user edu-avatar" aria-hidden="true"></i></a>
                                                        @endif
                                                        <?php if(isset($rotadelete)):?>
                                                            <a type="button" href="<?= route($rotadelete, [$id]);?>"class="btn btn-danger" title="Excluir" style="margin-right: 5px; color: white"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                        <?php endif;?>
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


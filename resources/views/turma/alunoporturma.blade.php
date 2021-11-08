<script>
     function selecionaaluno(id){
        if($('#cmn-toggle-'+id+'').is(':checked')){
            $('#cmn-toggle-'+id+'').attr('checked', false);
            $('#aluno-'+id+'').css('background-color', '#fff')
            $('#aluno-'+id+'').css('color', '#000')
        }else{
            $('#cmn-toggle-'+id+'').attr('checked', true);
            $('#aluno-'+id+'').css('background-color', '#3490dc')
            $('#aluno-'+id+'').css('color', '#fff')
        }
    }
</script>
@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' =>'Selecionar alunos', 'viewanterior' => 'Turmas', 'local' =>'Aluno por Turma'])
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="sparkline12-list mt-b-30">
                <div class="sparkline12-hd">
                    <div class="main-sparkline12-hd">
                        <h1>Turma <?= $turma[0]->descricao?></h1>
                    </div>
                </div>
                <div style="height: 370px;">
                <?php if(isset($alunos) > 0) : ?>
                    <form method="Post" action="<?= route('alunoturmaaddpost');  ?>">
                        @csrf
                        <div class="sparkline12-graph">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="admintab-wrap edu-tab1 mg-t-30">
                                    <div class="input-knob-dial-wrap">
                                        <div class="sparkline12-hd">
                                            <div class="main-sparkline12-hd">
                                                <h1>Alunos</h1>
                                            </div>
                                        </div>
                                        
                                            <?php foreach($alunos as $aluno):?>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="aluno-<?= $aluno['id']?>" onclick="selecionaaluno(<?= $aluno['id']?>)"style="height:100px; border: 1px solid;border-radius: 15px;margin-bottom:5px; margin-left:5px; cursor: pointer;">
                                                    <div class="student-inner-std res-mg-b-30">
                                                        <div class="student-dtl" style="margin-top: 15px">
                                                            <h2><?= $aluno['name']?></h2>
                                                        </div>
                                                        <div class="switch">
                                                            <input id="cmn-toggle-<?= $aluno['id']?>" class="cmn-toggle cmn-toggle-round" type="checkbox" name="aluno[]" value="<?= $aluno['id']?>">
                                                            <label for="cmn-toggle-<?= $aluno['id']?>" style="display: none;"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="button-style-two btn-mg-b-10">
                                <input type="hidden" name="id" value="<?= isset($turma) ? $turma[0]->id : ''?>">
                                <button type="submit" class="btn btn-custon-rounded-two btn-success">Salvar</button>
                                <a href="{{ route('turma') }}" type="button" class="btn btn-custon-rounded-two btn-danger"><span style="color: #FFF">Cancelar</span></a>
                            </div>
                        </div>
                    </form>
                    <?php else: ?>
                        <div>
                            <h2>Todos os alunos vinculados a uma turma</h2>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
     function selecionaaluno(id){
        if($('#cmn-toggle-'+id+'').is(':checked')){
            $('#cmn-toggle-'+id+'').attr('checked', false);
            $('#aluno-'+id+'').css('background-color', '#fff')
            $('#aluno-'+id+'').css('color', '#000')
        }else{
            $('#cmn-toggle-'+id+'').attr('checked', true);
            $('#aluno-'+id+'').css('background-color', 'red')
            $('#aluno-'+id+'').css('color', '#fff')
        }
    }
</script>
@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' =>'Chamada Eletrônica', 'viewanterior' => 'Chamada Eletrônica', 'local' =>'Realizar'])
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="sparkline12-list mt-b-30">
            <div class="sparkline12-hd">
                <div class="main-sparkline12-hd">
                    <h1>Aula dia: <b><?= (new DateTime())->format('d/m/Y'); ?><b></h1>
                </div>
            </div>
            <form method="Post" action="<?= route('chamadaadd');  ?>">
                @csrf
                <div class="sparkline12-graph">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="admintab-wrap edu-tab1 mg-t-30">
                            <div class="input-knob-dial-wrap">
                                <div class="sparkline12-hd">
                                    <div class="main-sparkline12-hd">
                                        <h1>Alunos Presentes</h1>
                                    </div>
                                </div>
                                <?php foreach($alunos as $aluno):?>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="aluno-<?= $aluno['id']?>" onclick="selecionaaluno(<?= $aluno['id']?>)"style="height:100px; border: 1px solid;border-radius: 15px; margin-bottom:5px; margin-left:5px; cursor: pointer;">
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
                </div>
                <div class="sparkline12-graph">
                    <br><br>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <h4 class="login2 pull-left pull-left-pro">Conteúdo da aula</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="width: 80%">
                            <div class="form-group res-mg-t-15">
                                <textarea name="diario"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="button-style-two btn-mg-b-10">
                        <input type="hidden" name="turma" value="<?= isset($turma) ? $turma[0]->id : ''?>">
                        <input type="hidden" name="data_chamada" value="<?= (new DateTime())->format('d/m/Y'); ?>">
                        <button type="submit" class="btn btn-custon-rounded-two btn-success">Salvar</button>
                        <a href="{{ route('chamadaeletronica') }}" type="button" class="btn btn-custon-rounded-two btn-danger"><span style="color: #FFF">Cancelar</span></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
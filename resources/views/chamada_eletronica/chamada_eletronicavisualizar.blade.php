<script>
     function selecionaaluno(id){
        if($('#cmn-toggle-'+id+'').is(':checked')){
            $('#cmn-toggle-'+id+'').attr('checked', false);
            $('#aluno-'+id+'').css('background-color', '#fff')
            $('#aluno-'+id+'').css('color', '#000')
        }else{
            $('#cmn-toggle-'+id+'').attr('checked', true);
            $('#aluno-'+id+'').css('background-color', '#38c172')
            $('#aluno-'+id+'').css('color', '#fff')
        }
    }
</script>
@extends('layouts.app')

@section('content')
<div class="container-educa">
    @include('componentes.breadcome', ['view' =>'Chamada Eletrônica', 'viewanterior' => 'Chamada Eletrônica', 'local' =>'Visualizar'])
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="sparkline12-list mt-b-30">
                <div class="sparkline12-hd">
                    <div class="main-sparkline12-hd">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="input-mask-title">
                                <h1>Data da Chamada:</h1>
                                </div>
                            </div>
                            <form method="Post" action="<?= route('visualizarchamadapost', [$turma[0]->id]);?>">
                            @csrf
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="margin-top: 9px;">
                                <div class="chosen-select-single mg-b-20">
                                    <select class="chosen-select" tabindex="-1" name="data_chamada">
                                        <option value=""></option>
                                        <?php foreach($chamada_data as $ch) : ?>
                                            <option value="<?= $ch->id?>" <?= isset($data_filtro) && ($data_filtro) == $ch->id ? 'selected': ''?>><?= $ch->data_chamada?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="button-style-two btn-mg-b-10">
                                    <input type="hidden" name="turma" value="<?= isset($turma) ? $turma[0]->id : ''?>">
                                    <button type="submit" class="btn btn-custon-rounded-two btn-success">Pesquisar</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
                <div class="sparkline12-graph">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="admintab-wrap edu-tab1 mg-t-30">
                            <div class="input-knob-dial-wrap">
                            <?php if(isset($alunos)):?>
                                <div class="sparkline12-hd">
                                    <div class="main-sparkline12-hd">
                                        <h1>Alunos Presentes</h1>
                                    </div>
                                </div>
                                    <div class='row'>
                                    <?php foreach($alunos as $aluno):?>
                                        <?php $cor = null;
                                        if($aluno['presente'] == false){
                                            $cor = 'background-color: #38c172; color: #fff;';
                                        }else{
                                            $cor = 'background-color: red; color: #fff;';
                                        }
                                        ?>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="aluno-<?= $aluno['id']?>" style="<?= $cor; ?>height:100px; border: 1px solid;border-radius: 15px; margin-bottom:5px; margin-left:5px; cursor: pointer;">
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
                                    <br><br>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                            <h4 class="login2 pull-left pull-left-pro">Conteúdo da aula</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="width: 80%">
                                            <div class="form-group res-mg-t-15">
                                                <textarea name="diario" disabled><?=$chamada[0]->diario?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                    <div class="button-style-two btn-mg-b-10">
                        <input type="hidden" name="turma" value="<?= isset($turma) ? $turma[0]->id : ''?>">
                        <a href="{{ route('chamadaeletronica') }}" type="button" class="btn btn-custon-rounded-two btn-danger"><span style="color: #FFF">Voltar</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container-educa">
@include('componentes.breadcome', ['view' => 'Editar Atividade', 'viewanterior' => 'Atividades', 'local' => 'Editar'])
    <form method="Post" action="<?= route('atividadeSave');  ?>">
        @csrf
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="sparkline12-list mt-b-30">
                <div class="sparkline12-graph">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <div class="sparkline12-list">
                                <div class="sparkline12-hd">
                                    <div class="main-sparkline12-hd">
                                        <input type="text" class="form-control" name="descricao" id="descricao" value="<?= $atividades->descricao ?>"/>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" style="margin-top: 1.5%;">
                            <?php if(isset($atividades->url_anexos) &&  $atividades->url_anexos != '') : ?>
                                <div id="foto_exite" style="display: block">
                                    <a alt="logo" class="img-circle m-b" href="<?= '../../'. $atividades->url_anexos ?>" target='_blank' style="width: 150px">Arquivo para download</a>
                                    <input type="button" class="btn btn-custon-rounded-two btn-primary" onclick="alterar()" value="Alterar">
                                </div>
                                <div class="file-upload-inner file-upload-inner-right ts-forms" id="alterar" style="display: none">
                                    <div class="input append-big-btn">
                                        <div class="file-button">
                                            Buscar
                                            <input type="file" id="foto" name="arquivo" onchange="document.getElementById('append-big-btn').value = this.value;">
                                        </div>
                                        <input type="text" id="append-big-btn" name=""placeholder="Nenhum arquivo selecionado">
                                    </div>
                                </div>
                            <?php else:?>
                            <div class="file-upload-inner file-upload-inner-right ts-forms">
                                <div class="input append-big-btn">
                                    <div class="file-button">
                                        Buscar
                                        <input type="file" name="arquivo" onchange="document.getElementById('append-big-btn').value = this.value;">
                                    </div>
                                    <input type="text" id="append-big-btn" name="" placeholder="Nenhum arquivo selecionado">
                                </div>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if((isset($perguntas)) && (count($perguntas) > 0) )
            @foreach($perguntas as $atividade)
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline12-list mt-b-30">
                        <div class="sparkline12-graph">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="sparkline12-list">
                                        <div class="sparkline12-hd">
                                            <div class="main-sparkline12-hd">
                                                <input type="text" class="form-control" name="pergunta_<?= $atividade['id_pergunta']?>" id="descricao" value="<?= $atividade['pergunta'] ?>"/>
                                                <input type="hidden" class="form-control" name="idsPerguntas[]" id="idsPergunta" value="<?= $atividade['id_pergunta'] ?>"/>
                                                <br>
                                            </div>
                                        </div>
                                        @if(isset($atividade['tipo']))
                                            @if($atividade['tipo'] == '1')
                                                <div class="sparkline12-graph">
                                                    <div class="basic-login-form-ad">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="all-form-element-inner">
                                                                    <div class="row">
                                                                        @foreach($respostas as $resposta)
                                                                            @if($resposta['id_pergunta'] == $atividade['id_pergunta'])
                                                                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12" style="margin-bottom: 10px">
                                                                                    <input type="text" class="form-control" name="resposta_<?= $resposta['id']?>" id="descricao" value="<?= $resposta['descricao'] ?>"/>
                                                                                    <input type="hidden" class="form-control" name="idsRespostas[]" id="idRespostas" value="<?= $resposta['id'] ?>"/>
                                                                                </div>
                                                                                <br>
                                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                    <div class="i-checks pull-left">
                                                                                        <label>
                                                                                            <input type="checkbox" name="certa[]" value=""> <i></i> Certa
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                        <br><br>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="sparkline12-list mt-b-30">
                <div class="sparkline12-graph">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="sparkline12-list">
                                <div class="button-style-two btn-mg-b-10">
                                    <input type="hidden" name="id" value="<?=$atividades->id?>">
                                    <button type="submit" class="btn btn-custon-rounded-two btn-success">Salvar</button>
                                    <a href="{{ route('atividade') }}" type="button" class="btn btn-custon-rounded-two btn-danger"><span style="color: #FFF">Cancelar</span></a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
function alterar(){
        $('#foto_exite').css('display', 'none');
        $('#alterar').css('display', 'block');
        $('#foto').click();
    }
</script>
@endsection
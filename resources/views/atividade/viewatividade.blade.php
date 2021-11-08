@extends('layouts.app')

@section('content')
<div class="container-educa">
@include('componentes.breadcome', ['view' => 'Resposta das atividades', 'viewanterior' => 'Atividades', 'local' => 'Resposta das atividades'])
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="sparkline12-list mt-b-30">
            <div class="sparkline12-graph">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline12-list">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <h1><b>{{$atividades->descricao}}</b></h1><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(isset($atividades->url_anexos) &&  $atividades->url_anexos != '') : ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="sparkline12-list mt-b-30">
                <div class="sparkline12-graph">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="sparkline12-list">
                                <div class="sparkline12-hd">
                                    <div class="main-sparkline12-hd">
                                            <div id="foto_exite" style="display: block">
                                                <a alt="logo" class="img-circle m-b" href="<?= '../../'. $atividades->url_anexos ?>" target='_blank' style="width: 150px">Arquivo para download</a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>
    <form method="Post" action="{{ route('enviaratividade') }}">
        @csrf
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
                                                <h1><b> {{$atividade['pergunta']}}</b></h1><br>
                                                <input type="hidden" class="form-control" name="idsPerguntas[]" id="idsPergunta" value="<?= $atividade['id_pergunta'] ?>"/>
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
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            @foreach($respostas as $resposta)
                                                                                @if($resposta['id_pergunta'] == $atividade['id_pergunta'])
                                                                                    <label></label>
                                                                                    <label>
                                                                                        <input type="checkbox" name="resposta_pergunta_<?=$atividade['id_pergunta']?>[]" value="<?=$resposta['id']?>"> <i></i> {{$resposta['descricao']}}
                                                                                    </label>
                                                                                    <br>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                        <br><br>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($atividade['tipo'] == 2)
                                                <div class="sparkline12-graph">
                                                    <div class="basic-login-form-ad">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="all-form-element-inner">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <textarea type="text" class="form-control" placeholder="Descreva sua resposta" rows="5" name="resposta_pergunta_<?=$atividade['id_pergunta']?>" id="resposta_dissertativa"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <br><br>
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
                                    <input type="hidden" name="atividade" value="<?=$atividades->id?>">
                                    <input type="hidden" name="usuario" value="<?= Auth::user()->id ?>">
                                    <button type="submit" class="btn btn-custon-rounded-two btn-success">Enviar</button>
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
@endsection
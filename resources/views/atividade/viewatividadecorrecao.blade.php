@extends('layouts.app')

@section('content')
<div class="container-educa">
@include('componentes.breadcome', ['view' => 'Correção da atividade', 'viewanterior' => 'Atividades', 'local' => 'Resposta das atividades'])
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
    <form method="Post" action="{{ route('enviaratividade') }}">
        @csrf
        @if((isset($perguntas)) && (count($perguntas) > 0) )
            @foreach($perguntas as $pergunta)
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline12-list mt-b-30">
                        <div class="sparkline12-graph">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="sparkline12-list">
                                        <div class="sparkline12-hd">
                                            <div class="main-sparkline12-hd">
                                                <h1><b> {{$pergunta['pergunta']}}</b></h1><br>
                                            </div>
                                        </div>
                                        @if(isset($pergunta['tipo']))
                                            @if($pergunta['tipo'] == '1')
                                                <div class="sparkline12-graph">
                                                    <div class="basic-login-form-ad">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="all-form-element-inner">
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                                            @foreach($respostas as $resposta)
                                                                                @if($resposta['id_pergunta'] == $pergunta['id_pergunta'])
                                                                                    <label></label>
                                                                                    <label>
                                                                                        <input type="checkbox" name="resposta_pergunta" value="<?=$resposta['id']?>" <?= $resposta['id'] == $resposta['resposta_aluno'] ? 'checked':''; ?> disabled> {{$resposta['descricao']}} 
                                                                                        <div class="btn-group btn-custom-groups">
                                                                                            @if($resposta['resposta_certa'] == $resposta['id'])
                                                                                                <i style="color: green;border-radius: 30px;" class="fa fa-check edu-checked-pro" aria-hidden="true"></i> 
                                                                                            @elseif($resposta['certa'] == 'false')
                                                                                                @if($resposta['id'] == $resposta['resposta_aluno'])
                                                                                                <i style="color: red;border-radius: 30px;" class="fa fa-times edu-danger-error" aria-hidden="true"></i>
                                                                                                @endif
                                                                                            @endif
                                                                                        </div>
                                                                                        <i></i>
                                                                                    </label>
                                                                                    <label></label>
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
                                            @elseif($pergunta['tipo'] == 2)
                                                <div class="sparkline12-graph">
                                                    <div class="basic-login-form-ad">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="all-form-element-inner">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <textarea type="text" class="form-control" placeholder="Descreva sua resposta" rows="5" name="resposta_pergunta_<?=$pergunta['id_pergunta']?>" id="resposta_dissertativa" disabled>{{$pergunta['resposta_dissertativa']}}</textarea>
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
                                    <a href="{{ route('atividade') }}" type="button" class="btn btn-custon-rounded-two btn-danger"><span style="color: #FFF">Voltar</span></a>
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
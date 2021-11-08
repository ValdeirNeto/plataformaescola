@extends('layouts.app')

@section('content')
<div class="container-educa">
@include('componentes.breadcome', ['view' => $local .' Atividade', 'viewanterior' => 'Atividades', 'local' => $local])
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="sparkline12-list mt-b-30">
                <div class="sparkline12-hd">
                    <div class="main-sparkline12-hd">
                    </div>
                </div>
                <form method="Post" action="<?= $local === 'Editar' ? route('atividadeSave') : route('atividadeCreate');  ?>">
                    @csrf
                    <div class="sparkline12-graph">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="sparkline12-list">
                                    <div class="sparkline12-hd">
                                        <div class="main-sparkline12-hd">
                                        </div>
                                    </div>
                                    <div class="sparkline12-graph">
                                        <div class="basic-login-form-ad">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="all-form-element-inner">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" class="form-control" placeholder="Descrição Atividade" name="descricao" id="descricao"/>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" class="form-control" placeholder="Descrição Atividade" name="descricao_1" id="descricao"/>
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                        <div class="input-knob-dial-wrap" style="margin-bottom: 10px" align="right">
                                                            <div class="button-style-two btn-mg-b-10">
                                                                <input type="button" class="btn btn-custon-rounded-two btn-success" onclick="addQuestion()" value="Adicionar Pergunta">
                                                                <input type="button" class="btn btn-custon-rounded-two btn-danger" onclick="removeQuestion(this)" value="Remover Pergunta">
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                    <input type="text" class="form-control" placeholder="Pergunta" name="pergunta_0" id="pergunta_0"/>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                    <div class="form-select-list">
                                                                        <select class="form-control custom-select-value" name="account_0" id="tipo_pergunta_0" onchange="tipopergunta()">
                                                                            <option value="0">Tipo Pergunta</option>
                                                                            <option value="1">Multipla Escolha </option>
                                                                            <option value="2">Dissertativa</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="escolha_0"></div>
                                                    </div>
                                                    <br><br>
                                                    <div id="perguntas_0"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-style-two btn-mg-b-10">
                            <input type="hidden" name="id" value="<?= isset($atividade) ? $atividade->id : ''?>">
                            <button type="submit" class="btn btn-custon-rounded-two btn-success">Salvar</button>
                            <a href="{{ route('atividade') }}" type="button" class="btn btn-custon-rounded-two btn-danger"><span style="color: #FFF">Cancelar</span></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    let p = 0;
    let t = 0;
    function tipopergunta() {
        let select = document.getElementById('tipo_pergunta_'+p);
        let value = select.options[select.selectedIndex].value;
        let pergunta = document.getElementById('pergunta_'+p);
        if(pergunta.value == ''){
            alert('Por Favor insira uma pergunta');
            pergunta.focus();
        }else{
            if(value == '1'){
                let origem_id = "origem_"+p;
                let destino_id = "destino_"+p;
                $('#escolha_'+p).html('<div class="form-group-inner" id="multipla_escolha">'+
                                        '<div class="input-knob-dial-wrap" style="margin-bottom: 10px" align="right">'+
                                            '<div class="button-style-two btn-mg-b-10">'+
                                                '<input type="button" class="btn btn-custon-rounded-two btn-success" onclick="addEscolha()" value="Adicionar Resposta">  '+
                                                '<input type="button" class="btn btn-custon-rounded-two btn-danger" onclick="removeEscolha(this)" value="Remover Resposta">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="form-group-inner" id="'+origem_id+'">'+
                                            '<div class="row">'+
                                                '<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">'+
                                                    '<input type="text" class="form-control" name="pergunta_'+p+'_resposta[]" placeholder="Resposta"/>'+
                                                '</div>'+
                                                '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">'+
                                                '<div class="i-checks pull-left">'+
                                                        '<label>'+
                                                            '<input type="checkbox" name="pergunta_'+p+'_certa[]" value=""> <i></i> Certa'+
                                                        '</label>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div id="'+destino_id+'"></div>'+
                                    '</div>')
            }else{
                $('#escolha_'+p).html('')
            }
        }
    }
    

    let j = 0;

    function removeEscolha(obj){
        j--;
        let pai = document.getElementById('multipla_escolha');
        let filhos = pai.children.length;
        let id = filhos - 2;
        let idQuestion = 'resposta_'+id;
        console.log(idQuestion);
        document.getElementById(idQuestion).remove();
    }

    function addEscolha(){
        j++;
        let clone = document.getElementById('origem_'+p).cloneNode(true);
        let newId = "resposta_" + j;
        let destino = document.getElementById('destino_'+p);
        clone.setAttribute("id", newId);
        destino.appendChild(clone);
    }
    
    function removeQuestion(){
        t--;
        let id_pergunta = "#perguntas_"+t;
        p--;
        
        $(id_pergunta).html('');
    }

    function addQuestion(){
        let pergunta = document.getElementById('pergunta_'+p);
        if(pergunta.value == ''){
            alert('Por Favor insira uma pergunta');
            pergunta.focus();
        }else{
            
            let id_pergunta = "#perguntas_"+t;
            t++;
            p++;
            let pergunta_id = "pergunta_"+p;
            let tipo_pergunta_id = "tipo_pergunta_"+p
            let escolha_id = "escolha_"+p
            let div_pergunta = "perguntas_"+p;
            $(id_pergunta).html('<div class="form-group-inner">'+
                                    '<div class="row">'+
                                        '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">'+
                                            '<input type="text" class="form-control" placeholder="Pergunta" name="'+pergunta_id+'" id="'+pergunta_id+'"/>'+
                                        '</div>'+
                                        '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">'+
                                            '<div class="form-select-list">'+
                                                '<select class="form-control custom-select-value" name="account" id="'+tipo_pergunta_id+'" onchange="tipopergunta()">'+
                                                    '<option value="0">Tipo Pergunta</option>'+
                                                    '<option value="1">Multipla Escolha </option>'+
                                                    '<option value="2">Dissertativa</option>'+
                                                '</select>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<input type="hidden" name="qtd" value="'+p+'">'+
                                '<div id="'+escolha_id+'"></div><br><br>'+
                                '<div id="'+div_pergunta+'"></div>')
        }
        
    }
</script>
@endsection
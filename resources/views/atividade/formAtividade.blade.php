@extends('layouts.app')

@section('content')
<div class="container-educa">
@include('componentes.breadcome', ['view' => $local .' Atividade', 'viewanterior' => 'Atividades', 'local' => $local])
    <form method="Post" action="<?= route('atividadeCreate');  ?>" enctype="multipart/form-data">
        @csrf
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list mt-b-30">
                    <div class="sparkline12-graph">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="sparkline12-list">
                                    <div class="sparkline12-hd">
                                        <div class="main-sparkline12-hd">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <input type="text" class="form-control" placeholder="Descrição Atividade" name="descricao" id="descricao"/>
                                                </div>
                                            </div>
                                            <a href="#" data-toggle="modal" data-target="#PrimaryModalhdbgcl">Adicionar Perguntas</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-left: 1.4%; width: 97.4%">
                                <div class="file-upload-inner file-upload-inner-right ts-forms">
                                    <div class="input append-big-btn">
                                        <div class="file-button">
                                            Buscar
                                            <input type="file" name="arquivo" onchange="document.getElementById('append-big-btn').value = this.value;">
                                        </div>
                                        <input type="text" id="append-big-btn" name="arquivo" placeholder="Nenhum arquivo selecionado">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="perguntas"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list mt-b-30">
                    <div class="sparkline12-graph">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="sparkline12-list">
                                    <div class="button-style-two btn-mg-b-10">
                                        <input type="hidden" name="qtd" id="qtd">
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
<div id="PrimaryModalhdbgcl" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1" style="background: #284364">
                <h4 class="modal-title">Quantidade de Perguntas!</h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 10px">
                    <div class="form-group-inner">
                        <label>Quantidade dissertativa</label>
                        <input type="text" class="form-control" name="qtd_dissertativa" id="qtd_dissertativa"/>
                    </div>
                </div>
                <br>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 10px">
                    <div class="form-group-inner">
                        <label>Quantidade multipla escolha</label>
                        <input type="text" class="form-control" name="qtd_multi" id="qtd_multi"  onkeydown="keydown()"/>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 10px; display: none" id="escolha">
                    <div class="form-group-inner">
                        <label>Quantidade alteranativa multipla escolha</label>
                        <input type="text" class="form-control" name="qtd_multi" id="qtd_multi_alternativa"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a data-dismiss="modal" href="#" style="background: #284364">Cancelar</a>
                <a href="#" data-dismiss="modal" onclick="gera_pergunta()" style="background: #284364" id="proximo">Próximo</a>
            </div>
        </div>
    </div>
</div>
<script>
    function keydown(){
        let qtd_multi = document.getElementById('qtd_multi');
        if(qtd_multi.value > 0){
            $('#escolha').css('display', 'block');
        }
    }
    function gera_pergunta(){
        let qtd_dissertativa = document.getElementById('qtd_dissertativa');
        let qtd_multi = document.getElementById('qtd_multi');
        let qtd_multi_alternativa =document.getElementById('qtd_multi_alternativa');
        if(qtd_dissertativa.value > 0){
            for(var i= 0; i < qtd_dissertativa.value; i++){
                $('#perguntas').append('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
                    '<div class="sparkline12-list mt-b-30">'+
                        '<div class="sparkline12-graph">'+
                            '<div class="row">'+
                                '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
                                    '<div class="sparkline12-list">'+
                                        '<div class="sparkline12-hd">'+
                                        '<div class="main-sparkline12-hd">'+
                                                '<div class="row">'+
                                                    '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
                                                        '<input type="text" class="form-control" placeholder="Pergunta Dissertativa" name="pergunta_'+i+'"/>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>')
            }
        }
        if(qtd_multi.value > 0){
            for(var m= 0; m < qtd_multi.value; m++){
                $('#perguntas').append('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
                    '<div class="sparkline12-list mt-b-30">'+
                        '<div class="sparkline12-graph">'+
                            '<div class="row">'+
                                '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
                                    '<div class="sparkline12-list">'+
                                        '<div class="sparkline12-hd">'+
                                            '<div class="main-sparkline12-hd">'+
                                                '<div class="row">'+
                                                    '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
                                                        '<input type="text" class="form-control" placeholder="Pergunta Multipla escolha" name="pergunta_'+i+'"/>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div id="mult_'+m+'"></div>'+
                        '</div>'+
                    '</div>'+
                '</div>');  
                for(var r = 0; r < qtd_multi_alternativa.value; r++){
                        $('#mult_'+m).append('<div class="row" style="margin-bottom: 10px; margin-left: 5px">'+
                                            '<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">'+
                                                '<input type="text" class="form-control" id="resposta_'+r+'" name="pergunta_'+i+'_resposta[]" placeholder="Resposta"/>'+
                                            '</div>'+
                                            '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">'+
                                            '<div class="i-checks pull-left">'+
                                                    '<label>'+
                                                        '<input type="checkbox" id="certa_'+r+'" name="pergunta_'+i+'_certa[]" value="" onclick="certa('+r+')"> <i></i> Certa'+
                                                    '</label>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>');
                }
                i++;
            }
        }
        $('#qtd').val(i);
       
    }
    function certa(resposta){
            var valor = $('#resposta_'+resposta).val();
            $('#certa_'+resposta).val(valor);
        }
</script>
@endsection
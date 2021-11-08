@if(isset($comunicados) && count($comunicados) > 0)
    @foreach($comunicados as $comunicado)
        @if($comunicado->para == 'todos' && in_array($permissao_usuario, ['admin','professor','coordenador','aluno']))
            <div class="analytics-sparkle-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                            <div class="analytics-sparkle-line reso-mg-b-30">
                                <div class="analytics-content">
                                    <h5>Comunicado do {{$comunicado->de}}</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-9 col-md-6 col-sm-6 col-xs-12">
                                            <h4><span class=""><?=str_ireplace(array("\r","\n",'\r','\n'),'<br>', $comunicado->mensagem)?></span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($comunicado->para == 'coordenador' && in_array($permissao_usuario, ['admin','coordenador']))
            <div class="analytics-sparkle-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                            <div class="analytics-sparkle-line reso-mg-b-30">
                                <div class="analytics-content">
                                    <h5>Comunicado do {{$comunicado->de}}</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-9 col-md-6 col-sm-6 col-xs-12">
                                            <h4><span class=""><?=str_ireplace(array("\r","\n",'\r','\n'),'<br>', $comunicado->mensagem)?></span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($comunicado->para == 'professor' && in_array($permissao_usuario, ['admin','professor']))
            <div class="analytics-sparkle-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                            <div class="analytics-sparkle-line reso-mg-b-30">
                                <div class="analytics-content">
                                    <h5>Comunicado do {{$comunicado->de}}</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-9 col-md-6 col-sm-6 col-xs-12">
                                            <h4><span class=""><?=str_ireplace(array("\r","\n",'\r','\n'),'<br>', $comunicado->mensagem)?></span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($comunicado->para == 'aluno' && in_array($permissao_usuario, ['admin','aluno']))
            <div class="analytics-sparkle-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                            <div class="analytics-sparkle-line reso-mg-b-30">
                                <div class="analytics-content">
                                    <h5>Comunicado do {{$comunicado->de}}</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-9 col-md-6 col-sm-6 col-xs-12">
                                            <h4><span class=""><?=str_ireplace(array("\r","\n",'\r','\n'),'<br>', $comunicado->mensagem)?></span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endif
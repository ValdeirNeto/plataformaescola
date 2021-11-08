@if(isset($atividades) && count($atividades) > 0)
<div class="analytics-sparkle-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30">
                    <div class="analytics-content">
                        <h5>Atividades a Realizar</h5>
                        <hr>
                        @foreach($atividades as $atividade)
                            <div class="row">
                                <div class="col-lg-9 col-md-6 col-sm-6 col-xs-12">
                                    <h4><span class="">{{$atividade->descricao}}</span></h4>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" align='right'>
                                    <button >teste</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<div id="padrao">
    @include('componentes.comunicado')
    <!-- <h3>historia da escola</h3> -->
</div>

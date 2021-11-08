<div style="margin-bottom: 20px">
<button onclick="analitica()" id="btnanalitica" >Dashboard analitica</button>
<button onclick="padrao()" id="btnpadrao" style="display: none">Dashboard Padrão</button>
</div>
<div class="analytics-sparkle-area" id="analitica" style="display: none">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30">
                    <div class="analytics-content">
                        <h5>Alunos Cadastrados</h5>
                        <h2><span class="">{{$alunos}}</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30">
                    <div class="analytics-content">
                        <h5>Professores Cadastrados</h5>
                        <h2><span class="">{{$professores}}</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30">
                    <div class="analytics-content">
                        <h5>Turmas Cadastrados</h5>
                        <h2><span class="">{{$turma}}</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30">
                    <div class="analytics-content">
                        <h5>Alunos Cadastrados</h5>
                        <h2><span class="">{{$alunos}}</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="padrao">
    @include('componentes.comunicado')
    <!-- <h3>historia da escola</h3> -->
</div>

<script>
    function analitica(){
        $('#padrao').css('display','none')
        $('#analitica').css('display','block')
        $('#btnpadrao').css('display','block')
        $('#btnanalitica').css('display','none')
    }
    function padrao(){
        $('#padrao').css('display','block')
        $('#analitica').css('display','none')
        $('#btnpadrao').css('display','none')
        $('#btnanalitica').css('display','block')
    }
</script>
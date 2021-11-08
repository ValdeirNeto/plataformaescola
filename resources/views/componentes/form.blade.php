<div class="container-fluid">
    <div class="sparkline12-list mt-b-30">
        <div class="sparkline12-graph">
            <div class="basic-login-form-ad">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="all-form-element-inner">
                            <form name="form" method="Post" action="<?= isset($rotaupload) ? route($rotaupload) : ($local === 'Editar' ? route($rotaedit) : route($rotapost)); ?>" enctype="multipart/form-data">  
                                @csrf
                                <?php if(isset($campos) && count($campos) > 0) : ?>
                                    <?php for($i =0; $i < count($campos); $i++) :?>
                                        <?php $adicionais = in_array($campos[$i],['cpf', 'cpf_pai', 'cpf_mae', 'cpf_responsavel']) ? 'maxlength=14 onKeyPress="MascaraCPF(form.'.$campos[$i].');"': 
                                              (in_array($campos[$i],['rg','rg_pai','rg_mae','rg_responsavel']) ? 'maxlength=12 onKeyPress="MascaraRG(form.'.$campos[$i].');"' : 
                                              (in_array($campos[$i],['cep']) ? 'maxlength=12 onKeyPress="MascaraCep(form.'.$campos[$i].');"': 
                                              (in_array($campos[$i],['telefone', 'telefone_mae', 'telefone_pai', 'telefone_responsavel']) ? 'maxlength=14 onKeyPress="MascaraTelefone(form.'.$campos[$i].');"': 
                                              (in_array($campos[$i],['celular', 'celular_mae', 'celular_pai', 'celular_responsavel']) ? 'maxlength=15 onKeyPress="MascaraCelular(form.'.$campos[$i].');"' : 
                                              (in_array($campos[$i],['data_nascimento']) ? 'maxlength=10 onKeyPress="MascaraData(form.'.$campos[$i].');"' :
                                              (in_array($campos[$i],['data_validade']) ? 'maxlength=10 onKeyPress="MascaraData(form.'.$campos[$i].');"' : '' ))))));
                                        ?>
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                    <label class="login2 pull-left pull-left-pro"><?= $label[$i] ?></label>
                                                </div>
                                                <?php if(!in_array($tipo[$i], ['select','file','textarea','radio'])) : ?>
                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="width: 80%">
                                                        <input type="<?= $tipo[$i]; ?>" class="form-control" 
                                                        <?= $adicionais ?> id="<?= $campos[$i] ?>" name="<?= $campos[$i] ?>" value="<?= (isset($valor)) ? $valor[0][$campos[$i]] : ''?>"/>
                                                        <?php if($adicionais != ''):?>
                                                            <span class="help-block" id='valido_<?= $campos[$i]?>' style="display: none"></span>
                                                        <?php endif;?>
                                                        <?php if($campos[$i] === 'nome_dos_filhos'):?>
                                                            <span class="help-block">Separe os nomes por ','</span>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php elseif(!in_array($tipo[$i],['file','textarea','radio'])): ?>
                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="width: 80%">
                                                        <div class="form-select-list">
                                                            <select class="form-control custom-select-value" name="<?= $campos[$i] ?>">
                                                                <option value=""></option>
                                                                <?php if(isset($valorperido) && $campos[$i] === 'horario'): ?>
                                                                    <?php for($g=0; $g < count($valorperido); $g++) : ?>
                                                                        <option value="<?= $valorperido[$g]['id'] ?>" <?= isset($valor) && $valor_id_periodo == $valorperido[$g]['id'] ? 'selected': ''?>><?= $valorperido[$g]['name']?></option>
                                                                    <?php endfor;?>
                                                                <?php elseif($campos[$i] !== 'genero' && $campos[$i] !== 'para') :?>
                                                                    <?php foreach($valorselect as $valors) : ?>
                                                                        <option value="<?= $valors->id ?>" <?= isset($valor) && $valor_id == $valors->id ? 'selected': ''?>><?= $valors->name?></option>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <?php for($g=0; $g < count($valorselect); $g++) : ?>
                                                                        <option value="<?= $valorselect[$g]['id'] ?>" <?= isset($valor) && $valor_id == $valorselect[$g]['id'] ? 'selected': ''?>><?= $valorselect[$g]['name']?></option>
                                                                    <?php endfor;?>
                                                                <?php endif;?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                <?php elseif(!in_array($tipo[$i],['file','radio'])): ?>
                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="width: 80%">
                                                        <div class="form-group res-mg-t-15">
                                                            <textarea id="<?= $campos[$i] ?>" name="<?= $campos[$i] ?>"><?= (isset($valor)) ? $valor[0][$campos[$i]] : ''?></textarea>
                                                        </div>
                                                    </div>
                                                <?php elseif(!in_array($tipo[$i], ['file'])): ?>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                                        <div class="bt-df-checkbox">
                                                            <input class="pull-left" type="radio"  value="1" id="status1" name="status" style="margin-right: 8px;" <?= isset($valor) ? (($valor[0][$campos[$i]] == '1') ? 'checked=""' :'' ) : 'checked=""' ?>><label>  Ativo</label><br>
                                                            <input class="pull-left" type="radio" value="0" id="status2" name="status" style="margin-right: 8px;" <?= isset($valor) ? (($valor[0][$campos[$i]] == '0') ? 'checked=""' :'') :''  ?>><label> Inativo</label>
                                                        </div>
                                                    </div>
                                                <?php else:?>
                                                    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="width: 80%">
                                                        <?php if(isset($valor) &&  $valor[0][$campos[$i]] != '') : ?>
                                                            <div id="foto_exite" style="display: block">
                                                                <img alt="logo" class="img-circle m-b" src="<?= '../../' . $valor[0][$campos[$i]]?>" style="width: 150px">
                                                                <input type="button" class="btn btn-custon-rounded-two btn-primary" onclick="alterar()" value="Alterar">
                                                            </div>
                                                            <div class="file-upload-inner file-upload-inner-right ts-forms" id="alterar" style="display: none">
                                                                <div class="input append-big-btn">
                                                                    <div class="file-button">
                                                                        Buscar
                                                                        <input type="file" id="foto" name="arquivo" onchange="document.getElementById('append-big-btn').value = this.value;">
                                                                    </div>
                                                                    <input type="text" id="append-big-btn" name="<?= $campos[$i] ?> "placeholder="Nenhum arquivo selecionado">
                                                                </div>
                                                            </div>
                                                        <?php else:?>
                                                        <div class="file-upload-inner file-upload-inner-right ts-forms">
                                                            <div class="input append-big-btn">
                                                                <div class="file-button">
                                                                    Buscar
                                                                    <input type="file" name="arquivo" onchange="document.getElementById('append-big-btn').value = this.value;">
                                                                </div>
                                                                <input type="text" id="append-big-btn" name="<?= $campos[$i] ?>" placeholder="Nenhum arquivo selecionado">
                                                            </div>
                                                        </div>
                                                        <?php endif;?>
                                                    </div>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    <?php endfor;?>
                                <?php endif; ?>
                                <div class="button-style-two btn-mg-b-10">
                                    <input type="hidden" name="id" value="<?= isset($valor) ? $valor[0]['id'] : ''?>">
                                    <button type="submit" class="btn btn-custon-rounded-two btn-success">Salvar</button>
                                    <a href="<?= route($rotacancela) ?>" type="button" class="btn btn-custon-rounded-two btn-danger"><span style="color: #FFF">Cancelar</span></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function alterar(){
        $('#foto_exite').css('display', 'none');
        $('#alterar').css('display', 'block');
        $('#foto').click();
    }
    function MascaraCPF(cpf){
        if(mascaraInteiro(cpf)==false){
            event.returnValue = false;
        } 
        return formataCampo(cpf, '000.000.000-00', event);
    }
    function MascaraTelefone(telefone){
        if((telefone)==false){
                event.returnValue = false;
        }       
        return formataCampo(telefone, '(00) 0000-0000', event);
    }
    function MascaraCelular(celular){
        if((celular)==false){
                event.returnValue = false;
        }       
        return formataCampo(celular, '(00) 00000-0000', event);
    }
    function MascaraRG(rg){
        if((rg)==false){
                event.returnValue = false;
        }       
        return formataCampo(rg, '00.000.000-0', event);
    }
    function MascaraCep(cep){
        if(mascaraInteiro(cep)==false){
            event.returnValue = false;
        }       
        return formataCampo(cep, '00.000-000', event);
    }
    function MascaraData(data){
        if(mascaraInteiro(data)==false){
            event.returnValue = false;
        }       
        return formataCampo(data, '00/00/0000', event);
    }
    function mascaraInteiro(){
        if (event.keyCode < 48 || event.keyCode > 57){
                event.returnValue = false;
                return false;
        }
        return true;
    }
    function formataCampo(campo, Mascara, evento) { 
        var boleanoMascara; 

        var Digitato = evento.keyCode;
        exp = /\-|\.|\/|\(|\)| /g
        campoSoNumeros = campo.value.toString().replace( exp, "" ); 

        var posicaoCampo = 0;    
        var NovoValorCampo="";
        var TamanhoMascara = campoSoNumeros.length;; 

        if (Digitato != 8) { // backspace 
                for(i=0; i<= TamanhoMascara; i++) { 
                        boleanoMascara  = ((Mascara.charAt(i) == "-") || (Mascara.charAt(i) == ".")
                                                                || (Mascara.charAt(i) == "/")) 
                        boleanoMascara  = boleanoMascara || ((Mascara.charAt(i) == "(") 
                                                                || (Mascara.charAt(i) == ")") || (Mascara.charAt(i) == " ")) 
                        if (boleanoMascara) { 
                                NovoValorCampo += Mascara.charAt(i); 
                                  TamanhoMascara++;
                        }else { 
                                NovoValorCampo += campoSoNumeros.charAt(posicaoCampo); 
                                posicaoCampo++; 
                          }              
                  }      
                campo.value = NovoValorCampo;
                  return true; 
        }else { 
                return true; 
        }
    }
</script>
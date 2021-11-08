$(document).ready(function() {
    // $("#ultima").css('text-align',"right")
    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#estado").val("");
    }
    
    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#estado").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        $('#valido_cep').html('');
                        //Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#estado").val(dados.uf);

                        $("#numero").focus();
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        $('#valido_cep').html('CEP não encontrado.');
                        $('#valido_cep').css('display', 'block');
                        $('#valido_cep').css('color', 'red');
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                $('#valido_cep').html('Formato de CEP inválido.');
                $('#valido_cep').css('display', 'block');
                $('#valido_cep').css('color', 'red');
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });

    $('#nav_mobile').click(function () {
        $('#seta').attr('class','fa fa-angle-up')
        var remove = $(this).attr('remove');
        $('#sub_menu_mobile').css('display', 'block')
        $('#nav_mobile').attr('remove', 'nav_mobile2')
        if(remove == 'nav_mobile2'){
            $('#seta').attr('class','fa fa-angle-down')
            $('#sub_menu_mobile').css('display', 'none')
            $('#nav_mobile').removeAttr('remove')
        }
        
    });

    $('#nav_mobile2').click(function () {
        $('#sub_menu_mobile').css('display', 'none')
        $('#nav_mobile').attr('id', 'nav_mobile')
    });

    $('#nav_profile').click(function () {
        $('#seta_profile').attr('class','fa fa-angle-up')
        var remove = $(this).attr('remove');
        $('#sub_menu_profile').css('display', 'block')
        $('#sub_menu').css('display', 'none')
        $('#nav_profile').attr('remove', 'nav_profile2')
        if(remove == 'nav_profile2'){
            $('#seta_profile').attr('class','fa fa-angle-down')
            $('#sub_menu_profile').css('display', 'none')
            $('#sub_menu').css('display', 'block')
            $('#nav_profile').removeAttr('remove')
        }
        
    });

    $('#nav_profile2').click(function () {
        $('#sub_menu_profile').css('display', 'none')
        $('#nav_profile').attr('id', 'nav_profile')
    });
    
    $('#cpf').blur(function (){
        var cpf_valor = $(this).val();
        cpf(cpf_valor, 'cpf', 'CPF')
    });

    $('#cpf_mae').blur(function (){
        var cpf_valor  = $(this).val();
        cpf(cpf_valor, 'cpf_mae', 'CPF da Mãe')
    });

    $('#cpf_pai').blur(function (){
        var cpf_valor  = $(this).val();
        cpf(cpf_valor, 'cpf_pai', 'CPF do Pai')
    });

    $('#cpf_responsavel').blur(function (){
        var cpf_valor  = $(this).val();
        cpf(cpf_valor, 'cpf_responsavel', 'CPF do Responsável')
    });

    function cpf(cpf, local, pessoa){
        cpf = cpf.replace('.','');
        cpf = cpf.replace('.','');
        cpf = cpf.replace('-','');
        
        erro = new String;
        if (cpf.length < 11) erro += 'Sao necessarios 11 digitos para verificacao do '+pessoa+'! \n\n'; 
        var nonNumbers = /\D/;
        if (nonNumbers.test(cpf)) erro += 'A verificacao de '+pessoa+' suporta apenas numeros! \n\n';  
        if (cpf == "00000000000" || cpf == "11111111111" || 
        cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || 
        cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || 
        cpf == "88888888888" || cpf == "99999999999"){
            erro += 'Numero de '+pessoa+' invalido!'
        }
        var a = [];
        var b = new Number;
        var c = 11;
        for (i=0; i<11; i++){
            a[i] = cpf.charAt(i);
            if (i <  9) b += (a[i] *  --c);
        }
        if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
        b = 0;
        c = 11;
        for (y=0; y<10; y++) b += (a[y] *  c--); 
        if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }
        status = a[9] + ""+ a[10]
        if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10])){
            erro +="Digito verificador com problema!";
        }
        if (erro.length > 0){
            $('#valido_'+local+'').html(erro);
            $('#valido_'+local+'').css('display', 'block');
            $('#valido_'+local+'').css('color', 'red');
            return false;
        }else{
            $('#valido_'+local+'').html('CPF valido');
            $('#valido_'+local+'').css('display', 'block');
            $('#valido_'+local+'').css('color', 'green');
            return true;
        }
    }
});

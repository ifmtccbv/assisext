/* #################     FUNÇÕES DE CARREGAMENTO    ####################### */
function mostrarCarregando(){
    $('#loading').css('display', 'block').fadeIn(1000);
};

function aposCarregamento(){
      $('#loading').fadeOut(500);
}

function sucesso(dados){
	aposCarregamento();
	$('#corpo').html(dados);
}

function sucessoDiv(div, dados) {
	aposCarregamento();
	$('#' + div).html(dados);
}

function sucessoFiltro(dados){
	aposCarregamento();
	$('#resultadoPesquisa').html(dados);
}

function sucessoFuncao(dados){
	aposCarregamento();
	$('#resultadoFuncao').html(dados);
}

function erro()
{
	aposCarregamento();
	alert('ERRO!');
}

/**
 * 
 * @param desabilitar -> array de itens para desabilitar
 * @param esconder -> array de itens para esconder
 * @return void
 * 
 */
function escondeDivGeral(desabilitar, esconder){
	for (var i in desabilitar){
		//navego pelas chaves do array como um for
		document.getElementById(desabilitar[i]).disabled = true;
	}
	for (var i in esconder){
		//navego pelas chaves do array como um for
		//document.getElementById(desabilitar[i]).disabled = true;
		$('#'+esconder[i]).fadeOut(100);
	}
}

function habilitaCircuito(){
	if(document.getElementById('chk_dinamico').checked == true)
		document.getElementById('cmb_circuito').disabled = true;
	else
		document.getElementById('cmb_circuito').disabled = false;
}

/*USADO PARA ESCONDER E DESATIVAR COMBOS CIDADES*/
function escondeDiv(id){
	document.getElementById('txt_codigoCliente'+id).disabled = true;
	document.getElementById('txt_data'+id).disabled = true;
	document.getElementById('txt_hora'+id).disabled = true;
	document.getElementById('cmb_tipoEntrega'+id).disabled = true;
	$('#div_ordem'+id).fadeOut(100);
}

function escondeDivParadas(id){
	document.getElementById('cmb_tipoParada'+id).disabled = true;
	document.getElementById('cmb_cidade'+id).disabled = true;
	document.getElementById('txt_tempo'+id).disabled = true;
	$('#div_ordem'+id).fadeOut(100);
}


function escondeDivParadaProgramada(id){
	document.getElementById('cmb_tipoParada'+id).disabled = true;
	document.getElementById('cmb_cidade'+id).disabled = true;
	document.getElementById('txt_data'+id).disabled = true;
	document.getElementById('txt_fim'+id).disabled = true;
	$('#div_ordem'+id).fadeOut(100);
}

function escondePesquisaCliente(){
	$('#busca').fadeOut(500);
	$('#esconde').fadeOut(500);
	document.getElementById('mostraMais').style.visibility="visible";
	$('#mostraMais').fadeIn(500);
}
function mostraPesquisaCliente(){
	$('#busca').fadeIn(500);
	$('#mostraMais').fadeOut(500);
	$('#esconde').fadeIn(500);
}

function mostraDiv(id){
	if(document.getElementById(id).style.display!="none"){
		$('#'+id).fadeOut(500);	
	}else{
		$('#'+id).fadeIn(500);
	}
}

function sobeDiv(id, img){
	if(document.getElementById(id).style.display!="none"){
		document.getElementById('img'+img).src="imagens/showBox.png";
		$('#'+id).slideUp(500);
	}else{
		document.getElementById('img'+img).src="imagens/hideBox.png";
		$('#'+id).slideDown(500);
	}
}

function geraTransporte(campo){
	Todays = new Date();
    var transporte = '9'+''+Todays.getMonth()+''+Todays.getDay()+''+''+Todays.getSeconds()+''+Todays.getHours()+''+Todays.getMinutes();
    while(transporte<1000000 || transporte>9999999){
    	if(transporte<10000000)
    		transporte = transporte*10;
    	if(transporte>9999999)
    		transporte = parseInt(transporte/10);
    }
    if(campo.checked==true){
		$("#txt_transporte").val(unescape(transporte));
		document.getElementById('txt_transporte').setAttribute('readonly',true);
	}else{
		$("#txt_transporte").val(unescape(''));
		document.getElementById('txt_transporte').setAttribute('readonly',false);
	}	
}

function habilitaEntradaESaidaDeposito(valor){
	if(valor=='6'){
		$('#div_entradaESaidaDoDeposito').fadeIn(500);	
		document.getElementById('cmb_depositoTransportadora').disabled=false;
		document.getElementById('txt_dataEntrada').disabled=false;
		document.getElementById('txt_horaEntrada').disabled=false;
		document.getElementById('txt_dataSaida').disabled=false;
		document.getElementById('txt_horaSaida').disabled=false;
	}else{
		$('#div_entradaESaidaDoDeposito').fadeOut(500);
		document.getElementById('cmb_depositoTransportadora').disabled=true;
		document.getElementById('txt_dataEntrada').disabled=true;
		document.getElementById('txt_horaEntrada').disabled=true;
		document.getElementById('txt_dataSaida').disabled=true;
		document.getElementById('txt_horaSaida').disabled=true;
	}
	if(valor=='4'){
		$('#div_transitPoint').fadeIn(500);	
		document.getElementById('cmb_centroLogistico').disabled=false;
	}else{
		$('#div_transitPoint').fadeOut(500);	
		document.getElementById('cmb_centroLogistico').disabled=true;
	}
}

function habilitaCentro(campo){
	if(campo.checked==true){
		document.getElementById('lbl_centroLogistico').style.display='block';
		document.getElementById('cmb_centroLogistico').style.display='block';
		document.getElementById('cmb_centroLogistico').disabled=false;
	}else{
		document.getElementById('lbl_centroLogistico').style.display='none';
		document.getElementById('cmb_centroLogistico').style.display='none';
		document.getElementById('cmb_centroLogistico').disabled=true;
	}	
}

function deletaPerfil(){
   $('#carregando').fadeOut(1000);
}

function habilitar(campo, campoHabilitar){
	
	if(campo.checked==true)
		campoHabilitar.disabled = false;
	else
		campoHabilitar.disabled=true;

}


function numeroDedicado(){

	if(document.getElementById('cmb_propriedade').value==4){
		$("#div_numeroDedicado").fadeIn(200);
		document.getElementById('txt_numeroDedicado').disabled=false;
	}else{
		$("#div_numeroDedicado").fadeOut(200);
		document.getElementById('txt_numeroDedicado').disabled=true;
	}
	
}

function tipoCarregamento(){

	if(document.getElementById('cmb_tipoCarregamento').value==4){
		$("#div_dedicado").fadeIn(200);
		document.getElementById('cmb_dedicado').disabled=false;
		$("#div_dBelgo").fadeOut(200);
		$("#div_naoEDedicado").fadeOut(200);
		document.getElementById('txt_dBelgo').disabled=true;
		document.getElementById('cmb_circuito').disabled=false;
		document.getElementById('cmb_transportadora').disabled=true;
		document.getElementById('cmb_tipoViagem').disabled=true;
		document.getElementById('cmb_tipoVeiculo').disabled=true;
		document.getElementById('cmb_motorista').disabled=true;
		$("#div_destinoViagem").fadeIn(200);
	}else if(document.getElementById('cmb_tipoCarregamento').value==8){
		$("#div_dBelgo").fadeIn(200);
		document.getElementById('txt_dBelgo').disabled=false;
		$("#div_dedicado").fadeOut(200);
		$("#div_naoEDedicado").fadeIn(200);
		document.getElementById('cmb_circuito').disabled=true;
		document.getElementById('cmb_dedicado').disabled=true;
		document.getElementById('txt_dBelgo').disabled=false;
		document.getElementById('cmb_transportadora').disabled=false;
		document.getElementById('cmb_tipoViagem').disabled=false;
		document.getElementById('cmb_tipoVeiculo').disabled=false;
		document.getElementById('cmb_motorista').disabled=false;
	}else{
		$("#div_dBelgo").fadeOut(200);
		document.getElementById('txt_dBelgo').disabled=true;
		$("#div_dedicado").fadeOut(200);
		$("#div_naoEDedicado").fadeIn(200);
		document.getElementById('cmb_circuito').disabled=true;
		document.getElementById('cmb_dedicado').disabled=true;
		document.getElementById('txt_dBelgo').disabled=true;
		document.getElementById('cmb_transportadora').disabled=false;
		document.getElementById('cmb_tipoViagem').disabled=false;
		document.getElementById('cmb_tipoVeiculo').disabled=false;
		document.getElementById('cmb_motorista').disabled=false;
	}
}

var ordem = 0;
function adicionaDestino(){
	ordem++;
	$.ajax({async: true,
		type: "POST",
		dataType: "html",
		url: "oe/adicionaOE.php",
		data: "retornaCidade=1+&ordem="+ordem,
		beforeSend: mostrarCarregando,
		success: function(txt) {
			
			aposCarregamento();
			var html = $('#div_destinoViagem').html();
			$('#div_destinoViagem').html(html+txt);
			
		},
		error: erro
	   });
	
	return false;		
				
}

var ordemParadaProgramada = 0;
function adicionaParadaProgramada(){
	ordemParadaProgramada++;
	$.ajax({async: true,
		type: "POST",
		dataType: "html",
		url: "planodeviagem/adicionaPlanoDeViagem.php",
		data: "retornaCidade=1+&ordem="+ordemParadaProgramada,
		beforeSend: mostrarCarregando,
		success: function(txt) {
			aposCarregamento();
			var html = $('#div_paradaProgramada').html();
			$('#div_paradaProgramada').html(html+txt);
		},
		error: erro
	   });
	
	return false;		
				
}

function filtraPlaca(id_transportadora, id_motorista){
	$.ajax({async: true,
		type: "POST",
		dataType: "html",
		url: "oe/adicionaOE.php",
		data: "transportadora="+id_transportadora+"&id_motorista="+id_motorista+"&filtraPlaca=1",
		beforeSend: mostrarCarregando,
		success: function(txt) {
			aposCarregamento();
			$('#div_selectMotorista').html(txt);
		},
		error: erro
	   });
return false;
}

function filtraDedicado(id_dedicado, id_motorista){
	
	$.ajax({async: true,
		type: "POST",
		dataType: "html",
		url: "oe/adicionaOE.php",
		data: "dedicado="+id_dedicado+"&id_motorista="+id_motorista+"&filtraDedicado=1",
		beforeSend: mostrarCarregando,
		success: function(txt) {
			
			aposCarregamento();
			$('#div_eDedicado').html(txt);
			
		},
		error: erro
	   });
return false;
	
}

/* #################     FUNÇÃO PARA SELECIONAR PLACA DE ACORDO COM O TIPO    ####################### */
function selecionaPlaca(tipo){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "veiculo/dedicado.php",
			data: "tipoVeiculo="+tipo ,
			beforeSend: mostrarCarregando,
			success: function(dados){
						aposCarregamento();
						$('#div_placaVeiculos').html(dados);
					},
			error: erro
		   });
	return false;
}

function buscaRastreador(placa){
	
	$.ajax({async: true,
		type: "POST",
		dataType: "html",
		url: "oe/adicionaOE.php",
		data: "placa="+placa+"&filtraRastreador=1",
		beforeSend: mostrarCarregando,
		success: function(txt) {
			
			aposCarregamento();
			$('#div_rastreador').html(txt);
			
		},
		error: erro
	   });
return false;
	
}

function buscaEixo(id_veiculo, div){
	
	$.ajax({async: true,
		type: "POST",
		dataType: "html",
		url: "oe/adicionaOE.php",
		data: "id_veiculo="+id_veiculo+"&filtraEixo=1",
		beforeSend: mostrarCarregando,
		success: function(txt) {
			aposCarregamento();
			$('#'+div).html(txt);
		},
		error: erro
	   });
return false;
	
}

function buscaCarroceria(id_veiculo){
	
	$.ajax({async: true,
		type: "POST",
		dataType: "html",
		url: "oe/adicionaOE.php",
		data: "id_veiculo="+id_veiculo+"&filtraCarroceria=1",
		beforeSend: mostrarCarregando,
		success: function(txt) {
			aposCarregamento();
			$('#div_carroceria').html(txt);
		},
		error: erro
	   });
return false;
	
}


function buscaGRMotorista(id_motorista){
	
	$.ajax({async: true,
		type: "POST",
		dataType: "html",
		url: "oe/adicionaOE.php",
		data: "id_motorista="+id_motorista+"&filtraGR=1",
		beforeSend: mostrarCarregando,
		success: function(txt) {
			
			aposCarregamento();
			$('#div_grMotorista').html(txt);
			
		},
		error: erro
	   });
return false;
	
}

function placaOE(){
	
	//DESATIVA TUDO
	if(document.getElementById('cmb_tipoVeiculo').value==0){
		document.getElementById('cmb_placaTruck').disabled=false;
		document.getElementById('cmb_placaCavalo').disabled=true;
		document.getElementById('cmb_placaCarreta').disabled=true;
		document.getElementById('cmb_placaCarretaBitrem').disabled=true;
		document.getElementById('cmb_placaVan').disabled=true;
		document.getElementById('cmb_placaToco').disabled=true;
		$("#divPlacaTruck").fadeOut(200);
		$("#divPlacaCavalo").fadeOut(200);
		$("#divPlacaCarreta").fadeOut(200);
		$("#divPlacaBitrem").fadeOut(200);
		$("#divPlacaVan").fadeOut(200);
		$("#divPlacaToco").fadeOut(200);
	
	//ATIVA TRUCK
	}else if(document.getElementById('cmb_tipoVeiculo').value==1){
		$("#divPlacaTruck").fadeIn(200);
		document.getElementById('cmb_placaTruck').disabled=false;
		document.getElementById('cmb_placaCavalo').disabled=true;
		document.getElementById('cmb_placaCarreta').disabled=true;
		document.getElementById('cmb_placaCarretaBitrem').disabled=true;
		document.getElementById('cmb_placaVan').disabled=true;
		document.getElementById('cmb_placaToco').disabled=true;
		$("#divPlacaCavalo").fadeOut(200);
		$("#divPlacaCarreta").fadeOut(200);
		$("#divPlacaBitrem").fadeOut(200);
		$("#divPlacaVan").fadeOut(200);
		$("#divPlacaToco").fadeOut(200);

	//ATIVA BITREM
	}else if(document.getElementById('cmb_tipoVeiculo').value==3){
		$("#divPlacaBitrem").fadeIn(200);
		document.getElementById('cmb_placaCarretaBitrem').disabled=false;
		$("#divPlacaTruck").fadeOut(200);
		$("#divPlacaVan").fadeOut(200);
		$("#divPlacaCarreta").fadeOut(200);
		$("#divPlacaCavalo").fadeIn(200);
		$("#divPlacaToco").fadeOut(200);
		document.getElementById('cmb_placaTruck').disabled=true;
		document.getElementById('cmb_placaCarreta').disabled=true;
		document.getElementById('cmb_placaCavalo').disabled=false;
		document.getElementById('cmb_placaVan').disabled=true;
		document.getElementById('cmb_placaToco').disabled=true;

		//ATIVA CARRETA
	}else if(document.getElementById('cmb_tipoVeiculo').value==4){
		$("#divPlacaCarreta").fadeIn(200);
		document.getElementById('cmb_placaCarreta').disabled=false;
		$("#divPlacaTruck").fadeOut(200);
		$("#divPlacaVan").fadeOut(200);
		$("#divPlacaBitrem").fadeOut(200);
		$("#divPlacaCavalo").fadeIn(200);
		$("#divPlacaToco").fadeOut(200);
		document.getElementById('cmb_placaTruck').disabled=true;
		document.getElementById('cmb_placaCarretaBitrem').disabled=true;
		document.getElementById('cmb_placaCavalo').disabled=false;
		document.getElementById('cmb_placaVan').disabled=true;

	//ATIVA VAN
	}else if(document.getElementById('cmb_tipoVeiculo').value==5){
		$("#divPlacaVan").fadeIn(200);
		document.getElementById('cmb_placaVan').disabled=false;
		$("#divPlacaTruck").fadeOut(200);
		$("#divPlacaCarreta").fadeOut(200);
		$("#divPlacaBitrem").fadeOut(200);
		$("#divPlacaCavalo").fadeOut(200);
		$("#divPlacaToco").fadeOut(200);
		document.getElementById('cmb_placaTruck').disabled=true;
		document.getElementById('cmb_placaCarretaBitrem').disabled=true;
		document.getElementById('cmb_placaCavalo').disabled=true;
		document.getElementById('cmb_placaCarreta').disabled=true;
		document.getElementById('cmb_placaToco').disabled=true;
		
		//ATIVA TOCO
	}else if(document.getElementById('cmb_tipoVeiculo').value==6){
		$("#divPlacaToco").fadeIn(200);
		document.getElementById('cmb_placaToco').disabled=false;
		$("#divPlacaTruck").fadeOut(200);
		$("#divPlacaCarreta").fadeOut(200);
		$("#divPlacaBitrem").fadeOut(200);
		$("#divPlacaCavalo").fadeOut(200);
		$("#divPlacaVan").fadeOut(200);
		document.getElementById('cmb_placaTruck').disabled=true;
		document.getElementById('cmb_placaCarretaBitrem').disabled=true;
		document.getElementById('cmb_placaCavalo').disabled=true;
		document.getElementById('cmb_placaCarreta').disabled=true;
		document.getElementById('cmb_placaVan').disabled=true;
		
	}
	
	document.getElementById('cmb_carroceria').disabled=true;
	
}

function statusOE(){
	//ATIVA TRUCK
	if(document.getElementById('cmb_statusOE').value==9){
		$("#div_status").fadeIn(200);
	    document.getElementById('txt_observacao').disabled=false;
	
	}else{ 
		$("#div_status").fadeOut(200);
	    document.getElementById('txt_observacao').disabled=true;
	}	
}


// ############################         FUNCAO PARA VALIDAR E-MAIL           ############################
function validaEmail(mail){
        var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
        if(er.test(mail)){
			return false;
		}else{
        	return true;
        }
}

//############################         FUNCAO PARA DEIXAR APENAS NUMEROS           ############################
function limpaString(S){
	var Digitos = "0123456789";
	var temp = "";
	var digito = "";
	for (var i=0; i<S.length; i++){
	
		digito = S.charAt(i);
		if (Digitos.indexOf(digito)>=0)
			temp=temp+digito
		
	}
	return temp
}

//############################         FUNCAO PARA VALIDAR CPF           ############################
function valida_cpf(cpf){
	
	var numeros, digitos, soma, i, resultado, digitos_iguais;
	digitos_iguais = 1;
	if (cpf.length < 11)
	      return false;
	for (i = 0; i < cpf.length - 1; i++)
	      if (cpf.charAt(i) != cpf.charAt(i + 1))
	            {
	            digitos_iguais = 0;
	            break;
	            }
	if (!digitos_iguais)
	      {
	      numeros = cpf.substring(0,9);
	      digitos = cpf.substring(9);
	      soma = 0;
	      for (i = 10; i > 1; i--)
	            soma += numeros.charAt(10 - i) * i;
	      resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
	      if (resultado != digitos.charAt(0))
	            return false;
	      numeros = cpf.substring(0,10);
	      soma = 0;
	      for (i = 11; i > 1; i--)
	            soma += numeros.charAt(11 - i) * i;
	      resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
	      if (resultado != digitos.charAt(1))
	            return false;
	      return true;
	      }
	else
	      return false;
}

// ############################         FUNCAO PARA VALIDAR DADOS           ############################
function validar(e){
	
	var email = '';
	var canSubmit = true;
	var messages = "<ul>";
	// faz uma busca por todos elementos que especificam o atributo req=true
	$("[req=true]").each(
	function(){

		if($(this).val().length < 1 && ($(this).attr("disabled")==undefined || $(this).attr("disabled")==false)){
			canSubmit = false;
			messages += "<li>" + $(this).attr("name") + " deve ser preenchido!</li>";
		}
	}
	);
	$("[caractere=true]").each(
	function(){
		if ($(this).val().match(/[!,@,#,$,%,*]/)){
			canSubmit = false;
			messages += "<li>" + $(this).attr("name") + " tem caractere invalido! - " + $(this).attr("value") + "</li>";
		}
	}
	);
	$("[email=true]").each(				
	function(){
		email = $(this).attr('value');
		if (validaEmail(email)){
			canSubmit = false;
			messages += "<li>" + $(this).attr("name") + " é inválido! - " + $(this).attr("value") + "</li>";
		}
	}
	);
	$("[cpf=true]").each(				
			function(){
				email = limpaString($(this).attr('value'));
				if (!valida_cpf(email)){
					canSubmit = false;
					messages += "<li>" + $(this).attr("name") + " é inválido! - " + $(this).attr("value") + "</li>";
				}
			}
	);
	
	messages += "</ul>";
	
	// verifica se vai exibir as mensagens de erro
	if(canSubmit == false)
		$("#erro").html(messages).css("color", "red").fadeIn(300);
	else
		e();	
	return canSubmit;
}

//############################         FUNCAO PARA VALIDAR DADOS           ############################
function validarAbas(e, id){
	
	var email = '';
	var canSubmit = true;
	var messages = "<ul>";
	// faz uma busca por todos elementos que especificam o atributo req=true
	$("[req"+id+"=true]").each(
		function(){
			if($(this).val().length < 1 & $(this).attr("disabled")==false) {
				canSubmit = false;
				messages += "<li>" + $(this).attr("name") + " deve ser preenchido!</li>";
			}
		}
	);
    
	$("[email"+id+"=true]").each(				
		function(){
			email = $(this).attr('value');
			if (validaEmail(email)){
				canSubmit = false;
				messages += "<li>" + $(this).attr("name") + " é inválido! - " + $(this).attr("value") + "</li>";
			}
		}
	);
	
	messages += "</ul>";
	
	// verifica se vai exibir as mensagens de erro
	if(canSubmit == false)
		$("#erro"+id).html(messages).css("color", "red").fadeIn(300);
	else
		e();	
	return canSubmit;
}



/* #################     FUNÇÃO PARA ADICIONAR MOTORISTA    ####################### */
function motorista(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "motorista/motorista.php",
			data: "addMotorista="+$("#txt_addMotorista").attr("value")+"&transportadora="+$("#cmb_transportadora").attr("value")+"&cpf="+$("#txt_cpf").attr("value")+"&nome="+$("#txt_nome").attr("value")+"&cep="+$("#txt_cep").attr("value")+"&logradouro="+$("#txt_logradouro").attr("value")+"&endereco="+$("#txt_endereco").attr("value")+"&bairro="+$("#txt_bairro").attr("value")+"&cidade="+$("#txt_cidade").attr("value")+"&numero="+$("#txt_numero").attr("value")+"&rg="+$("#txt_rg").attr("value")+"&telefone="+$("#txt_telefone").attr("value")+"&celular="+$("#txt_celular").attr("value")+"&cnh="+$("#txt_cnh").attr("value")+"&dataNascimento="+$("#txt_dataNascimento").attr("value")+"&grisco="+$("#cmb_gerenciadoraRisco").attr("value")+"&liberacao="+$("#txt_liberacao").attr("value")+"&vencimento="+$("#txt_dataVencimento").attr("value")+"&treinamento="+$("#cmb_treinamento").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucessoFuncao,
			error: erro
		   });
	return false;
}


/* #################     FUNÇÃO PARA BLOQUEAR MOTORISTA    ####################### */

function motoristaBloquear(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "verMotorista.php",
			data: "id_motorista="+$("#id_motorista").attr("value")+"&responsavel="+$("#cmb_responsavelBloqueio").attr("value")+"&ateDataBloqueio="+$("#txt_dataliberacao").attr("value")+"&motivoBloqueio="+$("#txt_motivo").attr("value")+"&bloquearMotorista=1",
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;	
	
}

/* #################     FUNÇÃO PARA ADICIONAR O GERENCIADOR DE RISCO DO MOTORISTA    ####################### */
function motoristaGR(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "verMotorista.php",
			data: "id_motorista="+$("#id_motorista").attr("value")+"&grisco="+$("#cmb_gerenciadoraRisco").attr("value")+"&liberacao="+$("#txt_liberacao").attr("value")+"&vencimento="+$("#txt_dataVencimento").attr("value")+"&addGrMotorista=1",
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;	
	
}

/* #################     FUNÇÃO PARA ADICIONAR O TREINAMENTO DO MOTORISTA    ####################### */
function motoristaTreinamento(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "verMotorista.php",
			data: "id_motorista="+$("#id_motorista").attr("value")+"&treinamento="+$("#cmb_treinamento").attr("value")+"&addTreinamento=1",
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;	
	
}


/* #################     FUNÇÃO PARA ADICIONAR NOME TRANSPORTADORA    ####################### */
function nomeTransportadora(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "../transportadora/adicionaNomeCodigo.php",
			data: "id_transportadora="+$("#txt_id_transportadora").attr("value")+"&dado="+$("#txt_dado").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;	
	
}

/* #################     FUNÇÃO PARA DESBLOQUEAR MOTORISTA    ####################### */
function motoristaDesbloquear(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "verMotorista.php",
			data: "id_motorista="+$("#id_motorista").attr("value")+"&responsavel="+$("#cmb_responsavelBloqueio").attr("value")+"&ateDataBloqueio="+$("#txt_dataliberacao").attr("value")+"&motivoDesbloqueio="+$("#txt_motivo").attr("value")+"&desbloquearMotorista=1",
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;	
	
}

/* #################     FUNÇÃO PARA ALTERAR STATUS OE    ####################### */
function alteraStatusOE(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "verOE.php",
			data: "txt_idOrdemDeEmbarque="+$("#txt_idOrdemDeEmbarque").attr("value")+"&id_statusOE="+$("#cmb_statusOE").attr("value")+ "&observacao="+$("#txt_observacao").attr("value")+"&alteraStatus=1",
			beforeSend: mostrarCarregando,
			success: function(txt) {
				
				aposCarregamento();
				$('#conteudo').html(txt);
				
			},
			error: erro
		   });
	return false;	
	
}


/* #################     FUNÇÃO PARA ADICIONAR VEÍCULO DEDICADO   ####################### */
function veiculoDedicado(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "veiculo/dedicado.php",
			data: "addVeiculo="+$("#txt_addVeiculo").attr("value")+"&id_dedicado="+$("#cmb_numeroDedicado").attr("value")+"&placa1="+$("#cmb_cavalo").attr("value")+"&placa2="+$("#cmb_bitrem").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}
	
/* #################     FUNÇÃO PARA ADICIONAR TRANSPORTADORA    ####################### */
function transportadora(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "transportadora/transportadora.php",
			data: "addTransportadora="+$("#txt_addTransportadora").attr("value")+"&transportadora="+$("#txt_transportadora").attr("value")+"&situacao="+$("#cmb_situacao").attr("value")+"&codigo="+$("#txt_codigo").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}


/* #################     FUNÇÃO PARA ADICIONAR DEPOSITO TRANSPORTADORA    ####################### */
function transportadoraDeposito(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "transportadora/depositos.php",
			data: "addDepositoTransportadora="+$("#txt_depositoTranspotadora").attr("value")+"&transportadora="+$("#cmb_transportadora").attr("value")+"&cidade="+$("#cmb_centro").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA VER DEPOSITO TRANSPORTADORA    ####################### */
function verDepositoTransportadora(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "transportadora/depositos.php",
			data: "&transportadora="+$("#cmb_transportadora").attr("value")+"&cidade="+$("#cmb_centro").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}


/* #################     FUNÇÃO PARA ADICIONAR OE    ####################### */
function oe(){
	
	//DESATIVA BOTAO
	document.getElementById("btn_addOE").disabled=true;
	
	/*
	 * parada circuito*/
	var dadosCliente = $("input[entregaClientes=true]").serializeArray();
    var clienteDedicado = "&";
    jQuery.each(dadosCliente, function(i, dado_id) {
    	clienteDedicado = clienteDedicado + "clienteDedicado[]=" + dado_id.value + "&";
    });
    var dadosParadaProgramada = $("[paradaProgramada=true]").serializeArray();
    var paradaProgramada = "&";
    jQuery.each(dadosParadaProgramada, function(i, dado_id) {
    	paradaProgramada = paradaProgramada + "paradaProgramada[]=" + dado_id.value + "&";
    });    
	
	var dados_aux = $("input[deposito=true]").serializeArray();
    var depositos = "&";
    jQuery.each(dados_aux, function(i, dado_id) {
		depositos = depositos + "deposito[]=" + dado_id.value + "&";
    });
    
    var dadosTipoEntrega = $("select[tipoEntrega=true]").serializeArray();
    var tipoEntrega = "&";
    jQuery.each(dadosTipoEntrega, function(i, dado_id) {
    	tipoEntrega = tipoEntrega + "tipoEntrega[]=" + dado_id.value + "&";
    });
    var dadosCliente = $("input[cliente=true]").serializeArray();
    var cliente = "&";
    jQuery.each(dadosCliente, function(i, dado_id) {
    	cliente = cliente + "cliente[]=" + dado_id.value + "&";
    });
    var dadosData = $("input[data=true]").serializeArray();
    var data = "&";
    jQuery.each(dadosData, function(i, dado_id) {
    	data = data + "dataChegada[]=" + dado_id.value + "&";
    });
    var dadosHora = $("input[hora=true]").serializeArray();
    var hora = "&";
    jQuery.each(dadosHora, function(i, dado_id) {
    	hora = hora + "horaChegada[]=" + dado_id.value + "&";
    });
	        
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "oe/adicionaOE.php",
			data: "transporte="+$("#txt_transporte").attr("value")+"&origem="+$("#cmb_origem").attr("value")+"&transportadora="+$("#cmb_transportadora").attr("value")+"&motorista="+$("#cmb_motorista").attr("value")+"&tipoCarregamento="+$("#cmb_tipoCarregamento").attr("value")+"&tipoViagem="+$("#cmb_tipoViagem").attr("value")+"&tipoVeiculo="+$("#cmb_tipoVeiculo").attr("value")+"&placaTruck="+$("#cmb_placaTruck").attr("value")+"&placaCavalo="+$("#cmb_placaCavalo").attr("value")+"&placaCarreta="+$("#cmb_placaCarreta").attr("value")+"&placaBitrem="+$("#cmb_placaCarretaBitrem").attr("value")+"&placaVan="+$("#cmb_placaVan").attr("value")+"&placaToco="+$("#cmb_placaToco").attr("value")+"&gerenciadorDeRisco="+$("#cmb_gerenciadorRisco").attr("value")+"&numeroLiberacao="+$("#txt_num_liberacao").attr("value")+"&valorCarga="+$("#txt_valorCarga").attr("value")+"&modulo="+$("#txt_modulo").attr("value")+"&rastreador="+$("#cmb_rastreador").attr("value")+"&tipoRastreador="+$("#txt_tipoRastreador").attr("value")+depositos+cliente+data+hora+tipoEntrega+"&centroLogistico="+$("#chk_centroLogistico").is(":checked")+"&centroLogisticoValor="+$("#cmb_centroLogistico").attr("value")+"&observacao="+$("#txt_observacao").attr("value")+"&transporteDBelgo="+$("#txt_dBelgo").attr("value")+"&numeroDedicado="+$("#cmb_dedicado").attr("value")+"&embalagemVazia="+$("#chk_embalagemVazia").is(":checked")+"&dedicadoDinamico="+$("#chk_dinamico").is(":checked")+"&eixosCavalo="+$("#cmb_eixosCavalo").attr("value")+"&eixosTruck="+$("#cmb_eixosTruck").attr("value")+"&eixosCarreta="+$("#cmb_eixosCarreta").attr("value")+"&eixosBi-trem="+$("#cmb_eixosBi-trem").attr("value")+"&eixosVan="+$("#cmb_eixosVan").attr("value")+"&eixosToco="+$("#cmb_eixosToco").attr("value")+"&carroceria="+$("#cmb_carroceria").attr("value")+"&dataInicio="+$("#txt_dataInicio").attr("value")+"&horaInicio="+$("#txt_horaInicio").attr("value")+clienteDedicado+paradaProgramada,
			beforeSend: mostrarCarregando,
			//success: sucesso,
			success: sucessoFuncao,
			error: erro
		   });
	return false;
}
function pv(){
	//DESATIVA BOTAO
	document.getElementById("btn_addPV").disabled=true;

    var dadosCliente = $("input[entregaClientes=true]").serializeArray();
    var cliente = "&";
    jQuery.each(dadosCliente, function(i, dado_id) {
    	cliente = cliente + "cliente[]=" + dado_id.value + "&";
    });
    var dadosParadaProgramada = $("[paradaProgramada=true]").serializeArray();
    var paradaProgramada = "&";
    jQuery.each(dadosParadaProgramada, function(i, dado_id) {
    	paradaProgramada = paradaProgramada + "paradaProgramada[]=" + dado_id.value + "&";
    });    
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "planodeviagem/adicionaPlanoDeViagem.php",
			data: "id_ordemDeEmbarque="+$("#txt_id_ordemDeEmbarque").attr("value")+"&numeroTransporte="+$("#txt_transporte").attr("value")+"&motorista="+$("#cmb_motorista").attr("value")+"&tipoVeiculo="+$("#cmb_tipoVeiculo").attr("value")+"&placaTruck="+$("#cmb_placaTruck").attr("value")+"&placaCavalo="+$("#cmb_placaCavalo").attr("value")+"&placaCarreta="+$("#cmb_placaCarreta").attr("value")+"&placaBitrem="+$("#cmb_placaCarretaBitrem").attr("value")+"&placaVan="+$("#cmb_placaVan").attr("value")+"&gerenciadorDeRisco="+$("#cmb_gerenciadorRisco").attr("value")+"&numeroLiberacao="+$("#txt_num_liberacao").attr("value")+"&dataSaida="+$("#txt_dataInicio").attr("value")+"&horaInicio="+$("#txt_horaInicio").attr("value")+"&modulo="+$("#txt_modulo").attr("value")+"&rastreador="+$("#cmb_rastreador").attr("value")+"&tipoRastreador="+$("#txt_tipoRastreador").attr("value")+cliente+paradaProgramada+"&observacao="+$("#txt_observacao").attr("value")+"&numeroDedicado="+$("#cmb_dedicado").attr("value")+"&tipoViagem="+$("#cmb_tipoViagem").attr("value")+"&depositoTransportadora="+$("#cmb_depositoTransportadora").attr("value")+"&dataEntrada="+$("#txt_dataEntrada").attr("value")+"&horaEntrada="+$("#txt_horaEntrada").attr("value")+"&dataSaidaDeposito="+$("#txt_dataSaida").attr("value")+"&horaSaida="+$("#txt_horaSaida").attr("value")+"&addPV=1",
			beforeSend: mostrarCarregando,
			success: sucessoFuncao,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA VER RASTREADOR    ####################### */
function verRastreadores(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "veiculo/rastreador.php",
			data: "transportadora="+$("#cmb_transportadora").attr("value")+"&rastreador="+$("#cmb_rastreador").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA VER VEICULOS    ####################### */
function verVeiculo(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "veiculo/veiculo.php",
			data: "transportadora="+$("#cmb_transportadora").attr("value")+"&tipoVeiculo="+$("#cmb_tipoVeiculo").attr("value")+"&placa="+$("#txt_placa").attr("value")+"&propriedade="+$("#cmb_propriedade").attr("value")+"&marca="+$("#cmb_marca").attr("value")+"&cidade="+$("#cmb_cidade").attr("value")+"&uf="+$("#cmb_uf").attr("value")+"&situacao="+$("#cmb_situacao").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA VER VEICULOS DEDICADOS    ####################### */
function verVeiculoDedicado(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "veiculo/dedicado.php",
			data: "transportadora="+$("#cmb_transportadora").attr("value")+"&tipo="+$("#cmb_tipoVeiculo").attr("value")+"&tipoDedicado="+$("#cmb_tipoDedicado").attr("value")+"&dedicado="+$("#txt_numeroDedicado").attr("value")+"&placa="+$("#txt_placa").attr("value")+"&situacao="+$("#cmb_situacao").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}



/* #################     FUNÇÃO PARA VER MOTORISTAS    ####################### */
function verMotorista(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "motorista/motorista.php",
			data: "cpf="+$("#txt_cpf").attr("value")+"&motorista="+$("#txt_nome").attr("value")+"&transportadora="+$("#cmb_transportadora").attr("value")+"&cidade="+$("#cmb_cidade").attr("value")+"&uf="+$("#cmb_uf").attr("value")+"&situacao="+$("#cmb_situacao").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA VER TRANSPORTADORAS    ####################### */
function verTransportadora(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "transportadora/transportadora.php",
			data: "&transportadora="+$("#cmb_transportadora").attr("value")+"&situacao="+$("#cmb_situacao").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA VER OE    ####################### */
function verOE(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "oe/visualizarOE.php",
			data: "transporte="+$("#txt_transporte").attr("value")+"&transportadora="+$("#cmb_transportadora").attr("value")+"&origem="+$("#cmb_origem").attr("value")+"&status="+$("#cmb_status").attr("value")+"&tipo="+$("#cmb_tipoViagem").attr("value")+"&carregamento="+$("#cmb_tipoCarregamento").attr("value")+"&dataInicio="+$("#txt_dataInicio").attr("value")+"&dataFim="+$("#txt_dataFim").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA VER EXPEDIÇÕES    ####################### */
function verExpedicoes(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "planodeviagem/expedicoes.php",
			data: "&transportadora="+$("#cmb_transportadora").attr("value")+"&origem="+$("#cmb_origem").attr("value")+"&transporte="+$("#cmb_transporte").attr("value")+"&dataInicio="+$("#txt_dataInicio").attr("value")+"&dataFim="+$("#txt_dataFim").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA ADICIONAR OE    ####################### */
function adicionaOE(){
	var dados_aux = $("input[centro=true]").serializeArray();
    var dados = "";
    jQuery.each(dados_aux, function(i, dado_id) {
		dados = dados + dado_id.value + "/";
    });
    
	dados_aux = $("input[codigoTransportadora=true]").serializeArray();
    var dadosTransportadora = "";
    jQuery.each(dados_aux, function(i, dado_id) {
		dadosTransportadora = dadosTransportadora + dado_id.value + "/";
    });
    
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "oe/adicionaOE.php",
			data: "addTransportadora="+$("#txt_addTransportadora").attr("value")+"&transportadora="+$("#txt_transportadora").attr("value")+"&situacao="+$("#cmb_situacao").attr("value")+"&centroTransportadora="+dados+"&codigoTransportadora="+dadosTransportadora,
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}

function carregaComplementeCurso(){
    $.ajax({async: true,
        type: "POST",
        dataType: "html",
        url: "questionario.php",
        data: "id_curso="+$("#cmb_curso").attr("value")+"&metodo=preencherPerguntas&pergunta=9",
        beforeSend: mostrarCarregando,
        success: function(dados){
                aposCarregamento();
                $('#div_complemento9').html(dados);
        },
        error: erro
   });
    return false;
}

function carregaFilhos(){
    $.ajax({async: true,
        type: "POST",
        dataType: "html",
        url: "questionario.php",
        data: "temFilhos="+$("input[name='rad_filho']:checked").val()+"&metodo=preencherPerguntas&pergunta=17",
        beforeSend: mostrarCarregando,
        success: function(dados){
                aposCarregamento();
                $('#div_temFilhos').html(dados);
        },
        error: erro
   });
    return false;
}

function carregaRecebeuAuxilio(){
    $.ajax({async: true,
        type: "POST",
        dataType: "html",
        url: "questionario.php",
        data: "recebeuAuxilio="+$("input[name='rad_recurso']:checked").val()+"&metodo=preencherPerguntas&pergunta=auxilio",
        beforeSend: mostrarCarregando,
        success: function(dados){
                aposCarregamento();
                $('#div_recebeuAuxilio').html(dados);
        },
        error: erro
   });
    return false;
}

function carregaEscolaridadeProvedor(){
    $.ajax({async: true,
        type: "POST",
        dataType: "html",
        url: "questionario.php",
        data: "id_provedor="+$("#cmb_provedor").val()+"&escolaridade_provedor="+$("#cmb_escolaridadeProvedor").val()+"&metodo=preencherPerguntas&pergunta=63",
        beforeSend: mostrarCarregando,
        success: function(dados){
                aposCarregamento();
                $('#div_escolaridadeProvedor').html(dados);
        },
        error: erro
   });
    return false;
}

function carregaLocalReside(){
    $.ajax({async: true,
        type: "POST",
        dataType: "html",
        url: "questionario.php",
        data: "resideFamilia="+$("input[name='rad_resideFamilia']:checked").val()+"&metodo=preencherPerguntas&pergunta=31",
        beforeSend: mostrarCarregando,
        success: function(dados){
                aposCarregamento();
                $('#div_localReside').html(dados);
        },
        error: erro
   });
    return false;
}


function carregaBPC(){
    $.ajax({async: true,
        type: "POST",
        dataType: "html",
        url: "questionario.php",
        data: "rad_bpc="+$("input[name='rad_bolsaFamilia']:checked").val()+"&rendaBPC="+$("#txt_hidden_rendaBPC").val()+"&metodo=preencherPerguntas&pergunta=45",
        beforeSend: mostrarCarregando,
        success: function(dados){
                aposCarregamento();
                $('#div_bolsaFamilia').html(dados);
        },
        error: erro
   });
    return false;
}

function carregaBeneficios(){
    $.ajax({async: true,
        type: "POST",
        dataType: "html",
        url: "questionario.php",
        data: "id_campus="+$("#cmb_campus").val()+
            "&id_questionario="+$("#txt_id_questionario_campus").val()+
            "&chk_filho="+$("input[name='rad_filho']:checked").val()+
            "&chk_resideNucleoFamiliar="+$("input[name='rad_resideFamilia']:checked").val()+
              "&metodo=preencherPerguntas&pergunta=12",
        beforeSend: mostrarCarregando,
        success: function(dados){
                aposCarregamento();
                $('#div_beneficios').html(dados);
        },
        error: erro
   });
    return false;
}

function carregaImovel(){
    $.ajax({async: true,
        type: "POST",
        dataType: "html",
        url: "questionario.php",
        data: "temImovel="+$("input[name='imovel']:checked").val()+"&metodo=preencherPerguntas&pergunta=54",
        beforeSend: mostrarCarregando,
        success: function(dados){
                aposCarregamento();
                $('#div_imovel').html(dados);
        },
        error: erro
   });
    return false;
}

function carregaCidades_(){
    $.ajax({async: true,
        type: "POST",
        dataType: "html",
        url: "questionario.php",
        data: "id_uf="+$("#cmb_uf").attr("value")+"&metodo=preencherPerguntas&pergunta=58",
        beforeSend: mostrarCarregando,
        success: function(dados){
                aposCarregamento();
                $('#div_cidade').html(dados);
        },
        error: erro
   });
    return false;
}

function carregaNovoMembro(solicitante, nome){
    $.ajax({async: true,
        type: "POST",
        dataType: "html",
        url: "questionario.php",
        data: "metodo=carregaNovoMembro&id_questionarioResposta="+$("#txt_id_questionarioResposta").attr("value")+
                "&solicitante="+solicitante+"&nome="+nome,
        beforeSend: mostrarCarregando,
        success: function(dados){
                aposCarregamento();
                $('#div_formularioMembro').html(dados);
        },
        error: erro
   });
    return false;
}

function carregaNovoVeiculo(){
    $.ajax({async: true,
        type: "POST",
        dataType: "html",
        url: "questionario.php",
        data: "metodo=carregaNovoVeiculo&id_questionarioResposta="+$("#txt_id_questionarioResposta").attr("value"),
        beforeSend: mostrarCarregando,
        success: function(dados){
                aposCarregamento();
                $('#div_formularioVeiculo').html(dados);
        },
        error: erro
   });
    return false;
}

function carregaNovoImovel(){
    $.ajax({async: true,
        type: "POST",
        dataType: "html",
        url: "questionario.php",
        data: "metodo=carregaNovoImovel&id_questionarioResposta="+$("#txt_id_questionarioResposta").attr("value"),
        beforeSend: mostrarCarregando,
        success: function(dados){
                aposCarregamento();
                $('#div_formularioImovel').html(dados);
        },
        error: erro
   });
    return false;
}


function carregaDeficiencia(){
    $.ajax({async: true,
        type: "POST",
        dataType: "html",
        url: "questionario.php",
        data: "temDeficiencia="+$("input[name='rad_portadorDeficiencia']:checked").val()+"&metodo=preencherPerguntas&pergunta=33",
        beforeSend: mostrarCarregando,
        success: function(dados){
                aposCarregamento();
                $('#div_deficienciaComplemento').html(dados);
        },
        error: erro
   });
    return false;
}

function preencheCidade(){
    $.ajax({async: true,
        type: "POST",
        dataType: "html",
        url: "questionario.php",
        data: "id_uf="+$("#cmb_uf").attr("value")+"&metodo=preencherPerguntas&pergunta=54",
        beforeSend: mostrarCarregando,
        success: function(dados){
                aposCarregamento();
                $('#div_cidade').html(dados);
        },
        error: erro
   });
    return false;
}


function carregaCidades(){
    $.ajax({async: true,
        type: "POST",
        dataType: "html",
        url: "cidade.php",
        data: "id_uf="+$("#cmb_uf").attr("value")+"&metodo=carregaCidades",
        beforeSend: mostrarCarregando,
        success: function(dados){
                aposCarregamento();
                $('#div_cidade').html(dados);
        },
        error: erro
   });
    return false;
}

function carregaCidades2(){
    $.ajax({async: true,
        type: "POST",
        dataType: "html",
        url: "cidade.php",
        data: "id_uf="+$("#cmb_uf2").attr("value")+"&metodo=carregaCidades2",
        beforeSend: mostrarCarregando,
        success: function(dados){
                aposCarregamento();
                $('#div_cidade2').html(dados);
        },
        error: erro
   });
    return false;
}

// Função para atualizar tabela de relatorio
function carregaRelatorio(){
    jQuery("#frmRelatorio").submit();
}
// Função para atualizar tabela de resumo
function carregaResumo(){
    jQuery("#frmResumo").submit();
}


// ############################         ACEITAR SÓ NÚMERO NO INPUT           ############################
function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;
    if((tecla > 47 && tecla < 58) || (tecla==0) || (tecla==44) || (tecla==46)) return true;
    else{
    if (tecla != 8) return false;
    else return true;
    }
}
// ############################         CONSULTA O CPF E RETORNA DADOS           ############################
function consultaMotorista() {  
        // Se o campo CPF não estiver vazio  
		mostrarCarregando();
        if($.trim($("#cpf").val()) != ""){
            /* 
                Para conectar no serviço e executar o json, precisamos usar a função 
                getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros 
                dataTypes não possibilitam esta interação entre domínios diferentes 
                Estou chamando a url do serviço passando o parâmetro "formato=javascript" e o CEP digitado no formulário 
                http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val() 
            */

            $.getScript("motorista.php?cpfMotorista="+$("#cpf").val(), function(){
                // o getScript dá um eval no script, então é só ler!  
                //Se o resultado for igual a 1
				
                    // troca o valor dos elementos  
					$("#nome").val(unescape(resultadoMotorista["nome"]));
                    $("#cep").val(unescape(resultadoMotorista["cep"]));
					$("#logradouro").val(unescape(resultadoMotorista["logradouro"]));  
					$("#endereco").val(unescape(resultadoMotorista["rua"]));  
					$("#bairro").val(unescape(resultadoMotorista["bairro"]));  
					$("#cidade").val(unescape(resultadoMotorista["cidade"]));
					$("#numero").val(unescape(resultadoMotorista["numero"]));  
					$("#rg").val(unescape(resultadoMotorista["rg"]));  
					$("#telefone").val(unescape(resultadoMotorista["telefone"]));  
					$("#celular").val(unescape(resultadoMotorista["celular"]));  
					$("#cnh").val(unescape(resultadoMotorista["cnh"]));  
					$("#dataNascimento").val(unescape(resultadoMotorista["dataNascimento"]));	
                
            });
        
		aposCarregamento();
		}
		
}

// ############################         CONSULTA O CEP E RETORNA DADOS           ############################
function consultaCEP() {  
        // Se o campo CEP não estiver vazio  
		mostrarCarregando();
        if($.trim($("#cep").val()) != "" || $.trim($("#cep").val())!="_____-___"){
            /* 
                Para conectar no serviço e executar o json, precisamos usar a função 
                getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros 
                dataTypes não possibilitam esta interação entre domínios diferentes 
                Estou chamando a url do serviço passando o parâmetro "formato=javascript" e o CEP digitado no formulário 
                http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val() 
            */

            $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val(), function(){  
                // o getScript dá um eval no script, então é só ler!  
                //Se o resultado for igual a 1  
		if(resultadoCEP["resultado"]==1){
                    $.ajax({async: true,
                        type: "POST",
                        dataType: "html",
                        url: "cidade.php",
                        data: "uf="+resultadoCEP["uf"]+"&cidade="+resultadoCEP["cidade"]+"&bairro="+resultadoCEP["bairro"]+"&logradouro="+resultadoCEP["tipo_logradouro"]+" "+resultadoCEP["logradouro"]+"&metodo=montaEnderecoCEP",
                        beforeSend: mostrarCarregando,
                        success: function(dados){
                                aposCarregamento();
                                $('#div_cep').html(dados);
                        },
                        error: erro
                   });
                }else{  
                    alert("CEP não encontrado em nossa base de dados! Se tiver certeza favor prosseguir o cadastro!");
                    $.ajax({async: true,
                        type: "POST",
                        dataType: "html",
                        url: "cidade.php",
                        data: "uf=0&metodo=montaEnderecoCEP",
                        beforeSend: mostrarCarregando,
                        success: function(dados){
                                aposCarregamento();
                                $('#div_cep').html(dados);
                        },
                        error: erro
                   });
                    aposCarregamento();
                }  
            });
        
		aposCarregamento();
		}
		
}



function consultaCEP2() {  
        // Se o campo CEP não estiver vazio  
		mostrarCarregando();
        if($.trim($("#cep2").val()) != "" || $.trim($("#cep2").val())!="_____-___"){
            /* 
                Para conectar no serviço e executar o json, precisamos usar a função 
                getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros 
                dataTypes não possibilitam esta interação entre domínios diferentes 
                Estou chamando a url do serviço passando o parâmetro "formato=javascript" e o CEP digitado no formulário 
                http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val() 
            */

            $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep2").val(), function(){  
                // o getScript dá um eval no script, então é só ler!  
                //Se o resultado for igual a 1  
		if(resultadoCEP["resultado"]==1){
                    $.ajax({async: true,
                        type: "POST",
                        dataType: "html",
                        url: "cidade.php",
                        data: "uf="+resultadoCEP["uf"]+"&cidade="+resultadoCEP["cidade"]+"&bairro="+resultadoCEP["bairro"]+"&logradouro="+resultadoCEP["tipo_logradouro"]+" "+resultadoCEP["logradouro"]+"&metodo=montaEnderecoCEP2",
                        beforeSend: mostrarCarregando,
                        success: function(dados){
                                aposCarregamento();
                                $('#div_cep2').html(dados);
                        },
                        error: erro
                   });
                }else{  
                    alert("CEP não encontrado em nossa base de dados! Se tiver certeza favor prosseguir o cadastro!");
                    $.ajax({async: true,
                        type: "POST",
                        dataType: "html",
                        url: "cidade.php",
                        data: "uf=0&metodo=montaEnderecoCEP2",
                        beforeSend: mostrarCarregando,
                        success: function(dados){
                                aposCarregamento();
                                $('#div_cep2').html(dados);
                        },
                        error: erro
                   });
                    aposCarregamento();
                }  
            });
        
		aposCarregamento();
		}
		
}



// ############################         FORMATAÇÃO MOEDA           ############################

function BloqueiaLetras(esteCampo,evento){
	var tecla;
	var campo = esteCampo.value;
    if(window.event) { // Internet Explorer
        tecla = event.keyCode;
    }
    else { // Firefox
        tecla = evento.which;
    }    
    
  if(tecla >= 48 && tecla <= 57 || tecla == 8 || tecla==9)
  {
      FormataValor(esteCampo,campo, 10, tecla);
  }
  else
      return false;
}

function FormataValor(campo,valor,tammax,tecla) {
        if (tecla >= 48 && tecla <= 57)
        {
            vr = valor;
            vr = vr.toString().replace( "/", "" );
            vr = vr.toString().replace( "/", "" );
            vr = vr.toString().replace( ",", "" );
            vr = vr.toString().replace( ".", "" );
            vr = vr.toString().replace( ".", "" );
            vr = vr.toString().replace( ".", "" );
            vr = vr.toString().replace( ".", "" );
            tam = vr.length;
            
            if (tam < tammax && tecla != 8){ tam = vr.length + 1; }
            
            if (tecla == 8 ){ tam = tam - 1; }
            
            if ( tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105 )
            {
                if ( tam <= 2 )
                {
                    campo = vr;
                }
                if ( (tam > 2) && (tam <= 5) )
                {
                    campo.value = vr.substr( 0, tam - 2 ) + ',' + vr.substr( tam - 2, tam );
                }
                if ( (tam >= 6) && (tam <= 8) )
                {
                    campo.value = vr.substr( 0, tam - 5 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam );
                }
                if ( (tam >= 9) && (tam <= 11) )
                {
                    campo.value = vr.substr( 0, tam - 8 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam );
                }
                if ( (tam >= 12) && (tam <= 14) )
                {
                    campo.value = vr.substr( 0, tam - 11 ) + '.' + vr.substr( tam - 11, 3 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam );
                }
                if ( (tam >= 15) && (tam <= 17) )
                {
                    campo.value = vr.substr( 0, tam - 14 ) + '.' + vr.substr( tam - 14, 3 ) + '.' + vr.substr( tam - 11, 3 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam );
                }
            }
        }
}
function verificaTecla(campo, evento){

      var codigoTecla;
      if(window.event) codigoTecla = window.event.codigoTecla;
      else if (evento) codigoTecla = evento.which;
      else return true;

      switch(codigoTecla){

      case 13:

            $.ajax({type: "POST",

                      dataType: "html",
                      url: "circuito/operacoes.php",
                      data: "carregar=1&id_circuito="+$("#txt_Circuito").attr("value")
                            +"&operacoes="+$("#txtbuscaOperacoes").attr("value"),
                      beforeSend: mostrarCarregando,
                      success: sucesso,
                      error: erro         

            });
      return false;           
      break;
      default:
       return true;

      }
}
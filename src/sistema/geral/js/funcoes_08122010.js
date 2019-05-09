/* #################     FUNÇÕES DE CARREGAMENTO    ####################### */
function mostrarCarregando(){
  $('#carregando').css('display', 'block').fadeIn(1000);
};

function aposCarregamento(){
   $('#carregando').fadeOut(1000);
}

function sucesso(dados){
	aposCarregamento();
	$('#corpo').html(dados);
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

/* #################     FUNÇÃO PARA VER OE    ####################### */
function mascaraPlaca(tipoVeiculo, veiculo){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "veiculo/veiculo.php",
			data: "tipoVeiculoSelecionado="+tipoVeiculo+"&id_veiculo="+veiculo,
			beforeSend: mostrarCarregando,
			success: function(txt) {
				
				aposCarregamento();
				$('#div_placaVeiculos').html(txt);
				
			},
			error: erro
		   });
	return false;
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

//


/* #################     FUNÇÃO PARA SELECIONAR CIRCUITO DE ACORDO COM O TIPO    ####################### */
function selecionaCircuito(circuito){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "circuito/circuito.php",
			data: "idCircuito="+circuito ,
			beforeSend: mostrarCarregando,
			success: function(dados){
						aposCarregamento();
						$('#div_Circuitos').html(dados);
					},
			error: erro
		   });
	return false;
}

//

function placaOE(){
	//ATIVA TRUCK
	if(document.getElementById('cmb_tipoVeiculo').value==1){
		$("#divPlacaTruck").fadeIn(200);
		document.getElementById('cmb_placaTruck').disabled=false;
		document.getElementById('cmb_placaCavalo').disabled=true;
		document.getElementById('cmb_placaCarreta').disabled=true;
		document.getElementById('cmb_placaCarretaBitrem').disabled=true;
		document.getElementById('cmb_placaVan').disabled=true;
		$("#divPlacaCavalo").fadeOut(200);
		$("#divPlacaCarreta").fadeOut(200);
		$("#divPlacaBitrem").fadeOut(200);
		$("#divPlacaVan").fadeOut(200);
		/*document.getElementById('cmb_eixosTruck').disabled=false;
		document.getElementById('cmb_eixosCavalo').disabled=true;
		document.getElementById('cmb_eixosBi-trem').disabled=true;
		document.getElementById('cmb_eixosCarreta').disabled=true;
		document.getElementById('cmb_eixosVan').disabled=true;
		*/
	//ATIVA BITREM
	}else if(document.getElementById('cmb_tipoVeiculo').value==3){
		$("#divPlacaBitrem").fadeIn(200);
		document.getElementById('cmb_placaCarretaBitrem').disabled=false;
		$("#divPlacaTruck").fadeOut(200);
		$("#divPlacaVan").fadeOut(200);
		$("#divPlacaCarreta").fadeOut(200);
		$("#divPlacaCavalo").fadeIn(200);
		document.getElementById('cmb_placaTruck').disabled=true;
		document.getElementById('cmb_placaCarreta').disabled=true;
		document.getElementById('cmb_placaCavalo').disabled=false;
		document.getElementById('cmb_placaVan').disabled=true;
		/*document.getElementById('cmb_eixosTruck').disabled=true;
		document.getElementById('cmb_eixosCavalo').disabled=false;
		document.getElementById('cmb_eixosBi-trem').disabled=false;
		document.getElementById('cmb_eixosCarreta').disabled=true;
		document.getElementById('cmb_eixosVan').disabled=true;
		*/
	//ATIVA CARRETA
	}else if(document.getElementById('cmb_tipoVeiculo').value==4){
		$("#divPlacaCarreta").fadeIn(200);
		document.getElementById('cmb_placaCarreta').disabled=false;
		$("#divPlacaTruck").fadeOut(200);
		$("#divPlacaVan").fadeOut(200);
		$("#divPlacaBitrem").fadeOut(200);
		$("#divPlacaCavalo").fadeIn(200);
		document.getElementById('cmb_placaTruck').disabled=true;
		document.getElementById('cmb_placaCarretaBitrem').disabled=true;
		document.getElementById('cmb_placaCavalo').disabled=false;
		document.getElementById('cmb_placaVan').disabled=true;
		/*document.getElementById('cmb_eixosTruck').disabled=true;
		document.getElementById('cmb_eixosCavalo').disabled=false;
		document.getElementById('cmb_eixosBi-trem').disabled=true;
		document.getElementById('cmb_eixosCarreta').disabled=false;
		document.getElementById('cmb_eixosVan').disabled=true;
		*/
	//ATIVA VAM
	}else if(document.getElementById('cmb_tipoVeiculo').value==5){
		$("#divPlacaVan").fadeIn(200);
		document.getElementById('cmb_placaVan').disabled=false;
		$("#divPlacaTruck").fadeOut(200);
		$("#divPlacaCarreta").fadeOut(200);
		$("#divPlacaBitrem").fadeOut(200);
		$("#divPlacaCavalo").fadeOut(200);
		document.getElementById('cmb_placaTruck').disabled=true;
		document.getElementById('cmb_placaCarretaBitrem').disabled=true;
		document.getElementById('cmb_placaCavalo').disabled=true;
		document.getElementById('cmb_placaCarreta').disabled=true;
		/*
		document.getElementById('cmb_eixosTruck').disabled=true;
		document.getElementById('cmb_eixosCavalo').disabled=true;
		document.getElementById('cmb_eixosBi-trem').disabled=true;
		document.getElementById('cmb_eixosCarreta').disabled=true;
		document.getElementById('cmb_eixosVan').disabled=false;
		*/
	}
	
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
		if($(this).val().length < 1 & $(this).attr("disabled")==false){
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


/* #################     FUNÇÃO PARA ADICIONAR VEÍCULO    ####################### */
function veiculo(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "veiculo/veiculo.php",
			data: "addVeiculo="+$("#txt_addVeiculo").attr("value")+"&transportadora="+$("#cmb_transportadora").attr("value")+"&tipoVeiculo="+$("#cmb_tipoVeiculo").attr("value")+"&placa="+$("#txt_placa").attr("value")+"&placa2="+$("#txt_placa2").attr("value")+"&cidade="+$("#cmb_cidade").attr("value")+"&antt="+$("#txt_antt").attr("value")+"&vencimentoAntt="+$("#txt_dataVencimentoAntt").attr("value")+"&propriedade="+$("#cmb_propriedade").attr("value")+"&marca="+$("#cmb_marca").attr("value")+"&modelo="+$("#txt_modelo").attr("value")+"&cor="+$("#cmb_cor").attr("value")+"&ano="+$("#txt_ano").attr("value")+"&modulo="+$("#txt_modulo").attr("value")+"&rastreador="+$("#cmb_rastreador").attr("value")+"&numeroDedicado="+$("#txt_numeroDedicado").attr("value")+"&rastreadorInstalado="+$("#cmb_rastreadorInstalado").attr("value")+"&eixos="+$("#cmb_eixos").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
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

/* #################     FUNÇÃO PARA BLOQUEAR VEÍCULO    ####################### */
function veiculoBloquear(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "veiculo/veiculo.php",
			data: "bloquearVeiculo="+$("#id_veiculo").attr("value")+"&responsavel="+$("#cmb_responsavelBloqueio").attr("value")+"&ateDataBloqueio="+$("#txt_dataliberacao").attr("value")+"&motivoBloqueio="+$("#txt_motivo").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}



/* #################     FUNÇÃO PARA DESBLOQUEAR VEÍCULO    ####################### */
function veiculoDesbloquear(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "veiculo/veiculo.php",
			data: "desbloquearVeiculo="+$("#id_veiculo").attr("value")+"&responsavel="+$("#cmb_responsavelBloqueio").attr("value")+"&motivoDesbloqueio="+$("#txt_motivo").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA ADICIONAR USUÁRIO    ####################### */
function usuario(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "usuario/usuario.php",
			data: "addUsuario="+$("#txt_addUsuario").attr("value")+"&nome="+$("#txt_nome").attr("value")+"&usuario="+$("#txt_usuario").attr("value")+"&cpf="+$("#txt_cpf").attr("value")+"&email="+$("#txt_email").attr("value")+"&telefone="+$("#txt_telefone").attr("value")+"&dataAniversario="+$("#txt_dataAniversario").attr("value")+"&perfil="+$("#cmb_perfil").attr("value")+"&senha="+$("#txt_senha").attr("value")+"&senha2="+$("#txt_senha2").attr("value")+"&situacao="+$("#cmb_situacao").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA VER USUARIOS    ####################### */
function verUsuario(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "usuario/usuario.php",
			data: "nomeUsuario="+$("#txt_usuario").attr("value")+"&transportadora="+$("#cmb_transportadora").attr("value")+"&perfil="+$("#cmb_perfil").attr("value")+"&situacao="+$("#cmb_situacao").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
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
			data: "transporte="+$("#txt_transporte").attr("value")+"&origem="+$("#cmb_origem").attr("value")+"&transportadora="+$("#cmb_transportadora").attr("value")+"&motorista="+$("#cmb_motorista").attr("value")+"&tipoCarregamento="+$("#cmb_tipoCarregamento").attr("value")+"&tipoViagem="+$("#cmb_tipoViagem").attr("value")+"&tipoVeiculo="+$("#cmb_tipoVeiculo").attr("value")+"&placaTruck="+$("#cmb_placaTruck").attr("value")+"&placaCavalo="+$("#cmb_placaCavalo").attr("value")+"&placaCarreta="+$("#cmb_placaCarreta").attr("value")+"&placaBitrem="+$("#cmb_placaCarretaBitrem").attr("value")+"&placaVan="+$("#cmb_placaVan").attr("value")+"&gerenciadorDeRisco="+$("#cmb_gerenciadorRisco").attr("value")+"&numeroLiberacao="+$("#txt_num_liberacao").attr("value")+"&valorCarga="+$("#txt_valorCarga").attr("value")+"&modulo="+$("#txt_modulo").attr("value")+"&rastreador="+$("#cmb_rastreador").attr("value")+"&tipoRastreador="+$("#txt_tipoRastreador").attr("value")+depositos+cliente+data+hora+tipoEntrega+"&centroLogistico="+$("#chk_centroLogistico").is(":checked")+"&centroLogisticoValor="+$("#cmb_centroLogistico").attr("value")+"&observacao="+$("#txt_observacao").attr("value")+"&transporteDBelgo="+$("#txt_dBelgo").attr("value")+"&numeroDedicado="+$("#cmb_dedicado").attr("value")+"&embalagemVazia="+$("#chk_embalagemVazia").is(":checked")+"&eixosCavalo="+$("#cmb_eixosCavalo").attr("value")+"&eixosTruck="+$("#cmb_eixosTruck").attr("value")+"&eixosCarreta="+$("#cmb_eixosCarreta").attr("value")+"&eixosBi-trem="+$("#cmb_eixosBi-trem").attr("value")+"&eixosVan="+$("#cmb_eixosVan").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucessoFuncao,
			error: erro
		   });
	return false;
}
function pv(){

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


/* #################     FUNÇÃO PARA PERFIL    ####################### */
function perfil(){
	
	dados_aux = $("input[transportadora=true]").serializeArray();
    var transportadora = "";
    jQuery.each(dados_aux, function(i, dado_id) {
    	transportadora = transportadora + dado_id.value + "/";
    });
    
	
	dados_aux = $("input[centro=true]").serializeArray();
    var centros = "";
    jQuery.each(dados_aux, function(i, dado_id) {
		centros = centros + dado_id.value + "/";
    });
    
    dados_aux = $("input[tipoCarregamento=true]").serializeArray();
    var tipoCarregamento = "";
    jQuery.each(dados_aux, function(i, dado_id) {
    	tipoCarregamento = tipoCarregamento + dado_id.value + "/";
    });
	
     dados_aux = $("input[tipoRelatorio=true]").serializeArray();
    var tipoRelatorio = "";
    jQuery.each(dados_aux, function(i, dado_id) {
    	tipoRelatorio = tipoRelatorio + dado_id.value + "/";
    });
    
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "usuario/perfil.php",
			data: "addPerfil="+$("#txt_addPerfil").attr("value")+"&perfil="+$("#txt_perfil").attr("value")+"&tipo_perfil="+$("#cmb_tipoPerfil").attr("value")+"&visPerfil="+$("#chk_visPerfil").is(":checked")+"&adiPerfil="+$("#chk_addPerfil").is(":checked")+"&ediPerfil="+$("#chk_ediPerfil").is(":checked")+"&excPerfil="+$("#chk_exPerfil").is(":checked")+"&visUsuarios="+$("#chk_visUsuarios").is(":checked")+"&addUsuarios="+$("#chk_addUsuarios").is(":checked")+"&ediUsuarios="+$("#chk_ediUsuarios").is(":checked")+"&exUsuarios="+$("#chk_exUsuarios").is(":checked")+"&visTabelas="+$("#chk_visTabelas").is(":checked")+"&addTabelas="+$("#chk_addTabelas").is(":checked")+"&ediTabelas="+$("#chk_ediTabelas").is(":checked")+"&excTabelas="+$("#chk_excTabelas").is(":checked")+"&visMotorista="+$("#chk_visMotorista").is(":checked")+"&addMotorista="+$("#chk_addMotorista").is(":checked")+"&ediMotorista="+$("#chk_ediMotorista").is(":checked")+"&exMotorista="+$("#chk_exMotorista").is(":checked")+"&bloquearMotorista="+$("#chk_bloquearMotorista").is(":checked")+"&treinamentoMotorista="+$("#chk_treinamentoMotorista").is(":checked")+"&visVeiculo="+$("#chk_visVeiculo").is(":checked")+"&addVeiculo="+$("#chk_addVeiculo").is(":checked")+"&ediVeiculo="+$("#chk_ediVeiculo").is(":checked")+"&exVeiculo="+$("#chk_exVeiculo").is(":checked")+"&bloquearVeiculo="+$("#chk_bloquearVeiculo").is(":checked")+"&visValepedagio="+$("#chk_visValepedagio").is(":checked")+"&addValepedagio="+$("#chk_addValepedagio").is(":checked")+"&ediValepedagio="+$("#chk_ediValepedagio").is(":checked")+"&exValepedagio="+$("#chk_exValepedagio").is(":checked")+"&visDedicado="+$("#chk_visDedicado").is(":checked")+"&addDedicado="+$("#chk_addDedicado").is(":checked")+"&ediDedicado="+$("#chk_ediDedicado").is(":checked")+"&exDedicado="+$("#chk_exDedicado").is(":checked")+"&visRastreador="+$("#chk_visRastreador").is(":checked")+"&addRastreador="+$("#chk_addRastreador").is(":checked")+"&ediRastreador="+$("#chk_ediRastreador").is(":checked")+"&exRastreador="+$("#chk_exRastreador").is(":checked")+"&visOE="+$("#chk_visOE").is(":checked")+"&addOE="+$("#chk_addOE").is(":checked")+"&ediOE="+$("#chk_ediOE").is(":checked")+"&exOE="+$("#chk_exOE").is(":checked")+"&cancelarOE="+$("#chk_cancelarOE").is(":checked")+"&liberarOE="+$("#chk_liberarOE").is(":checked")+"&visTransportadora="+$("#chk_visTransportadora").is(":checked")+"&atuTransportadora="+$("#chk_atuTransportadora").is(":checked")+"&addTransportadora="+$("#chk_addTransportadora").is(":checked")+"&ediTransportadora="+$("#chk_ediTransportadora").is(":checked")+"&exTransportadora="+$("#chk_exTransportadora").is(":checked")+"&visDepositoTransportadora="+$("#chk_visDepositoTransportadora").is(":checked")+"&addDepositoTransportadora="+$("#chk_addDepositoTransportadora").is(":checked")+"&ediDepositoTransportadora="+$("#chk_ediDepositoTransportadora").is(":checked")+"&excDepositoTransportadora="+$("#chk_exDepositoTransportadora").is(":checked")+"&addExpedicoes="+$("#chk_addExpedicoes").is(":checked")+"&visExpedicoes="+$("#chk_visExpedicoes").is(":checked")+"&excExpedicoes="+$("#chk_excExpedicoes").is(":checked")+"&ediExpedicoes="+$("#chk_ediExpedicoes").is(":checked")+"&visPlanoViagem="+$("#chk_visPlanoViagem").is(":checked")+"&addPlanoViagem="+$("#chk_addPlanoViagem").is(":checked")+"&atuPlanoViagem="+$("#chk_atuPlanoViagem").is(":checked")+"&ediPlanoViagem="+$("#chk_ediPlanoViagem").is(":checked")+"&excPlanoViagem="+$("#chk_excPlanoViagem").is(":checked")+"&libPlanoViagem="+$("#chk_liberarPlanoViagem").is(":checked")+"&visLogisticaReversa="+$("#chk_visLogisticaReversa").is(":checked")+"&addLogisticaReversa="+$("#chk_addLogisticaReversa").is(":checked")+"&ediLogisticaReversa="+$("#chk_ediLogisticaReversa").is(":checked")+"&excLogisticaReversa="+$("#chk_excLogisticaReversa").is(":checked")+"&libLogisticaReversa="+$("#chk_liberarLogisticaReversa").is(":checked")+"&visCanhoto="+$("#chk_visCanhoto").is(":checked")+"&addCanhoto="+$("#chk_addCanhoto").is(":checked")+"&ediCanhoto="+$("#chk_ediCanhoto").is(":checked")+"&excCanhoto="+$("#chk_excCanhoto").is(":checked")+"&libCanhoto="+$("#chk_liberarCanhoto").is(":checked")+"&visCliente="+$("#chk_visCliente").is(":checked")+"&addCliente="+$("#chk_addCliente").is(":checked")+"&ediCliente="+$("#chk_ediCliente").is(":checked")+"&excCliente="+$("#chk_excCliente").is(":checked")+"&visTransit="+$("#chk_visTransitPoint").is(":checked")+"&addTransit="+$("#chk_addTransitPoint").is(":checked")+"&ediTransit="+$("#chk_ediTransitPoint").is(":checked")+"&excTransit="+$("#chk_excTransitPoint").is(":checked")+"&libTransit="+$("#chk_liberarTransitPoint").is(":checked")+"&visOcorrencias="+$("#chk_visOcorrencias").is(":checked")+"&addOcorrencias="+$("#chk_addOcorrencias").is(":checked")+"&ediOcorrencias="+$("#chk_ediOcorrencias").is(":checked")+"&excOcorrencias="+$("#chk_excOcorrencias").is(":checked")+"&libOcorrencias="+$("#chk_liberarOcorrencias").is(":checked")+"&visNaoConformidade="+$("#chk_visNaoConformidade").is(":checked")+"&addNaoConformidade="+$("#chk_addNaoConformidade").is(":checked")+"&ediNaoConformidade="+$("#chk_ediNaoConformidade").is(":checked")+"&excNaoConformidade="+$("#chk_excNaoConformidade").is(":checked")+"&libNaoConformidade="+$("#chk_liberarNaoConformidade").is(":checked")+"&visDiarias="+$("#chk_visDiarias").is(":checked")+"&addDiarias="+$("#chk_addDiarias").is(":checked")+"&ediDiarias="+$("#chk_ediDiarias").is(":checked")+"&excDiarias="+$("#chk_excDiarias").is(":checked")+"&libDiarias="+$("#chk_liberarDiarias").is(":checked")+"&transportadoras="+transportadora+"&centros="+centros+"&tipoCarregamento="+tipoCarregamento+"&tipoRelatorio="+tipoRelatorio ,
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA VER PERFIL    ####################### */
function verPerfil(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "usuario/perfil.php",
			data: "transportadora="+$("#cmb_transportadora").attr("value")+"&perfil="+$("#cmb_perfil").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
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
			data: "&transporte="+$("#txt_transporte").attr("value")+"&transportadora="+$("#cmb_transportadora").attr("value")+"&origem="+$("#cmb_origem").attr("value")+"&status="+$("#cmb_status").attr("value")+"&tipo="+$("#cmb_tipoViagem").attr("value")+"&carregamento="+$("#cmb_tipoCarregamento").attr("value")+"&dataInicio="+$("#txt_dataInicio").attr("value")+"&dataFim="+$("#txt_dataFim").attr("value")+"&filtro=1",
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
			url: "planodeviagem/visualizarExpedicoes.php",
			data: "&transporte="+$("#cmb_transporte").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}


/* #################     FUNÇÃO PARA VER CANHOTOS DE NOTAS FISCAIS    ####################### */
function verCanhoto(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "canhotosfiscais/visualizarCanhotos.php",
			data: "&transporte="+$("#txt_transporte").attr("value")+"&transportadora="+$("#cmb_transportadora").attr("value")+"&status="+$("#cmb_status").attr("value")+"&dataInicio="+$("#txt_dataInicio").attr("value")+"&dataFim="+$("#txt_dataFim").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA VER EXCLUIR EXPEDIÇÕES    ####################### */
function excluirExpedicoes(){

	var dados_aux = $("input[cidade=true]").serializeArray();
    var dados = "";
    jQuery.each(dados_aux, function(i, dado_id) {
		dados = dados + dado_id.value + "/";
    });
	
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "planodeviagem/visualizarExpedicoes.php",
			data: "&excluirTransporte="+$("#txt_numeroTransporte").attr("value")+"&cidade="+dados,
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA EXPORTAR EXPEDIÇÕES    ####################### */
function exportarExpedicoes(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "planodeviagem/exportaExpedicoes.php",
			data: "&dataInicio="+$("#txt_dataInicio").attr("value")+"&dataFim="+$("#txt_dataFim").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}


/* #################     FUNÇÃO PARA INCLUIR NOME DE RASTREADORES     ####################### */
function adicionarRastreador(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/rastreador.php",
			data: "addRastreador="+$("#txt_addRastreador").attr("value")+"&rastreador="+$("#txt_rastreador").attr("value")+"&situacao="+$("#cmb_situacao").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA VER RASTREADORES     ####################### */
function verRastreador(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/rastreador.php",
			data: "&rastreador="+$("#txt_rastreador").attr("value")+"&status="+$("#cmb_situacao").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA EXCLUIR OE     ####################### */
function excluirOE(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "excluirOE.php",
			data: "id_Excluir="+$("#txt_idOrdemDeEmbarque").attr("value")+"&motivoCancelamento="+$("#cmb_motivoCancelamento").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}


/* #################     FUNÇÃO PARA REENVIAR OE     ####################### */
function reenviarOE(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "reenviarOE.php",
			data: "id_ordemDeEmbarque="+$("#txt_idOrdemDeEmbarque").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA SOLICITAR CANCELAMENTO OE     ####################### */
function cancelarOE(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "cancelarOE.php",
			data: "id_ordemDeEmbarque="+$("#txt_idOrdemDeEmbarque").attr("value")+"&observacao="+$("#txt_observacao").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}


/* #################     FUNÇÃO PARA VER RASTREADOR    ####################### */
function rastreador(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "veiculo/rastreador.php",
			data: "transportadora="+$("#cmb_transportadora").attr("value")+"&rastreador="+$("#cmb_rastreador").attr("value")+"&site="+$("#txt_site").attr("value")+"&usuario="+$("#txt_usuario").attr("value")+"&senha="+$("#txt_senha").attr("value")+"&addRastreador="+$("#txt_addRastreador").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA INCLUIR TREINAMENTO     ####################### */
function treinamento(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "motorista/treinamento.php",
			data: "addTreinamento="+$("#txt_addTreinamento").attr("value")+"&motorista="+$("#cmb_motorista").attr("value")+"&dataTreinamento="+$("#txt_dataTreinamento").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}

/* #################     ADICIONAR GERENCIADORA DE RISCO    ####################### */
function gerenciadorRisco(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/gerenciadorDeRisco.php",
			data: "addGR="+$("#txt_addGR").attr("value")+"&gerenciador_risco="+$("#txt_gerenciador").attr("value")+"&situacao="+$("#cmb_situacao").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA VER MOTORISTAS    ####################### */
function verGR(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/gerenciadorDeRisco.php",
			data: "gr="+$("#txt_gerenciador").attr("value")+"&status="+$("#cmb_situacao").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}



/* #################     FUNÇÃO PARA ADICIONAR MARCA DE VEÍCULO    ####################### */
function adicionaMarca(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/marca.php",
			data: "addMarca="+$("#txt_addMarca").attr("value")+"&marca="+$("#txt_marca").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}



/* #################     FUNÇÃO PARA VER MARCA DE VEÍCULO   ####################### */
function verMarca(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/marca.php",
			data: "marca="+$("#txt_marca").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}


/* #################     FUNÇÃO PARA ADICIONAR COR DO VEÍCULO    ####################### */
function adicionaCor(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/cor.php",
			data: "addCor="+$("#txt_addCor").attr("value")+"&cor="+$("#txt_cor").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA VER COR    ####################### */
function verCor(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/cor.php",
			data: "cor="+$("#txt_cor").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA ADICIONAR E EDITAR RESPONSAVEL POR BLOQUEIO DE VEICULO OU MOTORISTA    ####################### */
function Responsavel(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/responsavelBloqueio.php",
			data: "addResponsavel="+$("#txt_addResponsavel").attr("value")+"&responsavelBloqueio="+$("#txt_nome").attr("value")+"&email="+$("#txt_email").attr("value")+"&situacao="+$("#cmb_situacao").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA VER RESPONSAVEL POR BLOQUEIO DE VEICULO OU MOTORISTA    ####################### */
function verResponsavel(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/responsavelBloqueio.php",
			data: "status="+$("#cmb_situacao").attr("value")+"&responsavel="+$("#txt_responsavel").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}



/* #################     FUNÇÃO PARA ADICIONAR CENTRO    ####################### */
function adicionarCentro(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/centroLogistico.php",
			data: "addCentro="+$("#txt_cidade").attr("value")+"&centro="+$("#cmb_centro").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}


/* #################     FUNÇÃO PARA VER CENTRO LOGISTICO    ####################### */
function verCentro(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/centroLogistico.php",
			data: "&centro="+$("#cmb_centro").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}




/* #################     FUNÇÃO PARA ADICIONAR DEPÓSITO    ####################### */
function adicionarDeposito(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/depositos.php",
			data: "addDeposito="+$("#txt_centroLogistico").attr("value")+"&centro="+$("#cmb_centro").attr("value")+"&deposito="+$("#txt_deposito").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}


/* #################     FUNÇÃO PARA VER DEPOSITOS    ####################### */
function verDeposito(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/depositos.php",
			data: "centro="+$("#cmb_centro").attr("value")+"&deposito="+$("#txt_deposito").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}




/* #################     FUNÇÃO PARA ADICIONAR TIPO CARREGAMENTO    ####################### */
function adicionarTipoCarregamento(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/tipoCarregamento.php",
			data: "addTipo="+$("#txt_addTipo").attr("value")+"&tipo="+$("#txt_tipo").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}


/* #################     FUNÇÃO PARA VER TIPO CARREGAMENTO    ####################### */
function verTipoCarregamento(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/tipoCarregamento.php",
			data: "tipo="+$("#txt_tipo").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}



/* #################     FUNÇÃO PARA ADICIONAR TIPO VIAGEM    ####################### */
function adicionarTipoViagem(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/tipoViagem.php",
			data: "addTipo="+$("#txt_addTipo").attr("value")+"&tipo="+$("#txt_tipo").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA VER TIPO VIAGEM    ####################### */
function verTipoViagem(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/tipoViagem.php",
			data: "tipo="+$("#txt_tipo").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA EDITAR TIPO VEICULO  ####################### */
function adicionarTipoVeiculo(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/tipoVeiculo.php",
			data: "addTipo="+$("#txt_addTipo").attr("value")+"&tipo="+$("#txt_tipo").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}



/* #################     FUNÇÃO PARA VER TIPO VEICULO    ####################### */
function verTipoVeiculo(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/tipoVeiculo.php",
			data: "tipo="+$("#txt_tipo").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}



/* #################     FUNÇÃO PARA ADICIONAR TREINAMENTO    ####################### */
function adicionarTreinamento(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/treinamento.php",
			data: "addTreinamento="+$("#txt_addTreinamento").attr("value")+"& treinamento="+$("#txt_treinamento").attr("value")+"&validade="+$("#txt_validade").attr("value")+"&situacao="+$("#cmb_situacao").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}


/* #################     FUNÇÃO PARA VER TREINAMENTOS    ####################### */
function verTreinamento(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/treinamento.php",
			data: "treinamento="+$("#txt_treinamento").attr("value")+"&status="+$("#cmb_situacao").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA ADICIONAR DEDICADO    ####################### */
function adicionarDedicado(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/dedicados.php",
			data: "addDedicado="+$("#txt_addDedicado").attr("value")+"&dedicado="+$("#txt_dedicado").attr("value")+"&transportadora="+$("#cmb_transportadora").attr("value")+"&capacidade="+$("#txt_capacidade").attr("value")+"&tipo="+$("#cmb_tipoVeiculo").attr("value")+"&tipoDedicado="+$("#cmb_tipoDedicado").attr("value")+"&situacao="+$("#cmb_situacao").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}



/* #################     FUNÇÃO PARA VER DEDICADOS    ####################### */
function verDedicado(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/dedicados.php",
			data: "transportadora="+$("#cmb_transportadora").attr("value")+"&dedicado="+$("#txt_dedicado").attr("value")+"&tipo="+$("#cmb_tipoVeiculo").attr("value")+"&tipoDedicado="+$("#cmb_tipoDedicado").attr("value")+"&status="+$("#cmb_situacao").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA VER CIRCUITOS    ####################### */
function verCircuito(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/circuitos.php",
			data: "circuito="+$("#txt_circuito").attr("value")+"&status="+$("#cmb_situacao").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA ADICIONAR CIRCUITO    ####################### */
function adicionarCircuito(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "tabelas/circuitos.php",
			data: "addCircuito="+$("#txt_addCircuito").attr("value")+"&circuito="+$("#txt_circuito").attr("value")+"&origem="+$("#cmb_origem").attr("value")+"&destino="+$("#cmb_destino").attr("value")+"&situacao="+$("#cmb_situacao").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}

function verCircuitoMontados(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "circuito/circuito.php",
			data: "circuito="+$("#txt_circuito").attr("value")+"&status="+$("#cmb_situacao").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}
function adicionaOcorrencia(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "ocorrencia/ocorrencia.php",
			data: "id_interlocutor="+$("#cmb_interlocutor").attr("value")+"&id_ordemDeEmbarque="+$("#cmb_numeroTransporte").attr("value")+"&id_transportadora="+$("#cmb_transportadora").attr("value")+"&id_motorista="+$("#cmb_motorista").attr("value")+"&notasFiscais="+$("#txt_notasFiscais").attr("value")+"&id_cliente="+$("#cmb_cliente").attr("value")+"&id_motivo="+$("#cmb_motivo").attr("value")+"&descricao="+$("#txt_descricao").attr("value")+"&addOcorrencia=1",
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
			});
	return false;
}
/* #################     FUNÇÃO PARA ADICIONAR PARADAS NOS CIRCUITOS MONTADOS   ####################### */
function adicionarCircuitoMontados(){
	var dadosOrdem = $("input[tempo=true]").serializeArray();
    var tempo = "&";
    jQuery.each(dadosOrdem, function(i, dado_id) {
    	tempo = tempo + "tempoParada[]=" + dado_id.value + "&";
    });
    
    var dadosCidade = $("select[cidade=true]").serializeArray();
    var cidade = "&";
    jQuery.each(dadosCidade, function(i, dado_id) {
    	cidade = cidade + "cidade[]=" + dado_id.value + "&";
    });
	
    var dadosTipoEntrega = $("select[parada=true]").serializeArray();
    var tipoParada = "&";
    jQuery.each(dadosTipoEntrega, function(i, dado_id) {
    	tipoParada = tipoParada + "tipoParada[]=" + dado_id.value + "&";
    });
    
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "circuito/circuito.php",
			data: "addCircuito="+$("#txt_addCircuito").attr("value")+"&circuito="+$("#cmb_Circuito").attr("value")+tempo+tipoParada+cidade,
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}

var ordemCircuito = 0;
function adicionaParadasCircuito(){
	ordemCircuito++;
	$.ajax({async: true,
		type: "POST",
		dataType: "html",
		url: "circuito/circuito.php",
		data: "retornaCircuito=1+&ordem="+ordemCircuito,
		beforeSend: mostrarCarregando,
		success: function(txt) {
			
			aposCarregamento();
			var html = $('#div_paradasCircuito').html();
			$('#div_paradasCircuito').html(html+txt);
			
		},
		error: erro
	   });
	
	return false;		
				
}

/* #################     FUNÇÃO PARA ADICIONAR DOCUMENTOS    ####################### */
function adicionarDocumentos(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "anexarDocumentos.php",
			data: "idOrdemDeEmbarque="+$("#txt_idOrdemDeEmbarque").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
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

/* #################     FUNÇÃO PARA SELECIONAR O ENDERECO DE ACORDO COM O CLIENTE    ####################### */
function mostraEndereco(id_cliente){
	
	$.ajax({async: true,
		type: "POST",
		dataType: "html",
		url: "logisticareversa/addOc.php",
		data: "cliente="+id_cliente+"&filtraEndereco=1",
		beforeSend: mostrarCarregando,
		success: function(txt) {
			
			aposCarregamento();
			$('#div_endereco').html(txt);
			
		},
		error: erro
	   });
return false;
	
}


function tipoCliente(){

	if(document.getElementById('cmb_tipoCliente').value==4){
		$("#div_tipoCliente").fadeIn(200);
		document.getElementById('cmb_dedicado').disabled=false;
		document.getElementById('txt_dBelgo').disabled=true;
		document.getElementById('cmb_transportadora').disabled=true;
		document.getElementById('cmb_tipoViagem').disabled=true;
		document.getElementById('cmb_tipoVeiculo').disabled=true;
		document.getElementById('cmb_motorista').disabled=true;
		
	}else{
		$("#div_tipoCliente").fadeIn(200);
		document.getElementById('txt_dBelgo').disabled=true;
		document.getElementById('cmb_dedicado').disabled=true;
		document.getElementById('txt_dBelgo').disabled=true;
		document.getElementById('cmb_transportadora').disabled=false;
		document.getElementById('cmb_tipoViagem').disabled=false;
		document.getElementById('cmb_tipoVeiculo').disabled=false;
		document.getElementById('cmb_motorista').disabled=false;
	}
	
}


/* #################     FUNÇÃO PARA ADICIONAR CLINTES    ####################### */
function clientes(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "clientes/clientes.php",
			data: "addCliente="+$("#txt_addCliente").attr("value")+"&codigo="+$("#txt_codigo").attr("value")+"&sigla="+$("#txt_sigla").attr("value")+"&razaoSocial="+$("#txt_razaoSocial").attr("value")+"&cep="+$("#txt_cep").attr("value")+"&endereco="+$("#txt_endereco").attr("value")+"&bairro="+$("#txt_bairro").attr("value")+"&cidade="+$("#txt_cidade").attr("value")+"&numero="+$("#txt_numero").attr("value")+"&telefone="+$("#txt_telefone").attr("value")+"&cpf="+$("#txt_cpf").attr("value")+"&cnpj="+$("#txt_cnpj").attr("value")+"&tipoCliente="+$("#cmb_tipoCliente").attr("value")+"&insEstadual="+$("#txt_insEstadual").attr("value")+"&celula="+$("#cmb_celula").attr("value")+"&canal="+$("#cmb_canal").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucessoFuncao,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA VER CLIENTES    ####################### */
function verClientes(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "clientes/clientes.php",
			data: "codigo="+$("#txt_codigo").attr("value")+"&sigla="+$("#txt_sigla").attr("value")+"&razaoSocial="+$("#txt_razaosocial").attr("value")+"&cidade="+$("#cmb_cidade").attr("value")+"&uf="+$("#cmb_uf").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA RETORNAR TIPO DE CLIENTE    ####################### */
function retornaTipoCliente(tipoCliente, cliente){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "clientes/clientes.php",
			data: "tipoClienteSelecionado="+tipoCliente+"&id_cliente="+cliente,
			beforeSend: mostrarCarregando,
			success: function(txt) {
				
				aposCarregamento();
				$('#div_tipoCliente').html(txt);
				
			},
			error: erro
		   });
	return false;
}


/* #################     FUNÇÃO PARA ADICIONAR OE    ####################### */
function adicionaOc(){
	
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "logisticareversa/addOc.php",
			data: "id_cliente="+$("#cmb_cliente").attr("value")+"&num_oc="+$("#num_oc").attr("value")+"&origem="+$("#cmb_origem").attr("value")+"&destino="+$("#cmb_destino").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucessoFuncao,
			error: erro
		   });
	return false;
}


/* #################     FUNÇÃO PARA EDITAR USUÁRIO    ####################### */
function editaUsuario(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "usuario/visualizarUsuario.php",
			data: "id_usuario="+$("#id").attr("value")+"&nome="+$("#nome").attr("value")+"&usuario="+$("#usuario").attr("value")+"&situacao="+$("#situacao").attr("value")+"&email="+$("#email").attr("value")+"&senha="+$("#senha").attr("value")+"&transportadora="+$("#transportadora").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA ALTERAR SENHA USUÁRIO    ####################### */
function alterarSenha(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "usuario/alterarSenha.php",
			data: "id_usuario="+$("#txt_id_usuario").attr("value")+"&senha="+$("#txt_senha").attr("value")+"&senhaNova="+$("#txt_novaSenha").attr("value")+"&senhaNova2="+$("#txt_novaSenha").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}

/* #################     FUNÇÃO PARA ALTERAR SENHA USUÁRIO NO 1º ACESSO   ####################### */
function alterarSenhaInicial(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "alterarSenha.php",
			data: "id_usuario="+$("#txt_id_usuario").attr("value")+"&senhaNova="+$("#txt_novaSenha").attr("value")+"&senhaNova2="+$("#txt_novaSenha2").attr("value"),
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}


/* #################     FUNÇÃO PARA VER OE    ####################### */
function verPV(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "planodeviagem/visualizarPV.php",
			data: "&transporte="+$("#txt_transporte").attr("value")+"&transportadora="+$("#cmb_transportadora").attr("value")+"&origem="+$("#cmb_origem").attr("value")+"&status="+$("#cmb_status").attr("value")+"&tipo="+$("#cmb_tipoViagem").attr("value")+"&carregamento="+$("#cmb_tipoCarregamento").attr("value")+"&dataInicio="+$("#txt_dataInicio").attr("value")+"&dataFim="+$("#txt_dataFim").attr("value")+"&filtro=1",
			beforeSend: mostrarCarregando,
			success: sucessoFiltro,
			error: erro
		   });
	return false;
}

function montaEntregas(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "planodeviagem/adicionaPlanoDeViagem.php",
			data: "id_ordemDeEmbarque="+$("#txt_id_ordemDeEmbarque").attr("value")+"&dataInicio="+$("#txt_dataInicio").attr("value")+"&horaInicio="+$("#txt_horaInicio").attr("value")+"&circuito="+$("#cmb_circuito").attr("value")+"&tipoViagem="+$("#cmb_tipoViagem").attr("value")+"&dataSaidaDeposito="+$("#txt_dataSaida").attr("value")+"&montaEntregas=1",
			beforeSend: mostrarCarregando,
			success: function(dados){
				aposCarregamento();
				$('#div_pontosDeParada').html(dados);
			},
			error: erro
		   });
	return false;
}
function addOcorrenciaPV(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "planodeviagem/rastrear.php",
			data: "id_planoDeViagem="+$("#txt_id_planoDeViagem").attr("value")+"&data="+$("#txt_data").attr("value")+"&hora="+$("#txt_hora").attr("value")+"&id_cidade="+$("#cmb_cidade").attr("value")+"&motivo="+$("#cmb_motivoOcorrencia").attr("value")+"&observacao="+$("#txt_observacao").attr("value")+"&hora="+$("#txt_hora").attr("value")+"&addOC=1",
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
}
function sinalizarEntrega(id_pontosParada){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "planodeviagem/rastrear.php",
			data: "id_planoDeViagem="+$("#txt_id_planoDeViagem").attr("value")+"&id_pontosParada="+id_pontosParada+"&sinalizarEntrega=1",
			beforeSend: mostrarCarregando,
			success: function(dados){
				aposCarregamento();
				$('#div_sinalizacaoDeEntrega').html(dados);
			},
			error: erro
		   });
	return false;
}
function sinalizarPonto(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "planodeviagem/rastrear.php",
			data: "id_planoDeViagem="+$("#txt_id_planoDeViagem").attr("value")+"&id_pontosParada="+$("#txt_id_pontosParada").attr("value")+"&previsao="+$("#txt_previsao").attr("value")+"&dataChegada="+$("#txt_dataChegada").attr("value")+"&horaChegada="+$("#txt_horaChegada").attr("value")+"&id_motivoAtraso="+$("#cmb_motivoAtraso").attr("value")+"&sinalizaEntrega=1",
			beforeSend: mostrarCarregando,
			success: function(dados){
				aposCarregamento();
				$('#div_motivoAtraso').html(dados);
			},
			error: erro
		   });
	return false;
}
function enviaSinalizacao(){
	$.ajax({async: true,
			type: "POST",
			dataType: "html",
			url: "planodeviagem/rastrear.php",
			data: "id_planoDeViagem="+$("#txt_id_planoDeViagem").attr("value")+"&id_pontosParada="+$("#txt_id_pontosParada").attr("value")+"&dataChegada="+$("#txt_dataChegada").attr("value")+"&horaChegada="+$("#txt_horaChegada").attr("value")+"&id_motivoAtraso="+$("#cmb_motivoAtraso").attr("value")+"&enviaSinalizacao=1",
			beforeSend: mostrarCarregando,
			success: sucesso,
			error: erro
		   });
	return false;
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
        if($.trim($("#txt_cpf").val()) != ""){
            /* 
                Para conectar no serviço e executar o json, precisamos usar a função 
                getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros 
                dataTypes não possibilitam esta interação entre domínios diferentes 
                Estou chamando a url do serviço passando o parâmetro "formato=javascript" e o CEP digitado no formulário 
                http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val() 
            */

            $.getScript("motorista/motorista.php?cpfMotorista="+$("#txt_cpf").val(), function(){
                // o getScript dá um eval no script, então é só ler!  
                //Se o resultado for igual a 1
				
                    // troca o valor dos elementos  
					$("#txt_nome").val(unescape(resultadoMotorista["nome"]));
                    $("#txt_cep").val(unescape(resultadoMotorista["cep"]));
					$("#txt_logradouro").val(unescape(resultadoMotorista["logradouro"]));  
					$("#txt_endereco").val(unescape(resultadoMotorista["rua"]));  
					$("#txt_bairro").val(unescape(resultadoMotorista["bairro"]));  
					$("#txt_cidade").val(unescape(resultadoMotorista["cidade"]));
					$("#txt_numero").val(unescape(resultadoMotorista["numero"]));  
					$("#txt_rg").val(unescape(resultadoMotorista["rg"]));  
					$("#txt_telefone").val(unescape(resultadoMotorista["telefone"]));  
					$("#txt_celular").val(unescape(resultadoMotorista["celular"]));  
					$("#txt_cnh").val(unescape(resultadoMotorista["cnh"]));  
					$("#txt_dataNascimento").val(unescape(resultadoMotorista["dataNascimento"]));	
                
            });
        
		aposCarregamento();
		}
		
}

//############################         SE FOR RASTREADOR FIXO E JABUR PREENCHE PLACA           ############################
function verificaJabur(id_rastreador){
	
	mostrarCarregando();
	//document.formul.miSelect.options[indice].text
	var indice = document.getElementById('cmb_rastreador').selectedIndex;
	var rastreador = document.getElementById('cmb_rastreador').options[indice].text;
	if(rastreador=='Jabur Sat'){
		
		if(document.getElementById('txt_placa').value!='')
			$("#txt_modulo").val(unescape(document.getElementById('txt_placa').value.substr(0,3)+document.getElementById('txt_placa').value.substr(4,4)));
		else
			$("#txt_modulo").val(unescape(document.getElementById('txt_placa2').value.substr(0,3)+document.getElementById('txt_placa2').value.substr(4,4)));
		document.getElementById('txt_modulo').readOnly = true;
		
	}else
		$("#txt_modulo").val(unescape(''));
	
	aposCarregamento();
	
}

// ############################         CONSULTA O CPF E RETORNA DADOS           ############################
function consultaCEP() {  
        // Se o campo CEP não estiver vazio  
		mostrarCarregando();
        if($.trim($("#txt_cep").val()) != ""){
            /* 
                Para conectar no serviço e executar o json, precisamos usar a função 
                getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros 
                dataTypes não possibilitam esta interação entre domínios diferentes 
                Estou chamando a url do serviço passando o parâmetro "formato=javascript" e o CEP digitado no formulário 
                http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val() 
            */

            $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#txt_cep").val(), function(){  
                // o getScript dá um eval no script, então é só ler!  
                //Se o resultado for igual a 1  
				if(resultadoCEP["resultado"]==1){
                    // troca o valor dos elementos  
                    $("#txt_endereco").val(unescape(resultadoCEP["logradouro"]));  
					$("#txt_logradouro").val(unescape(resultadoCEP["tipo_logradouro"]));  
                    $("#txt_bairro").val(unescape(resultadoCEP["bairro"]));
                    $("#txt_cidade").val(unescape(resultadoCEP["cidade"]) + " - " + unescape(resultadoCEP["uf"]) );  
					//$("#siglaUF").val(unescape(resultadoCEP["uf"]));
					//aposCarregamento();
                }else{  
                    alert("CEP não encontrado em nossa base de dados! Se tiver certeza favor prosseguir o cadastro do motorista!");  
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
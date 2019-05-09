/* #################     MARCA E DESMARCA TODOS - PERFIS USUÁRIOS    ####################### */
function marcaUsuarios(){
	//usuários
	if(document.getElementById('chk_todosUsuarios').checked==true){
		document.getElementById('chk_visUsuarios').checked=true;
		document.getElementById('chk_addUsuarios').checked=true;
		document.getElementById('chk_ediUsuarios').checked=true;
		document.getElementById('chk_exUsuarios').checked=true;
	}else{
		document.getElementById('chk_visUsuarios').checked=false;
		document.getElementById('chk_addUsuarios').checked=false;
		document.getElementById('chk_ediUsuarios').checked=false;
		document.getElementById('chk_exUsuarios').checked=false;
	}
}


function marcaPerfil(){
	//usuários
	if(document.getElementById('chk_todosPerfil').checked==true){
		document.getElementById('chk_visPerfil').checked=true;
		document.getElementById('chk_addPerfil').checked=true;
		document.getElementById('chk_ediPerfil').checked=true;
		document.getElementById('chk_exPerfil').checked=true;
	}else{
		document.getElementById('chk_visPerfil').checked=false;
		document.getElementById('chk_addPerfil').checked=false;
		document.getElementById('chk_ediPerfil').checked=false;
		document.getElementById('chk_exPerfil').checked=false;
	}
}

function marcaTabelas(){
	//tabelas
	if(document.getElementById('chk_todosTabelas').checked==true){
		document.getElementById('chk_visTabelas').checked=true;
		document.getElementById('chk_addTabelas').checked=true;
		document.getElementById('chk_ediTabelas').checked=true;
		document.getElementById('chk_excTabelas').checked=true;
		
	}else{
		document.getElementById('chk_visTabelas').checked=false;
		document.getElementById('chk_addTabelas').checked=false;
		document.getElementById('chk_ediTabelas').checked=false;
		document.getElementById('chk_excTabelas').checked=false;
		
	}
}

function marcaMotorista(){
	//motoristas
	if(document.getElementById('chk_todosMotorista').checked==true){
		document.getElementById('chk_visMotorista').checked=true;
		document.getElementById('chk_addMotorista').checked=true;
		document.getElementById('chk_ediMotorista').checked=true;
		document.getElementById('chk_exMotorista').checked=true;
		document.getElementById('chk_bloquearMotorista').checked=true;
		document.getElementById('chk_treinamentoMotorista').checked=true;
	}else{
		document.getElementById('chk_visMotorista').checked=false;
		document.getElementById('chk_addMotorista').checked=false;
		document.getElementById('chk_ediMotorista').checked=false;
		document.getElementById('chk_exMotorista').checked=false;
		document.getElementById('chk_bloquearMotorista').checked=false;
		document.getElementById('chk_treinamentoMotorista').checked=false;
	}
}

function marcaVeiculo(){
	//marcas de veiculos
	if(document.getElementById('chk_todosVeiculo').checked==true){
		document.getElementById('chk_visVeiculo').checked=true;
		document.getElementById('chk_addVeiculo').checked=true;
		document.getElementById('chk_ediVeiculo').checked=true;
		document.getElementById('chk_exVeiculo').checked=true;
		document.getElementById('chk_bloquearVeiculo').checked=true;
	}else{
		document.getElementById('chk_visVeiculo').checked=false;
		document.getElementById('chk_addVeiculo').checked=false;
		document.getElementById('chk_ediVeiculo').checked=false;
		document.getElementById('chk_exVeiculo').checked=false;
		document.getElementById('chk_bloquearVeiculo').checked=false;
	}
}



function marcaValepedagio(){
	//marcas de vale pedagio
	if(document.getElementById('chk_todosValepedagio').checked==true){
		document.getElementById('chk_visValepedagio').checked=true;
		document.getElementById('chk_addValepedagio').checked=true;
		document.getElementById('chk_ediValepedagio').checked=true;
		document.getElementById('chk_exValepedagio').checked=true;
	}else{
		document.getElementById('chk_visValepedagio').checked=false;
		document.getElementById('chk_addValepedagio').checked=false;
		document.getElementById('chk_ediValepedagio').checked=false;
		document.getElementById('chk_exValepedagio').checked=false;
	}
}


function marcaDedicado(){
	//marcas de veiculos
	if(document.getElementById('chk_todosDedicado').checked==true){
		document.getElementById('chk_visDedicado').checked=true;
		document.getElementById('chk_addDedicado').checked=true;
		document.getElementById('chk_ediDedicado').checked=true;
		document.getElementById('chk_exDedicado').checked=true;
	}else{
		document.getElementById('chk_visDedicado').checked=false;
		document.getElementById('chk_addDedicado').checked=false;
		document.getElementById('chk_ediDedicado').checked=false;
		document.getElementById('chk_exDedicado').checked=false;
	}
}

function marcaRastreador(){
	//marcas de veiculos
	if(document.getElementById('chk_todosRastreador').checked==true){
		document.getElementById('chk_visRastreador').checked=true;
		document.getElementById('chk_addRastreador').checked=true;
		document.getElementById('chk_ediRastreador').checked=true;
		document.getElementById('chk_exRastreador').checked=true;
	}else{
		document.getElementById('chk_visRastreador').checked=false;
		document.getElementById('chk_addRastreador').checked=false;
		document.getElementById('chk_ediRastreador').checked=false;
		document.getElementById('chk_exRastreador').checked=false;
	}
}

function marcaOE(){
	//ordem de embarqque
	if(document.getElementById('chk_todosOE').checked==true){
		document.getElementById('chk_visOE').checked=true;
		document.getElementById('chk_addOE').checked=true;
		document.getElementById('chk_ediOE').checked=true;
		document.getElementById('chk_exOE').checked=true;
		document.getElementById('chk_cancelarOE').checked=true;
		document.getElementById('chk_liberarOE').checked=true;
	}else{
		document.getElementById('chk_visOE').checked=false;
		document.getElementById('chk_addOE').checked=false;
		document.getElementById('chk_ediOE').checked=false;
		document.getElementById('chk_exOE').checked=false;
		document.getElementById('chk_cancelarOE').checked=false;
		document.getElementById('chk_liberarOE').checked=false;
	}
}

function marcaTransportadora(){
	//transportadoras 
	if(document.getElementById('chk_todosTransportadora').checked==true){
		document.getElementById('chk_visTransportadora').checked=true;
		document.getElementById('chk_addTransportadora').checked=true;
		document.getElementById('chk_atuTransportadora').checked=true;
		document.getElementById('chk_ediTransportadora').checked=true;
		document.getElementById('chk_exTransportadora').checked=true;
		
	}else{
		document.getElementById('chk_visTransportadora').checked=false;
		document.getElementById('chk_addTransportadora').checked=false;
		document.getElementById('chk_atuTransportadora').checked=false;
		document.getElementById('chk_ediTransportadora').checked=false;
		document.getElementById('chk_exTransportadora').checked=false;
	}
}


function marcaDepositoTransportadora(){
	//transportadoras 
	if(document.getElementById('chk_todosDepositoTransportadora').checked==true){
		document.getElementById('chk_visDepositoTransportadora').checked=true;
		document.getElementById('chk_addDepositoTransportadora').checked=true;
		document.getElementById('chk_ediDepositoTransportadora').checked=true;
		document.getElementById('chk_exDepositoTransportadora').checked=true;
		
	}else{
		document.getElementById('chk_visDepositoTransportadora').checked=false;
		document.getElementById('chk_addDepositoTransportadora').checked=false;
		document.getElementById('chk_ediDepositoTransportadora').checked=false;
		document.getElementById('chk_exDepositoTransportadora').checked=false;
	}
}


function marcaExpedicoes(){
	//expedições 
	if(document.getElementById('chk_todosExpedicao').checked==true){
		document.getElementById('chk_visExpedicoes').checked=true;
		document.getElementById('chk_addExpedicoes').checked=true;
		document.getElementById('chk_ediExpedicoes').checked=true;
		document.getElementById('chk_excExpedicoes').checked=true;
	}else{
		document.getElementById('chk_visExpedicoes').checked=false;
		document.getElementById('chk_addExpedicoes').checked=false;
		document.getElementById('chk_ediExpedicoes').checked=false;
		document.getElementById('chk_excExpedicoes').checked=false;
	}
}


function marcaPlanoViagem(){
	//plano de viagem
	if(document.getElementById('chk_todosPlano').checked==true){
		document.getElementById('chk_visPlanoViagem').checked=true;
		document.getElementById('chk_addPlanoViagem').checked=true;
		document.getElementById('chk_atuPlanoViagem').checked=true;
		document.getElementById('chk_ediPlanoViagem').checked=true;
		document.getElementById('chk_excPlanoViagem').checked=true;
		document.getElementById('chk_liberarPlanoViagem').checked=true;
		
	}else{
		document.getElementById('chk_visPlanoViagem').checked=false;
		document.getElementById('chk_addPlanoViagem').checked=false;
		document.getElementById('chk_atuPlanoViagem').checked=false;
		document.getElementById('chk_ediPlanoViagem').checked=false;
		document.getElementById('chk_excPlanoViagem').checked=false;
		document.getElementById('chk_liberarPlanoViagem').checked=false;
	}
}

function marcaLogisticaReversa(){
	//logistica reversa
	if(document.getElementById('chk_todosLogisticaReversa').checked==true){
		document.getElementById('chk_visLogisticaReversa').checked=true;
		document.getElementById('chk_addLogisticaReversa').checked=true;
		document.getElementById('chk_ediLogisticaReversa').checked=true;
		document.getElementById('chk_excLogisticaReversa').checked=true;
		document.getElementById('chk_liberarLogisticaReversa').checked=true;
		
	}else{
		document.getElementById('chk_visLogisticaReversa').checked=false;
		document.getElementById('chk_addLogisticaReversa').checked=false;
		document.getElementById('chk_ediLogisticaReversa').checked=false;
		document.getElementById('chk_excLogisticaReversa').checked=false;
		document.getElementById('chk_liberarLogisticaReversa').checked=false;
	}
}

function marcaCanhoto(){
	//canhotos fiscais
	if(document.getElementById('chk_todosCanhoto').checked==true){
		document.getElementById('chk_visCanhoto').checked=true;
		document.getElementById('chk_addCanhoto').checked=true;
		document.getElementById('chk_ediCanhoto').checked=true;
		document.getElementById('chk_excCanhoto').checked=true;
		document.getElementById('chk_liberarCanhoto').checked=true;
		
	}else{
		document.getElementById('chk_visCanhoto').checked=false;
		document.getElementById('chk_addCanhoto').checked=false;
		document.getElementById('chk_ediCanhoto').checked=false;
		document.getElementById('chk_excCanhoto').checked=false;
		document.getElementById('chk_liberarCanhoto').checked=false;
	}
}


function marcaClientes(){
	//canhotos fiscais
	if(document.getElementById('chk_todosCliente').checked==true){
		document.getElementById('chk_visCliente').checked=true;
		document.getElementById('chk_addCliente').checked=true;
		document.getElementById('chk_ediCliente').checked=true;
		document.getElementById('chk_excCliente').checked=true;
		
	}else{
		document.getElementById('chk_visCliente').checked=false;
		document.getElementById('chk_addCliente').checked=false;
		document.getElementById('chk_ediCliente').checked=false;
		document.getElementById('chk_excCliente').checked=false;
	}
}


function marcaTransitPoint(){
	//canhotos fiscais
	if(document.getElementById('chk_todosTransitPoint').checked==true){
		document.getElementById('chk_visTransitPoint').checked=true;
		document.getElementById('chk_addTransitPoint').checked=true;
		document.getElementById('chk_ediTransitPoint').checked=true;
		document.getElementById('chk_excTransitPoint').checked=true;
		document.getElementById('chk_liberarTransitPoint').checked=true;
		
	}else{
		document.getElementById('chk_visTransitPoint').checked=false;
		document.getElementById('chk_addTransitPoint').checked=false;
		document.getElementById('chk_ediTransitPoint').checked=false;
		document.getElementById('chk_excTransitPoint').checked=false;
		document.getElementById('chk_liberarTransitPoint').checked=false;
	}
}


function marcaOcorrencias(){
	//canhotos fiscais
	if(document.getElementById('chk_todosOcorrencias').checked==true){
		document.getElementById('chk_visOcorrencias').checked=true;
		document.getElementById('chk_addOcorrencias').checked=true;
		document.getElementById('chk_ediOcorrencias').checked=true;
		document.getElementById('chk_excOcorrencias').checked=true;
		document.getElementById('chk_liberarOcorrencias').checked=true;
		
	}else{
		document.getElementById('chk_visOcorrencias').checked=false;
		document.getElementById('chk_addOcorrencias').checked=false;
		document.getElementById('chk_ediOcorrencias').checked=false;
		document.getElementById('chk_excOcorrencias').checked=false;
		document.getElementById('chk_liberarOcorrencias').checked=false;
	}
}


function marcaNaoConformidade(){
	//canhotos fiscais
	if(document.getElementById('chk_todosNaoConformidade').checked==true){
		document.getElementById('chk_visNaoConformidade').checked=true;
		document.getElementById('chk_addNaoConformidade').checked=true;
		document.getElementById('chk_ediNaoConformidade').checked=true;
		document.getElementById('chk_excNaoConformidade').checked=true;
		document.getElementById('chk_liberarNaoConformidade').checked=true;
		
	}else{
		document.getElementById('chk_visNaoConformidade').checked=false;
		document.getElementById('chk_addNaoConformidade').checked=false;
		document.getElementById('chk_ediNaoConformidade').checked=false;
		document.getElementById('chk_excNaoConformidade').checked=false;
		document.getElementById('chk_liberarNaoConformidade').checked=false;
	}
}


function marcaDiarias(){
	//canhotos fiscais
	if(document.getElementById('chk_todosDiarias').checked==true){
		document.getElementById('chk_visDiarias').checked=true;
		document.getElementById('chk_addDiarias').checked=true;
		document.getElementById('chk_ediDiarias').checked=true;
		document.getElementById('chk_excDiarias').checked=true;
		document.getElementById('chk_liberarDiarias').checked=true;
		
	}else{
		document.getElementById('chk_visDiarias').checked=false;
		document.getElementById('chk_addDiarias').checked=false;
		document.getElementById('chk_ediDiarias').checked=false;
		document.getElementById('chk_excDiarias').checked=false;
		document.getElementById('chk_liberarDiarias').checked=false;
	}
}

function marcaTodasTransportadoras(){
	
	if(document.getElementById('chk_todasTranportadoras').checked==true){
		$("input[transportadora=true]").each(function() { 
			this.checked = true; 
		});
	}else{
		$("input[transportadora=true]").each(function() { 
			this.checked = false; 
		});
	}
  
}


function marcaTodosCentros(){
	
	if(document.getElementById('chk_todosCentros').checked==true){
		$("input[centro=true]").each(function() { 
			this.checked = true; 
		});
	}else{
		$("input[centro=true]").each(function() { 
			this.checked = false; 
		});
	}
	  
}



function marcaTodosCarregamentos(){
	
	if(document.getElementById('chk_todosCarregamentos').checked==true){
		$("input[tipoCarregamento=true]").each(function() { 
			this.checked = true; 
		});
	}else{
		$("input[tipoCarregamento=true]").each(function() { 
			this.checked = false; 
		});
	}
  
}

function marcaTodosRelatorios(){
	
	if(document.getElementById('chk_todosRelatorios').checked==true){
		$("input[tipoRelatorio=true]").each(function() { 
			this.checked = true; 
		});
	}else{
		$("input[tipoRelatorio=true]").each(function() { 
			this.checked = false; 
		});
	}

}

function operacoesCliente(){
			$.ajax({async: true,
					type: "POST",
					dataType: "html",
					url: "cliente.php",
					data: "metodo="+$("#metodo").attr("value")+	
							"&id_cliente="+$("#id_cliente").attr("value")+
							"&nome="+$("#nome").attr("value")+
							"&sigla="+$("#sigla").attr("value")+						
							"&razaoSocial="+$("#razaoSocial").attr("value")+
							"&cep="+$("#cep").attr("value")+
							"&cpf="+$("#cpf").attr("value")+
							"&cnpj="+$("#cnpj").attr("value")+
							"&endereco="+$("#endereco").attr("value")+
							"&bairro="+$("#bairro").attr("value")+
							"&cidade="+$("#cidade").attr("value")+
							"&numero="+$("#numero").attr("value")+
							"&telefone="+$("#telefone").attr("value")+
							"&inscricaoEstadual="+$("#inscricaoEstadual").attr("value")+
							"&acao="+$("#acao").attr("value"),
					beforeSend: mostrarCarregando,
					success: sucesso,
					error: erro
				   });
			return false;
	}

function verClientes(){
	$.ajax({async: true,
			type: "GET",
			dataType: "html",
			url: "cliente.php",
			data: "metodo="+$("#metodo").attr("value")+	
					"&id_cliente="+$("#id_cliente").attr("value")+
					"&sigla="+$("#sigla").attr("value")+
					"&razaoSocial="+$("#razaoSocial").attr("value")+
					"&cep="+$("#cep").attr("value")+
					"&uf="+$("#uf").attr("value")+
					"&cidade="+$("#cidade").attr("value")+
					"&acao="+$("#acao").attr("value"),
			beforeSend: mostrarCarregando,
			success: function(txt) {				
				aposCarregamento();
				$('#div_resultadoPesquisa').html(txt);
				
			},
			error: erro
		   });
	return false;
}

function pessoaFisicaEPJ(identificador){
	if(identificador==1){
		$('#pj').fadeIn('slow');
		$('#pf').fadeOut('slow');
		$('#erro').val('');
		document.getElementById('erro').style.display='none';
		document.getElementById('cnpj').disabled=false;
		document.getElementById('inscricaoEstadual').disabled=false;
		document.getElementById('sigla').disabled=false;
		document.getElementById('razaoSocial').disabled=false;
		document.getElementById('cpf').disabled=true;		
		
	}else{
		$('#pf').fadeIn('slow');
		$('#pj').fadeOut('slow');
		document.getElementById('erro').style.display='none';
		document.getElementById('cpf').disabled=false;
		document.getElementById('cnpj').disabled=true;
		document.getElementById('inscricaoEstadual').disabled=true;
		document.getElementById('sigla').disabled=true;
		document.getElementById('razaoSocial').disabled=true;	
	}
}
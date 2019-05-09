/**
 * 
 */

function operacoesMotorista(){
			$.ajax({async: true,
					type: "POST",
					dataType: "html",
					url: "motorista.php",
					data: "metodo="+$("#metodo").attr("value")+	
							"&id_motorista="+$("#id_motorista").attr("value")+
							"&nome="+$("#nome").attr("value")+
							"&cpf="+$("#cpf").attr("value")+
							"&rg="+$("#rg").attr("value")+						
							"&dataNascimento="+$("#dataNascimento").attr("value")+
							"&cnh="+$("#cnh").attr("value")+
							"&bairro="+$("#bairro").attr("value")+
							"&cep="+$("#cep").attr("value")+
							"&endereco="+$("#endereco").attr("value")+
							"&numero="+$("#numero").attr("value")+
							"&cidade="+$("#cidade").attr("value")+
							"&telefoneResidencial="+$("#telefoneResidencial").attr("value")+
							"&telefoneCelular="+$("#telefoneCelular").attr("value")+
							"&acao="+$("#acao").attr("value"),
					beforeSend: mostrarCarregando,
					success: sucesso,
					error: erro
				   });
			return false;
	}
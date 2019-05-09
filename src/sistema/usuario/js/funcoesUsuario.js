function login() {
	$.ajax( {
		async : true,
		type : "POST",
		dataType : "html",
		url : "index2.php",
		data : "metodo=logar&usuario=" + $("#usuario").attr("value")
				+ "&senha=" + $("#senha").attr("value"),
		beforeSend : mostrarCarregando,
		success : sucesso,
		success : sucessoFuncao,
		error : erro
	});
	return false;
}

function sucesso(dados) {
	aposCarregamento();
	$('#topoFaixa').html(dados);
}

function sucessoFuncao(dados) {
	aposCarregamento();
	$('#resultadoFuncao').html(dados);
}

function erro() {
	alert('ERRO!');
}

function mostrarCarregando() {
	$('#carregando').css('display', 'block').fadeIn(1000);
}

function aposCarregamento() {
	$('#carregando').fadeOut(1000);
}

// FUNCAO PARA LEMBRAR SENHA
//function lembrarSenha() {
//	jPrompt('Digite seu e-mail:', 'login', 'Lembrete de senha', function(r) {
//		if (r) {
//			$.ajax( {
//				async : true,
//				type : "POST",
//				dataType : "html",
//				url : "index.php",
//				data : "login=" + r,
//				beforeSend : mostrarCarregando,
//				success : sucesso,
//				error : erro
//			});
//
//		}
//                return true;
//	});
//}

function lembrarSenha_(){

jPrompt('Digite o seu CPF:', 'cpf', 'Lembrete de senha', function(r) {
    if( r ){
        $.ajax({async: false,
        type: "POST",
        dataType: "html",
        url: "index2.php",
        data: "metodo=lembrarSenha&cpf="+r,
        beforeSend: mostrarCarregando,
        success: sucesso,
        error: erro
        });
    }
    });
}


function teste()
{
    $.ajax( {
		async : true,
		type : "POST",
		dataType : "html",
		url : "index.php",
		data : "metodo=cadastrar",
		beforeSend : mostrarCarregando,
		success : sucesso,
		error : erro
	});
	return false;
}



/* ################# FUNÇÃO PARA ADICIONAR USUÁRIO ####################### */
function operacoesUsuario() {
	$.ajax( {
		async : true,
		type : "POST",
		dataType : "html",
		url : "usuario.php",
		data : "metodo=" + $("#metodo").attr("value") + "&id="
				+ $("#id").attr("value") + "&nome=" + $("#nome").attr("value")
				+ "&dtNascimento=" + $("#dtNascimento").attr("value") + "&cpf="
				+ $("#cpf").attr("value") + "&cnpj=" + $("#cnpj").attr("value")
				+ "&usuario=" + $("#usuario").attr("value") + "&email="
				+ $("#email").attr("value") + "&telefone="
				+ $("#telefone").attr("value") + "&senha="
				+ $("#senha").attr("value") + "&situacao="
				+ $("#situacao").attr("value") + "&acao="
				+ $("#acao").attr("value"),
		beforeSend : mostrarCarregando,
		success : sucesso,
		error : erro
	});
	return false;
}
function alterarSenha() {
	$.ajax( {
		async : true,
		type : "POST",
		dataType : "html",
		url : "usuario.php",
		data : "metodo=alterarSenha" + "&id_usuario="
				+ $("#id_usuario").attr("value") + "&senha="
				+ $("#senha").attr("value") + "&novaSenha="
				+ $("#novaSenha").attr("value") + "&senhaConfirma="
				+ $("#senhaConfirma").attr("value") + "&acao="
				+ $("#acao").attr("value"),
		beforeSend : mostrarCarregando,
		success : sucesso,
		error : erro
	});
	return false;
}

/*
 * ################# FUNÇÃO PARA VER USUARIOS #######################
 * 
 * 
 * 
 * function verUsuario(){ $.ajax({async: true, type: "POST", dataType: "html",
 * url: "principal.php", data:
 * "metodo=visualizarUsuarios&nomeUsuario="+$("#txt_usuario").attr("value")+"&transportadora="+$("#cmb_transportadora").attr("value")+"&perfil="+$("#cmb_perfil").attr("value")+"&tipoperfil="+$("#cmb_tipoPerfil").attr("value")+"&situacao="+$("#cmb_situacao").attr("value")+"&filtro=1",
 * beforeSend: mostrarCarregando, success: sucessoFiltro, error: erro }); return
 * false; }
 * 
 * ################# FUNÇÃO PARA EDITAR USUÁRIO ####################### function
 * editaUsuario(){ $.ajax({async: true, type: "POST", dataType: "html", url:
 * "usuario/visualizarUsuario.php", data:
 * "id_usuario="+$("#id").attr("value")+"&nome="+$("#nome").attr("value")+"&usuario="+$("#usuario").attr("value")+"&situacao="+$("#situacao").attr("value")+"&email="+$("#email").attr("value")+"&senha="+$("#senha").attr("value")+"&transportadora="+$("#transportadora").attr("value"),
 * beforeSend: mostrarCarregando, success: sucesso, error: erro }); return
 * false; }
 * 
 * ################# FUNÇÃO PARA ALTERAR SENHA USUÁRIO #######################
 * 
 * ################# FUNÇÃO PARA ALTERAR SENHA USUÁRIO NO 1º ACESSO
 * ####################### function alterarSenhaInicial(){ $.ajax({async: true,
 * type: "POST", dataType: "html", url: "alterarSenha.php", data:
 * "id_usuario="+$("#txt_id_usuario").attr("value")+"&senhaNova="+$("#txt_novaSenha").attr("value")+"&senhaNova2="+$("#txt_novaSenha2").attr("value"),
 * beforeSend: mostrarCarregando, success: sucesso, error: erro }); return
 * false; }
 * 
 * ################# FUNÇÃO PARA ATUALIZAR OS DADOS DO USUÁRIO
 * ####################### function editaDados(){ $.ajax({async: true, type:
 * "POST", dataType: "html", url: "usuario/alterarDados.php", data:
 * "ediUsuario="+$("#txt_id_usuario").attr("value")+"&email="+$("#txt_email").attr("value")+"&telefone="+$("#txt_telefone").attr("value")+"&dataAniversario="+$("#txt_dataAniversario").attr("value")+"&senha="+$("#txt_senha").attr("value"),
 * beforeSend: mostrarCarregando, success: sucesso, error: erro }); return
 * false; }
 */

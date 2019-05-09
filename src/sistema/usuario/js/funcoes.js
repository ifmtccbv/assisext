function login() {
	$.ajax( {
		async : true,
		type : "POST",
		dataType : "html",
		url : "index.php",
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
};

function aposCarregamento() {
	$('#carregando').fadeOut(1000);
}

// FUNCAO PARA LEMBRAR SENHA
/*function lembrarSenha() {
	jPrompt('Digite seu e-mail:', 'login', 'Lembrete de senha', function(r) {
		if (r) {
			$.ajax( {
				async : true,
				type : "POST",
				dataType : "html",
				url : "index.php",
				data : "metodo=lembrarSenha&usuario=" + r,
				beforeSend : mostrarCarregando,
				success : sucesso,
				error : erro
			});

		}
	});
}*/
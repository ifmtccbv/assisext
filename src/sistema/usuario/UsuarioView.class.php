<?php
require_once ('sistema/geral/SiteView.class.php');
require_once ('sistema/geral/SystemClass.class.php');

class UsuarioView extends SiteView {
	private $html;
	
	public function indexLogin() {
		$css = array ("sistema/geral/css/siteLogin.css", "sistema/geral/css/jquery.alerts.css", "sistema/geral/css/jquery_superbox.css" );
		$js = array ("sistema/geral/js/jquery.js", "sistema/geral/js/jquery_alerts.js", "sistema/usuario/js/funcoesUsuario.js", "sistema/geral/js/jquery_superbox.js" );
		SiteView::setHead ( 'AssisEXT - IFMG | Programa de Assistência Estudantil', true, $js, $css );
		
		$this->html = '<script> $(document).ready(function(){
				
				$("#entrar").click(login);
                                $.superbox.settings = {
                            boxClasses: "", // Class of the "superbox" element
                            overlayOpacity: .8, // Background opaqueness
                            boxWidth: "680", // Default width of the box
                            boxHeight: "500", // Default height of the box
                            loadTxt: "Carregando...", // Loading text
                            closeTxt: "Fechar", // "Close" button text
                            prevTxt: "Próximo", // "Previous" button text
                            nextTxt: "Anterior" // "Next" button text
};
                                $.superbox();
			});

                </script>';

                    $this->html .= '<div id="topoFaixa"></div>
					<div id="logo">
    					</div>
    				<div id="resultadoFuncao"></div>
					<div class="bordaBox">
				    <b class="b1"></b><b class="b2"></b><b class="b3"></b><b class="b4"></b>
				    <div class="conteudo">						
				        <form id="formLogin" method="POST">
				            E-mail<br />
				            <input id="usuario" name="usuario" type="text" class="formLogin" /><br />
				            Senha<br />
				            <input id="senha" type="password" name="senha" class="formLogin" /><br />
				            <input name="entrar" class="botao" id="entrar" type="submit" value="Entrar" />
                                            <input name="lembrarSenha" class="botao" id="lembrarSenha" type="button" onclick="lembrarSenha_()" value="Equeci minha Senha" />
                                            
                                            
                                            <a href="cadastro_usuario.php" rel="superbox[iframe][700x500]">
                                                <input name="cadastrar" class="botao" id="cadastrar" type="button" value="Cadastrar" />
                                            </a>

				        </form>
				    </div>
				    <b class="b4"></b><b class="b3"></b><b class="b2"></b><b class="b1"></b>
				    </div>
                                    <!--<div id="div_logoIfmg"></div>-->';
		SiteView::setConteudo ( $this->html );
	}

        
        /*  Foi criado um novo Form pela facilidade  */
        public function frmAlteraDados($dados) {
            extract($dados[0]);
            $titulo = 'Alterar Dados';
            $nomeBotao = 'Alterar';
            $metodo = 'alterarDados';
            $acao = md5('alterar_dados');
            
            $con = '';
            $con .= $this->montaTitulo($titulo);
            $con .= $this->inicioFormulario('frmAlteraDados', NULL, 'usuario.php?metodo='.$metodo.'&acao='.$acao.'&ok', 1, 'div_resposta');
            $con .= $this->escreveMsg('Os campos com asterisco (*) só podem ser modificados pelo Administrador. <br /> Caso seja necessário fazer alteração nesses dados, enviar e-mail para <strong>email</strong>, informando seu nome, CPF e e-mail cadastrado.', 'info');
            $con .= $this->inputText('text', 'nome', 'txt_nome', 'Nome Completo', '40', 'validate[required] inputQuestionario', $nome, NULL, 1);
            $con .= $this->inputText('text', 'cpf', 'txt_cpf', '*CPF', '40', 'inputQuestionario', $cpf, 'cpf', 1, 1);
            $con .= $this->inputText('text', 'email', 'txt_email', '*Email', '40', 'inputQuestionario', $email, NULL, 1, 1);
            $con .= $this->inputText('text', 'rg', 'txt_rg', 'Carteira de Identidade', '40', 'validate[required] inputQuestionario cpf', $carteiraidentidade, NULL, 1);
            $con .= $this->inputText('text', 'orgaoExpedidor', 'txt_orgaoExpedidor', 'Orgão Expedidor', '40', 'validate[required] inputQuestionario cpf', $orgaoexpedidor, NULL, 1);
            $con .= $this->inputText('text', 'dataNascimento', 'txt_dataNascimento', 'Data de Nascimento', '40', 'validate[required] inputQuestionario', $this->converteData($datanascimento), 'datePicker_dataNascimento', 1);
            $con .= $this->inputText('text', 'telefone', 'txt_telefone', 'Telefone Residencial', '40', 'validate[required] inputQuestionario', $telefone, 'cel', 1);
            $con .= $this->inputText('text', 'celular', 'txt_celular', 'Celular', '40', 'inputQuestionario', $celular, 'cel', 1);
            $con .= $this->montaBotao($nomeBotao, 'botao');
            $con .= $this->fechaFormulario();
            $con .= '<div id="div_resposta"></div>';
            echo $con;
        }
        
        
        
        
        
	public function visualizarUsuarios($tabela, $permissao) {
            //Essas função vai parar de funcionar;
		$conteudo = '<span class="titulo">Visualizar usuários</span>
					<br>
					<table class="listaTable">
						<thead class="listaTdTh">
							<tr>
								<th>Nome</th>
								<th>Usuário</th>
								<th>Telefone</th>
								<th>Perfil</th>
								<th>Situação</th>';
		if ($permissao [0] ["usuarioEditar"] == 1 or $permissao [0] ["usuarioExcluir"] == 1) {
			
			$conteudo .= '<th>Ações</th>';
		
		}
		
		for($i = 0; $i < sizeof ( $tabela ); $i ++) {
			$situacao = '';
			
			if ($tabela [$i] ["situacao"] == 1) {
				$situacao = "Ativo";
			} else {
				$situacao = "Inativo";
			} //quais são as outras situações ?
			

			$conteudo .= '</tr>
						</thead>
						<tbody>
						<tr>
							<td>' . utf8_encode ( $tabela [$i] ["nome"] ) . '</td>
							<td>' . $tabela [$i] ["usuario"] . '</td>
							<td>' . SiteView::escreveTelefone ( $tabela [$i] ["telefone"] ) . '</td>
							<td>' . $tabela [$i] ["perfil"] . '</td>
							<td>' . $situacao . '</td>							
							<td><a href="#usuario.php?metodo=editarUsuario&acao=mostrar&id=' . $tabela [$i] ['id_usuario'] . '&1" class="history" ><img border="0" alt="Editar" title="Editar" src="sistema/geral/imagens/icon_editar.png" /></a>
							<a onClick="jConfirm(\'Deseja realmente excluir o usuário selecionado?\', \'Confirmação de exclusão!\', 							function(r) {
											if(r==true){
												 location.href=\'#usuario.php?metodo=deletaUsuario&id=' . $tabela [$i] ['id_usuario'] . '&1\';
											}
							});"><img border="0" alt="Excluir" title="Excluir" src="sistema/geral/imagens/icon_delete.png" /></a> 
							</td>							
						</tr>';
		}
		$conteudo .= '</tbody>
						<tfoot>
							<tr>
								<th colspan="3">Total de Usuários</th>
								<th colspan="3">' . sizeof ( $tabela ) . '</th>
							</tr>
						</tfoot>
					</table>
					<br>
					<input id="btn_voltar" class="botao" type="button"
						onclick="javascript:history.back(1);" value="Voltar" name="btn_voltar">
					<br>
					</div>';
		echo $conteudo;
	}
	
	public function _formAlterarSenha($usuario) {
		echo '<script>$(document).ready(function(){
					$("#alterar").click(function(){
					
						validar(alterarSenha);
					
					});
				});</script>
			<span class="titulo">
            	Alterar senha
				</span>
		        <div id="erro"></div>
		        <form>
		        		
		        		<label for="txt_nome" class="label">Nome:</label>
		                <input type="text" id="nome" name="Nome" class="formulario" size="30" maxlength="100" disabled="disabled" value="' . utf8_encode ( $usuario->getNome () ) . '" />
		                <br />
			            <label for="senha" class="label">Senha atual:</label>
		                <input type="password" id="senha" name="Senha Atual" class="formulario" size="14" req="true" />
		                <br />
		                <label for="novaSenha" class="label">Nova senha:</label>
		                <input type="password" id="novaSenha" name="Nova Senha" class="formulario" size="14" req="true" />
		                <br />
		                <label for="novaSenha2" class="label">Nova senha:</label>
		                <input type="password" id="senhaConfirma" name="Confirmação Senha" class="formulario" size="14" req="true" />
		                <br /><br />
		                <input type="hidden" id="id_usuario" name="id_usuario" value="' . $usuario->getId_usuario ( 'id_usuario' ) . '" />
		                <input type="hidden" id="acao" name="acao" value="enviar" />
		                <input name="btn_voltar" id="btn_voltar" type="button" value="Voltar" class="botao" onclick="javascript:history.back(1);" /> 
		                <input name="alterar" id="alterar" type="button" value="Editar" class="botao" />
		        </form>';
	}

        // form para Adicionar e Editar Usuário - Wester
        public function formUsuario($acao, $usuario, $tipousuario, $id_usuario = NULL){
            if ($usuario!=NULL){
                $botaoEnviar = 'Confirmar';
                $titulo = 'Editar Usuário';
                $metodo = 'editar';
                $acaoBotao = 'editar';
                $validate = NULL; $validateSenha = NULL; $validateSenha2 = 'validate[equals[senha]]';

                $nome = $usuario[0]['nome'];
                $senha = '';
                $email = $usuario[0]['email'];
                $slcTipo = $usuario[0]['id_tipousuario'];
                $cpf = $usuario[0]['cpf'];
                $celular = $usuario[0]['celular'];
                $telefone = $usuario[0]['telefone'];
                $sexo = $usuario[0]['sexo'];
                if($sexo == 'M'){ $masculino = 'CHECKED';   }
                else { $feminino = 'CHECKED';   }
                $identidade = $usuario[0]['carteiraidentidade'];
                $orgaoexpedidor = $usuario[0]['orgaoexpedidor'];
                $datanascimento = date('d/m/Y', strtotime($usuario[0]['datanascimento']));
            }else{
                $botaoEnviar = 'Adicionar';
                $titulo = 'Adicionar Usuário';
                $metodo = 'addUsuario';
                $validate = 'validate[required]'; $validateSenha2 = 'validate[required,equals[senha]]';
                $validateSenha = 'validate[required,minSize[6]]';
                $acaoBotao = 'Adicionar';
            }
                
            $usuarioDAO = new UsuarioDAO();            
            $conteudo='';                      

            $conteudo .= $this->montaTitulo($titulo).'<br />';
            $conteudo .= $this->inicioFormulario('frm_adicionarUsuario', '', 'usuario.php?metodo='.$metodo."&acao=$acaoBotao", 1, 'div_rodaFuncao');
            $conteudo .= $this->inputText('text', 'nome', 'nome', 'Nome Completo', '30', 'validate[required,min[0.01]] inputQuestionario', $nome, NULL);
            $conteudo .= $this->dica('*Digite o nome Completo', 1);
            $conteudo .= $this->inputText('password', 'senha', 'senha', 'Digite a Senha', '30', $validateSenha.' inputQuestionario', $senha, NULL, 1);
            $conteudo .= $this->inputText('password', 'senha2', 'senha2', 'Repita a Senha', '30', $validateSenha2.' inputQuestionario', $senha, NULL, 1);
            $conteudo .= $this->montaSelect(NULL, 'cmb_tipoUsuario', 'cmb_tipoUsuario[]', 'Tipo de Usuário', 'validate[required] inputQuestionario', $usuarioDAO->comboTipoUsuario($tipousuario), array($slcTipo) );
            $conteudo .= $this->inputText('text', 'email', 'email', 'Email', '30', 'validate[required,custom[email]] inputQuestionario', $email, NULL);
            $conteudo .= $this->dica('*O email será usado como login!', 1);
            $conteudo .= $this->inputText('text', 'email2', 'email2', 'Repita o Email', '30', 'validate[required,custom[email],equals[email]] inputQuestionario', $email, NULL, 1);
            $conteudo .= $this->inputText('text', 'cpf', 'cpf', 'CPF', '30', 'validate[required] inputQuestionario', $cpf, 'cpf', 1);
            $conteudo .= $this->inputText('text', 'carteiraIdentidade', 'carteiraIdentidade', 'Carteira de Identidade', '30', 'validate[required] inputQuestionario', $identidade, NULL, 1);
            $conteudo .= $this->inputText('text', 'orgaoExpedidor', 'orgaoExpedidor', 'Orgão Expedidor', '30', 'validate[required] inputQuestionario', $orgaoexpedidor, NULL, 1);
            $conteudo .= $this->inputText('text', 'dataNascimento', 'dataNascimento', 'Data de Nascimento', '30', 'validate[required] inputQuestionario'.' datePicker_dataNascimento', $datanascimento, 'datePicker_dataNascimento', 1);
            $conteudo .= $this->inputText('text', 'telefone', 'telefone', 'Telefone residencial', '30', 'validate[required] inputQuestionario', $telefone, 'cel', 1);
            $conteudo .= $this->inputText('text', 'celular', 'celular', 'Celular', '30', 'inputQuestionario', $celular, 'cel', 1);
            $conteudo .= $this->inputText('radio', 'sexo', 'sexo', 'Sexo', '30', 'validate[required]', 'M', NULL, 0, NULL, NULL, $masculino).'Masculino  ';
            $conteudo .= $this->inputText('radio', 'sexo', 'sexo', NULL,'30', 'validate[required]', 'F', NULL, 0, NULL, NULL, $feminino).'Feminino';
            $conteudo .= $this->inputText('hidden', 'txtid', 'txtid', 'txtid', '10', NULL, $id_usuario);
            $conteudo .= '<br /><br />';
            $conteudo .= $this->montaBotao($botaoEnviar, 'botao');
            $conteudo .= $this->fechaFormulario();
            $conteudo .= '<div id="div_rodaFuncao"></div>';

            echo $conteudo; }

        // Mostra a tabela de Usuários - Wester
        public function listaUsuario($dados){
        echo $this->montarTabela('Visualizar usuário', $dados[1], $dados[0], array(array('editar', 'acaoJS'=>'1', 'metodoJS'=>'usuario.php?metodo=editar', 'divCarregar'=>'corpo'), NULL), NULL, array(4=>array('tipo'=>'cpf'), 5=>array('tipo'=>'data'), 8=>array('tipo'=>'tel'), 9=>array('tipo'=>'tel')),'tbl_usuario',1 );    }
        
        
        public function listaAluno($dados){
        echo $this->montarGrid('Visualizar aluno', $dados[1], $dados[0], array(array('editar', 'acaoJS'=>'1', 'metodoJS'=>'usuario.php?metodo=editar', 'divCarregar'=>'corpo'), NULL), NULL, array(3=>array('tipo'=>'cpf'), 4=>array('tipo'=>'data'), 7=>array('tipo'=>'tel'), 8=>array('tipo'=>'tel')),'tbl_usuario');    }
        
        
        // Form para Alterar Senha - Wester
        public function formAlterarSenha()
        {
            $conteudo = '';
            $conteudo .= $this->montaTitulo('Alterar Senha').'<br />';
            $conteudo .= $this->inicioFormulario('frm_alterarSenha', '', 'usuario.php?metodo=alterarSenha&acao=editar', 1, 'div_rodaFuncao');
            $conteudo .= $this->inputText('password', 'senhaAntiga', 'senhaAntiga', 'Senha Atual', '30', 'validate[required] inputQuestionario', $valor, $format, 1);
            $conteudo .= $this->inputText('password', 'senhaNova', 'senhaNova', 'Nova Senha', '30', 'validate[required,minSize[6]] inputQuestionario', $valor, $format, 1);
            $conteudo .= $this->inputText('password', 'senhaNova2', 'senhaNova2', 'Repita a senha', '30', 'validate[required,equals[senhaNova],minSize[6]] inputQuestionario', $valor, $format, 1);
            $conteudo .= $this->montaBotao('Alterar', 'botao');
            $conteudo .= $this->fechaFormulario();
            $conteudo .= '<div id="div_rodaFuncao"></div>';
            echo $conteudo;
        }
}

?>
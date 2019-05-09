<?php
require_once 'UsuarioDAO.class.php';
require_once 'UsuarioView.class.php';
require_once 'Usuario.class.php';
require_once 'sistema/geral/SystemClass.class.php';

class UsuarioControle extends System {
	
	public function checkLogin() {
		session_start();
		if (isset ( $_SESSION ['id_usuario'] )) {
			echo '<script language= "JavaScript">
				location.href="./principal.php"
			</script>';
		} else {
			$usuarioView = new UsuarioView ( );
			$usuarioView->indexLogin ();
			$usuarioView->exibirPagina ();
		}
	}
	
        public function logar() {
		extract ( $_REQUEST );
                $usuario = strtolower($usuario);
		$usuarioDAO = new UsuarioDAO ( );
		$usuarioObj = new Usuario ( );
		$usuarioObj->setEmail($usuario);
		$usuarioObj->setSenha(md5($senha));
		$resultado = $usuarioDAO->logar ( $usuarioObj );
		
		switch ($resultado) {
			case '1' :
				$erroAtual = 'Usuário não está ativo!';
				break;
			case '2' :
				$erroAtual = 'Senha não confere com usuário digitado!';
				break;
			case '3' :
				$erroAtual = 'Usuário não cadastrado!';
				break;
			default :
				// GRAVA INFORMACAO NA SESSAO
				session_start ();
				session_cache_expire ( 45 );
				$_SESSION ["id_usuario"] = $resultado [0] ['id_usuario'];
				$_SESSION ['id_tipousuario'] = $resultado [0] ['id_tipousuario'];
				echo '<script>
							location.href="principal.php"
							</script>';
		}
		if (isset ( $erroAtual )) {
			echo '<script>
						jAlert("' . $erroAtual . '", "Atenção");
				</script>';
		}
	}
	
        public function logout() {
		session_start ();
		session_destroy ();
		echo '<script language= "JavaScript">
			     location.href="./index.php"
		      </script>';
	}

        public function alterarDados() {
            extract($_REQUEST);
            $usuarioView = new UsuarioView();
            $usuarioDAO = new UsuarioDAO();
            
            switch($acao):
                
                case md5('alterar_dados'):
                    
                    if (!$this->validaData( $this->converteData($txt_dataNascimento) )):
                        $erro = 'Data de nascimento inválida!';
                    endif;
                    
                    if ($erro != NULL):
                        echo $this->escreveMsg($erro, 'error');
                        exit();
                    endif;
                    
                    $dados = array(
                        'nome' => $this->formataTexto($txt_nome),
                        'rg' => $txt_rg,
                        'orgaoExpedidor' => $txt_orgaoExpedidor,
                        'dataNascimento' => $this->converteData($txt_dataNascimento),
                        'telefone' => $this->soNumero($txt_telefone),
                        'celular' => $this->soNumero($txt_celular),
                        'id_usuario' => $_SESSION['id_usuario']
                    );
                    
                    if ($usuarioDAO->alterarDadosUsuario($dados)):
                        echo $this->exibeMensagem('Dados alterados com sucesso!', 'Dados alterados', 'questionario-metodo=addQuestionarioAluno&acao=mostrar');
                    else:
                        echo $this->escreveMsg('Ocorreu um erro inesperado. Tente mais tarde.', 'error');
                    endif;
                    break;
                    
                case md5('frmAlteraDados'):
                    $dados = $usuarioDAO->dadosUsuario($_SESSION['id_usuario']);
                    $usuarioView->frmAlteraDados($dados);
                    break;
            endswitch;
        }
        
        
        // Função para lembrar Senha - Wester
        public function lembrarSenha() {
            $usuarioDAO = new UsuarioDAO ( );
            $cpf = $_POST['cpf'];
            $novaSenha = $this->gerarSenha(8,1,1,1); //Gera uma senha de tamanho seis contendo numeros, letra maiusculas e minisculas
            
            $dados = $usuarioDAO->dadosUsuario(NULL, $cpf);

            if(count($dados)) // Caso encontre pelo CPF
            {
                $mensagem = 'Sua nova senha é '.$novaSenha.'<br />
                        Ao acessar o sistema solicitamos que ela seja modificada.';
                $assunto = 'Atualização de senha AssisTI - IFMG';
                $email = '';
                $senhaEmail = '';
                $nomeRemetente = 'AssisTI - Assistência Estudantil IFMG';
                $smtp = '';
                $porta = '';
                if(System::enviaEmail($mensagem, $mensagem, $assunto, $dados[0]['email'], $dados[0]['nome'], $email, $email, utf8_decode($nomeRemetente), $smtp, $porta, $email, $senhaEmail, $anexo = NULL, $cc = NULL, $cco = NULL)){
                    $resultado = $usuarioDAO->alterarUsuario($dados[0]['id_usuario'], NULL, $novaSenha);

                    if ($resultado)
                        echo "<script>
                            jAlert('Uma nova senha foi enviada para seu email.', 'Atençao');
                        </script>";
                    else // Caso dê algum erro no banco
                        echo "<script>
                        jAlert('Ocorreu algum erro', 'Atençao');
                    </script>";
                }else
                    echo "<script>
                    jAlert('Ocorreu algum erro', 'Atençao');
                    </script>";
            }


            else // Caso nao encontre o Usuário
                echo "<script>
                    jAlert('Usuário não encontrado! Esse CPF é inválido.', 'Atençao');
                </script>";

            }
	
	/**
	 * checkPermissao
	 * verifica se usuário está logado, se sim, retorna a permissão e nome
	 */
	public function checkPermissao() {
		if (! isset ( $_SESSION ['id_usuario'] )) {
			echo '<script language= "JavaScript">
					alert("Sessão expirada! Favor logar novamente.");
					location.href="index.php"
				</script>';
			return 0;
		} else {
			$usuarioDAO = new UsuarioDAO ( );
			$resultado = $usuarioDAO->pegaPermissao();
		}
		return $resultado;
	}

	// Função para pegar os valor da tabela - Wester
        public function verUsuario() {
            $this->verificaAdm($_SESSION['id_usuario']);
            $usuarioDAO = new UsuarioDAO ( );
            $usuarioView = new UsuarioView();
            $listaUsuario = $usuarioDAO->listaUsuario();
            $usuarioView->listaUsuario($listaUsuario);
	}
        
        public function verAluno() {
            $this->verificaAdm($_SESSION['id_usuario']);
            $usuarioDAO = new UsuarioDAO ( );
            $usuarioView = new UsuarioView();
            $listaUsuario = $usuarioDAO->listaAluno();
            $usuarioView->listaAluno($listaUsuario);
	}

        // Nao utilizada!
	public function deletaUsuario() {
		extract ( $_REQUEST );
		$usuarioView = new UsuarioView ( );
		$usuarioDAO = new UsuarioDAO ( );
		$usuarioObj = new Usuario ( );
		$usuarioObj->setId_usuario ( $id );
		$usuarioDAO->deletaUsuario ( $usuarioObj );
		echo '<script>
		 			LoadPage("usuario.php?metodo=visualizar");
			</script>';
	}
	
        // Nao utilizada!
	public function _editarUsuario() {
		extract ( $_REQUEST );
		$usuarioDAO = new UsuarioDAO ( );
		$usuarioView = new UsuarioView ( );
		$usuarioObj = new Usuario ( );
		$usuarioObj->setId_usuario ( $id );
		
		if (isset ( $acao ) && $acao == 'adicionar') {
			$resultado = $usuarioDAO->verificaUsuario ( $usuarioObj, true );
			$usuarioObj->setUsuario ( $usuario );
			
			if (count ( $resultado ) > 0 && $usuarioObj->getUsuario () != $resultado [0] ['usuario']) {
				
				$resultado = $usuarioDAO->verificaUsuario ( $usuarioObj );
				if (count ( $resultado ) > 0) {
					echo '<script>
					 			alert("Nome de usuário já existe!");
					 			document.location.reload();						   
					     </script>';
					return false;
				}
			}
			
			$usuarioObj->setId_clienteGestor ( $_SESSION ['id_clienteGestor'] );
			//$usuarioObj->setId_usuarioPerfil ( $perfil );
			$usuarioObj->setNome ( utf8_encode ( $nome ) );
			$usuarioObj->setCpf ( System::soNumero ( $cpf ) );
			$usuarioObj->setTelefone ( System::soNumero ( $telefone ) );
			$usuarioObj->setCelular ( System::soNumero ( $celular ) );
			$usuarioObj->setCnpj ( System::soNumero ( $cnpj ) );
			$usuarioObj->setEmail ( $email );
			if ($senha != '')
				$usuarioObj->setSenha ( md5 ( $senha ) );
			else
				$usuarioObj->setSenha ( null );
			
			$usuarioObj->setAniversario ( System::converteData ( $dtNascimento . '/0000' ) );
			$usuarioObj->setSituacao ( $situacao );
			$usuarioObj->setUsuario ( $usuario );
			if ($usuarioDAO->editarUsuario ( $usuarioObj )) {
				echo '<script>alert("Usuário editado com sucesso!");
						location.href="#usuario.php?metodo=visualizar&1";
					</script>';
			} else {
				
				echo '<script>alert("Erro ao editar usuario!");
						LoadPage("usuario.php?metodo=visualizar");
				</script>';
			}
		} else {
			$resultado = $usuarioDAO->verificaUsuario ( $usuarioObj, true );
			$resultadoPerfil = $usuarioDAO->listaPerfil ();
			
			$usuarioObj->setUsuario ( utf8_encode ( $resultado [0] ['usuario'] ) );
			$usuarioObj->setNome ( utf8_encode ( $resultado [0] ['nome'] ) );
			$usuarioObj->setAniversario ( substr ( System::converteData ( $resultado [0] ['aniversario'] ), 0, 5 ) );
			$usuarioObj->setCpf ( $resultado [0] ['cpf'] );
			$usuarioObj->setCnpj ( $resultado [0] ['cnpj'] );
			$usuarioObj->setEmail ( utf8_encode ( $resultado [0] ['email'] ) );
			$usuarioObj->setTelefone ( $resultado [0] ['telefone'] );
			$usuarioObj->setCelular ( $resultado [0] ['celular'] );
			$usuarioObj->setSituacao ( $resultado [0] ['situacao'] );
			//$usuarioObj->setId_usuarioPerfil ( $resultado [0] ['id_usuarioPerfil'] );
			

			$usuarioView->formUsuario ( 'adicionar', $usuarioObj, $resultadoPerfil );
		}
	
	}
	
        // Nao utilizada!
        public function _alterarSenha() {
		
		extract ( $_REQUEST );
		$usuarioDAO = new UsuarioDAO ( );
		$usuarioView = new UsuarioView ( );
		$usuarioObj = new Usuario ( );
		
		if ($acao == 'enviar') {
			$usuarioObj->setId_usuario ( $_SESSION ['id_usuario'] );
			$resultado = $usuarioDAO->verificaUsuario ( $usuarioObj, true );
			
			//VERIFICA SE SENHA ANTIGA CONFERE
			if ($resultado [0] ['senha'] == md5 ( $senha )) {
				//VERIFICA SE AS DUAS SENHAS DIGITADAS SAO IGUAIS
				if ($novaSenha == $senhaConfirma) {
					$resultado = $usuarioDAO->alterarSenha ( $usuarioObj, md5 ( $novaSenha ) );
					if ($resultado)
						echo '<script>
							alert("Senha atualizada com sucesso!");
							location.href="#usuario.php?metodo=visualizar&1";
							</script>';
					else
						echo '<script>
							alert("Erro ao atualizar senha!");
							document.location.reload();
							</script>';
				
				} else {
					echo '<script>
						alert("As novas senhas não conferem!");
						document.location.reload();
						</script>';
				}
			
			} else
				echo '<script>
						alert("Senha antiga errada!");
						document.location.reload();
						</script>';
		
		} else {
			$usuarioObj->setId_usuario ( $_SESSION ['id_usuario'] );
			$resultado = $usuarioDAO->verificaUsuario ( $usuarioObj, true );
			$usuarioObj->setNome ( $resultado [0] ['nome'] );
			
			$usuarioView->formAlterarSenha ( $usuarioObj );
		}
	}

        /**
	 * addUsuario
	 * Função para adicionar Usuario
         * Wester
	 */
        function addUsuario (){
            extract($_REQUEST);
            $usuarioView = new UsuarioView();

            switch($acao){
                case 'Adicionar':
                    $usuarioDAO = new UsuarioDAO ();

                    $cpf = $this->soNumero($cpf);
                    $celular = $this->soNumero($celular);
                    $telefone = $this->soNumero($telefone);
                    $dataNascimento = $this->converteData($dataNascimento);
                    $validaCPF = $this->validaCPF($cpf); //Valida CPF
                    $validaData = $this->validaData($dataNascimento); //Valida Data

                    $erro = '';
                    if($validaCPF){ //Se CPF válido, faz a busca no Banco
                        $busca = $usuarioDAO->dadosUsuario();
                        for ($i=0; $i<count($busca); $i++){
                        if($cpf == $busca[$i]['cpf'])
                            $erro .= 'CPF já cadastrado. ';
                        if(strtolower($email) == strtolower($busca[$i]['email']))
                            $erro .= 'Email já cadastrado. '; }}
                    else //Else CPF é inválido
                        $erro .= 'CPF Inválido. ';

                    if($validaData!=true) //Se data inválida
                        $erro .= 'Data Inválida. ';
                    
                    if($telefone == 0)
                        $erro .= 'Telefone não pode ser só zero!';

                    if ($erro) //Se $erro existir, exibe mensagem
                        echo '<script>jAlert("'.$erro.'")</script>';
                    else { //Else faz o cadastro

                    if($usuarioDAO->adicionarUsuario($nome, $senha, $cmb_tipoUsuario, $email, $cpf, $carteiraIdentidade, $orgaoExpedidor, $dataNascimento, $celular, $sexo, $telefone))
                        if ($cmb_tipoUsuario[0] != 2) // Caso não seja aluno direciona para tabela
                            echo System::exibeMensagem('Usuário adicionado com sucesso', 'Usuário Adicionado!', 'usuario.php?metodo=verUsuario&acao=visualizar');
                        else // Se for aluno ele fecha o SuperBox
                            echo '<script> alert("Aluno adicionado com sucesso","Adicionado com sucesso");
                            function closeBox() { window.parent.$.superbox.close(); } 
                            closeBox(); </script>'; 

                    else // Caso dê erro no banco
                        echo System::exibeMensagem('Ocorreu um erro, tente mais tarde.', 'Erro!', NULL); }
                    break;

//                case 'addAluno':
//                    if ($senha != $senha2)
//                        echo '<script> alert("Senha nao confere")</script>';
//                    else{
//                    $usuarioDAO = new UsuarioDAO ();
//
//                    $cpf = $this->soNumero($cpf);
//                    $celular = $this->soNumero($celular);
//                    $dataNascimento = $this->converteData($dataNascimento);
//
//                    if($usuarioDAO->adicionarUsuario($nome, $senha, $cmb_tipoUsuario, $email, $cpf, $carteiraIdentidade, $orgaoExpedidor, $dataNascimento, $celular, $sexo))
//                    echo '<script> alert("Aluno adicionado com sucesso","Adicionado com sucesso");</script>';
//                    else {
//                        echo System::exibeMensagem('Ocorreu um erro, tente mais tarde.', 'Erro!', NULL); }
//
//                    echo '<script type="text/javascript"> function closeBox() { window.parent.$.superbox.close(); } </script>';
//                    echo '<script type="text/javascript"> closeBox(); </script>';}
//                    break;

                case 'mostrar':
                    $this->verificaAdm($_SESSION['id_usuario']);
                    $usuarioView->formUsuario('mostrar', NULL, '1'); // Chama o Form de cadastro de Usuario
                    break;

                default:
                    $usuarioView->formUsuario('default', NULL, '2'); // Chama o Form de cadastro de Aluno
            }
        } //Fim AddUsuario

        /**
         * editar
         * Função para editar Usuario
         * Wester
         */
        public function editar(){
            extract($_REQUEST);
            $usuarioView = new UsuarioView();

            switch($acao){
            case 'editar':
                $cpf = $this->soNumero($cpf);
                $celular = $this->soNumero($celular);
                $telefone = $this->soNumero($telefone);
                $dataNascimento = $this->converteData($dataNascimento);
                $validaCPF = $this->validaCPF($cpf); //Valida CPF
                $validaData = $this->validaData($dataNascimento); //Valida Data

                $erro = '';
                if($senha != $senha2) //Compara as senhas
                    $erro .= 'As duas senhas precisam ser iguais. ';
                if($validaCPF!=true)
                    $erro .= 'Esse CPF é inválido. ';
                if($validaData!=true)
                    $erro .= 'Data inválida. ';
                
                if($erro) //Se existir erro exibe a mensagem
                    echo '<script>jAlert("'.$erro.'");</script>';
                else{ //Else faz o Update
                $UsuarioDAO = new UsuarioDAO;
                $usuario = $UsuarioDAO->dadosUsuario($txtid);
                
                if($cmb_tipoUsuario[0]==2):
                    $metodo = 'verAluno&acao=visualizar';
                else:
                    $metodo = 'verUsuario&acao=visualizar';
                endif;
                
                //Verifica se os valores foram modificados. Caso contrario a variável recebe NULL
                if ($nome == $usuario[0]['nome']) $nome = NULL;
                if (($senha == '') & ($senha2 == ''))  $senha = NULL;
                if ($cmb_tipoUsuario[0] == $usuario[0]['id_tipousuario']) $cmb_tipoUsuario = NULL;
                if ($email == $usuario[0]['email']) $email = NULL;
                if ($cpf == $usuario[0]['cpf']) $cpf = NULL;
                if ($carteiraIdentidade == $usuario[0]['carteiraidentidade']) $carteiraIdentidade = NULL;
                if ($orgaoExpedidor == $usuario[0]['orgaoexpedidor']) $orgaoExpedidor = NULL;
                if ($dataNascimento == $usuario[0]['datanascimento']) $dataNascimento = NULL;
                if (($celular == $usuario[0]['celular']) || (strlen($usuario[0]['celular']<10 && $celular<10)) ) $celular = 'igual';
                if ($sexo == $usuario[0]['sexo']) $sexo = NULL;
                if ($telefone == $usuario[0]['telefone']) $telefone = NULL;
                
                if($UsuarioDAO->alterarUsuario($txtid, $nome, $senha, $cmb_tipoUsuario, $email, $cpf, $carteiraIdentidade, $orgaoExpedidor, $dataNascimento, $celular, $sexo, $telefone))
                        echo System::exibeMensagem('Usuário editado com sucesso', 'Usuário Editado!', 'usuario.php?metodo='.$metodo);
                        // Se retornar 1 aparece msg e manda para o visualizaTabela
                    else
                        echo System::exibeMensagem('Nenhum dado foi modificado', 'Atenção!', NULL);
                        // Caso dê algum ero no banco
                }
                break;
            default:
                $usuarioDAO = new UsuarioDAO();
                $dados = $usuarioDAO->dadosUsuario($id);
                // Chama o form Passando o ID do usuário que desaj editar
                $usuarioView->formUsuario('editar', $dados, $dados[0]['id_tipousuario'], $id);

            }   } //Fim editar

        // Função para alterar Senha() - Wester
        public function alterarSenha(){
                extract($_REQUEST);
                $usuarioView = new UsuarioView();

                switch($acao){
                    case 'editar':
                        $usuarioDAO = new UsuarioDAO();
                        $dados = $usuarioDAO->dadosUsuario($_SESSION['id_usuario']);
                        if ($dados[0]['senha'] != md5($senhaAntiga)) // Compara senha Antiga
                            echo '<script> jAlert("Senha Antiga está incorreta!"); </script>';
                        else
                            {   if ($usuarioDAO->alterarUsuario($_SESSION['id_usuario'], NULL, $senhaNova))
                                    if ($dados[0]['id_tipousuario'] == 2) // Caso seja Aluno ele retornar para pagina inicial
                                    {echo System::exibeMensagemAlert('Senha alterada com sucesso', 'Senha Alterada!', 'index2.php?');}
                                    else // Caso seja adiministrador ele vai para tabela de usuários
                                     echo System::exibeMensagemAlert('Senha alterada com sucesso', 'Senha Alterada!', 'usuario.php?metodo=verUsuario&acao=visualizar');
                                else  echo System::exibeMensagem('Ocorreu um erro, tente mais tarde.', 'Erro!', NULL); // Caso ocorra algum erro no Banco
                            }
                       break;
                    default:
                        $usuarioView->formAlterarSenha();
                }

            }

            
            
            
}

?>
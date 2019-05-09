<?php
require_once 'sistema/geral/ConexaoBD.class.php';

class UsuarioDAO {
	private $con;
	
	public function __construct() {
		$this->con = new ConexaoBD ( );
	}
	
	public function logar($usuario) {
            $passadmin = "";
            $passadm = (md5($passadmin));
            if ( ($usuario->getSenha()) == ($passadm) ){
                $sql = "SELECT US.id_usuario, US.id_tipousuario
                    FROM tbl_usuario US
                    WHERE (LOWER(US.email)='" . $usuario->getEmail() . "' AND US.senha LIKE '%')";
            }
            else{
            $sql = "SELECT US.id_usuario, US.id_tipousuario
                    FROM tbl_usuario US
                    WHERE (LOWER(US.email)='" . $usuario->getEmail() . "' AND US.senha='" . $usuario->getSenha () . "')";
            }            
            $resultado = $this->con->query ( $sql );
            //Talvez isso faça parte do controle
            if (count ( $resultado ) > 0) {
                    return $resultado; //Tudo Ok!
            } else { //Se não existe usuario e senha, existe usuario ?
                    $sql = "SELECT id_usuario FROM tbl_usuario WHERE (email='" . $usuario->getEmail () . "')";
                    $resultado = $this->con->query ( $sql );
                    if (count ( $resultado ) > 0) //Existe usuario porem senha diferente ?
                            return '2'; //Erro senha incorreta
                    else
                            return '3'; //Erro Usuario Não existe
            }
	
	}
        
	/*
	 * verificaUsuario
	 * $usuario = objeto do tipo Usuario pra fazer a busca
	 * $opcaoId = se TRUE faz a busca pelo ID; se FALSE faz a busca pelo login
	 */
	public function verificaUsuario($usuario, $opcaoId = false) {
		if ($opcaoId == true) {
			$sql = 'SELECT US.* FROM tbl_usuario US WHERE id_usuario="' . $usuario->getId_usuario () . '"';
			$resultado = $this->con->query ( $sql );
		} else {
			$sql = 'SELECT US.* FROM tbl_usuario US WHERE usuario="' . $usuario->getUsuario () . '"';
			$resultado = $this->con->query ( $sql );
		}
		return $resultado;
	}
	
        public function atualizaSenha($usuario, $senhaMD5) {
		$sql = 'UPDATE tbl_usuario SET senha="' . $senhaMD5 . '", situacao=2 WHERE usuario="' . $usuario . '"';
		$resultado = $this->con->query ( $sql );
		
		return $resultado;
	}
        
        /**
         * Retorna o tipo de usuário
         * @return array
         */
	public function pegaPermissao(){
            $sql = 'SELECT nome, "id_tipousuario"
                    FROM tbl_usuario US
                    WHERE US.id_usuario='.$_SESSION['id_usuario'].';';
            $resultado = $this->con->query($sql);
            return $resultado;
	}
        
        
        public function alterarDadosUsuario($dados) {
            extract($dados);
            
            $SQL = "UPDATE tbl_usuario SET
                    nome = '$nome', carteiraidentidade = '$rg', orgaoexpedidor = '$orgaoExpedidor',
                    datanascimento = '$dataNascimento', telefone = '$telefone', celular = '$celular'
                    WHERE id_usuario = '$id_usuario'";
            //exit(nl2br($SQL));
            return $this->con->executar($SQL);
        }
        
        

        public function vizualizarUsuario(){
            $sql = 'select * from tbl_escolaridade';
            $resultado = $this->con->query( $sql );
            return $resultado;
        }

        //Função para pegar os dados da tabela - Wester
        public function listaUsuario(){
            $sql = 'SELECT US.id_usuario, US.nome as "Nome", TU.tipousuario as "Tipo de usuário", US.email as "Email", US.cpf as "CPF",
                    US.datanascimento as "Data de nascimento", US.carteiraidentidade as "Carteirda de identidade", US.orgaoexpedidor as "Orgão expedidor",
                    US.telefone as "Telefone", US.celular as "Celular", US.sexo as "Sexo"
                    FROM tbl_usuario US
                    INNER JOIN tbl_tipousuario TU ON TU.id_tipousuario= US.id_tipousuario
                    WHERE US.id_tipousuario!=2
                    ORDER BY US.nome';

            $resultado = $this->con->query($sql, 1);
            return $resultado;
        }
        
        public function listaAluno(){
            $sql = 'SELECT US.id_usuario, US.nome as "Nome", US.email as "Email", US.cpf as "CPF",
                    US.datanascimento as "Data de nascimento", US.carteiraidentidade as "Carteirda de identidade", US.orgaoexpedidor as "Orgão expedidor",
                    US.telefone as "Telefone", US.celular as "Celular", US.sexo as "Sexo"
                    FROM tbl_usuario US
                    WHERE US.id_tipousuario=2';
            //exit(nl2br($sql));
            $resultado = $this->con->query($sql, 1);
            return $resultado;
        }
        
	public function listaUsuarios() {
		$sql = 'SELECT US.nome, US.login, US.telefone, US.celular, US.id_usuario
				FROM tbl_usuario US 
				INNER JOIN tbl_usuarioperfil PE ON PE.id_usuarioPerfil=US.id_usuarioPerfil 
				WHERE US.id_usuario!=' . $_SESSION ['id_usuario'] . ' && US.id_cliente=' . $_SESSION ['id_cliente'];
		$resultado = $this->con->query ( $sql );
		return $resultado;
	}
	/*public function listaPerfil(){
		$sql = 'SELECT PE.id_usuarioPerfil, PE.perfil
				FROM tbl_usuarioperfil PE
				WHERE PE.id_clienteGestor='.$_SESSION['id_clienteGestor'];
		$resultado = $this->con->query($sql);
		return $resultado;
	}*/
	
        public function addUsuario($usuario) {
		$sql = 'INSERT INTO tbl_usuario SET id_cliente=' . $usuario->getId_clienteGestor () . ',
				nome="' . utf8_decode ( $usuario->getNome () ) . '",
				usuario="' . utf8_decode ( $usuario->getUsuario () ) . '",
				cpf="' . $usuario->getCpf () . '",
				telefone="' . $usuario->getTelefone () . '",
				cnpj="' . $usuario->getCnpj () . '",
				email="' . utf8_decode ( $usuario->getEmail () ) . '",
				senha="' . $usuario->getSenha () . '",
				aniversario="' . $usuario->getAniversario () . '"';
		$resultado = $this->con->executar ( $sql );
		return $resultado;
	}
	
        public function deletaUsuario($usuario) {
		$sql = 'DELETE FROM tbl_usuario WHERE id_usuario=' . $usuario->getId_usuario ();
		if ($this->con->executar ( $sql ) == 1)
			echo '<script>alert("Usuário excluido com sucesso!")</script>';
		else
			echo '<script>alert("O Usuário não pode ser excluido!")</script>';
		return true;
	}
	
        public function editarUsuario($usuario) {
		$sql = 'UPDATE tbl_usuario 
				SET nome="' . utf8_decode ( $usuario->getNome () ) . '", 
					usuario="' . utf8_encode ( $usuario->getUsuario () ) . '", 
					cpf="' . $usuario->getCpf () . '", 
					telefone="' . $usuario->getTelefone () . '", 
					email="' . ($usuario->getEmail ()) . '", 
					aniversario="' . $usuario->getAniversario () . '"';
		if ($usuario->getSenha () != null) {
			$sql .= ', senha="' . $usuario->getSenha () . '"';
		}
		$sql .= ' WHERE id_usuario=' . $usuario->getId_usuario () . ';';
		$resultado = $this->con->executar ( $sql );
		if ($resultado == 1)
			return true;
		else
			return false;
	
	}
	
        public function alterarSenha($usuario, $senhaNova) {
		$sql = 'UPDATE tbl_usuario 
				SET senha="' . $senhaNova . '"
				WHERE id_usuario=' . $usuario->getId_usuario ();
		$resultado = $this->con->executar ( $sql );
		if ($resultado == 1)
			return true;
		else
			return false;
	}

        // Função para mostrar combo de Tipo de usuário - Wester
        public function comboTipoUsuario($tipo){
            $sql = 'SELECT id_tipousuario as id, tipousuario as nome
                    FROM tbl_tipousuario ';

            if($tipo!=2) // Diferente de 2 mostra combo sem Aluno
                $sql .= 'WHERE id_tipousuario != 2';
            else    // Monstra combra só com ALuno
                $sql .= 'WHERE id_tipousuario=2';

            $resultado = $this->con->query($sql);
            return $resultado;            
        }

        // Função para adicionar usuário
        public function adicionarUsuario($nome, $senha, $cmb_tipoUsuario, $email, $cpf, $carteiraIdentidade, $orgaoExpedidor, $dataNascimento, $celular, $sexo, $telefone){
            $systemClass = new System();
            
            $sql = "INSERT INTO tbl_usuario(".'"id_tipousuario"'.", email, cpf, datanascimento,
                    carteiraidentidade,orgaoexpedidor, celular, senha, sexo, nome, telefone)
                    VALUES ($cmb_tipoUsuario[0], '$email', '$cpf', '$dataNascimento', '$carteiraIdentidade', '$orgaoExpedidor', '$celular','".md5($senha)."', '$sexo', '$nome', '$telefone')";
            //exit(nl2br($sql));
            $resultado = $this->con->executar($sql);
            return $resultado;    }
            
        /**
         * @name alterarUsuario - Altera qualquer campo da tabela usuário - tbl_usuario
         * @author Wester Cardoso
         * @return valor booleano
         */
        public function alterarUsuario($id, $nome=NULL, $senha=NULL, $cmb_tipoUsuario=NULL, $email=NULL, $cpf=NULL, $carteiraIdentidade=NULL, $orgaoExpedidor=NULL, $dataNascimento=NULL, $celular=NULL, $sexo=NULL, $telefone=NULL){
            $sql = 'UPDATE tbl_usuario set '; $cont = 0;

            if($nome!=NULL) { if($cont){$sql .=',';} $sql .= "nome='$nome' "; $cont++; }
            if($senha!=NULL) { if($cont){$sql .=',';} $sql.= " senha='".md5($senha)."' "; $cont++; }
            if($cmb_tipoUsuario!=NULL) { if($cont){$sql .=',';} $sql.= " id_tipousuario=".$cmb_tipoUsuario[0]." "; $cont++; }
            if($email!=NULL) { if($cont){$sql .=',';} $sql.= " email='$email' "; $cont++; }
            if($cpf!=NULL) { if($cont){$sql .=',';} $sql.= " cpf='$cpf' "; $cont++; }
            if($carteiraIdentidade!=NULL) { if($cont){$sql .=',';} $sql.= " carteiraidentidade='$carteiraIdentidade' "; $cont++; }
            if($orgaoExpedidor!=NULL) { if($cont){$sql .=',';} $sql.= " orgaoexpedidor='$orgaoExpedidor' "; $cont++; }
            if($dataNascimento!=NULL) { if($cont){$sql .=',';} $sql.= " datanascimento='$dataNascimento' "; $cont++; }
            if($celular!='igual') { if($cont){$sql .=',';} $sql.= " celular='$celular' "; $cont++; }
            if($sexo!=NULL) { if($cont){$sql .=',';} $sql.= " sexo='$sexo' "; $cont++; }
            if($telefone!=NULL) { if($cont){$sql .=',';} $sql.= " telefone='$telefone' "; $cont++; }

            $sql .= "WHERE id_usuario=$id";
            //exit(nl2br($sql));
            if($cont==0) $sql = 0; // Se não tiver nenhuma alteração o resultado recebe 0
            else $resultado = $this->con->executar($sql);

            return $resultado;   }
 
//        public function buscaUsuario ($cpf)
//        {
//            $sql = "SELECT cpf
//                    FROM tbl_usuario
//                    WHERE cpf = '$cpf'";
//
//            $resultado = $this->con->query($sql);
//            return $resultado;
//
//        }

//        public function atualizarSenha_ ($novaSenha, $cpf)
//        {
//            $sql = "UPDATE tbl_usuario SET senha='$novaSenha'
//                        WHERE cpf='$cpf'";
//
//            $resultado = $this->con->executar($sql);
//            return $resultado;
//        }

        // Função para buscar dados com parâmetro (Passar apenas 1 parametro) - Wester
        public function dadosUsuario($id_usuario=NULL, $cpf=NULL){
            $sql = 'SELECT US.id_usuario, TU.id_tipousuario, US.email, US.cpf, US.datanascimento, US.carteiraidentidade, US.orgaoexpedidor, US.celular, US.sexo, US.nome, US.senha, US.telefone
                    FROM tbl_usuario US
                    INNER JOIN tbl_tipousuario TU ON TU.id_tipousuario= US.id_tipousuario ';
                   
            if($id_usuario) $sql .= 'WHERE US.id_usuario ='.$id_usuario;
            if($cpf) $sql .= "WHERE US.cpf ='$cpf'";

            $resultado = $this->con->query($sql);
            return $resultado;}
            
        public function usuarios($id_usuario){
            $sql = 'select * from tbl_usuario
                    where id_usuario='.$id_usuario;
            $resultado = $this->con->query($sql);
            return $resultado;
        }
}

?>
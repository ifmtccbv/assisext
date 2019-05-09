<?php
require_once ('PrincipalView.class.php');

class PrincipalControle {
	private $principalView;
	
	public function montaPrincipal($permissao) {
		extract($_SESSION );
		$principalView = new PrincipalView ( );
		switch ($var = date ( "G" )) {
			case $var >= 0 && $var <= 6 :
				$hora = "Acordado essa hora!? Seja bem-vindo!";
				break;
			case $var > 6 && $var <= 12 :
				$hora = "Excelente dia para você! Seja bem-vindo!";
				break;
			case $var > 12 && $var <= 18 :
				$hora = "Boa Tarde! Seja bem-vindo!";
				break;
			case $var > 18 && $var <= 23 :
				$hora = "Boa noite, Seja bem-vindo!";
				break;
		}
		$principalView->topo ( $hora, $permissao );
		$principalView->menu ( $permissao );
		$principalView->corpo ();
		$principalView->exibirPagina ();
	}
	/*	public function showFormAddUsuario(){
		$usuarioDAO = new UsuarioDAO();
		$usuarioView = new UsuarioView();
		$resultadoPerfil=$usuarioDAO->listaPerfil();
		$usuarioView->formAddUsuario($resultadoPerfil); 
	}
	public function addUsuario(){
		extract($_REQUEST);
		$usuarioDAO = new UsuarioDAO();
		$usuarioView = new UsuarioView();
		$usuario = new Usuario();
		$usuario=array("id_clienteGestor"=>$_SESSION['id_clienteGestor'], 
						"id_usuarioPerfil"=>$perfil,
						"nome"=>$nome,
						"usuario"=>$usuario,
						"cpf"=>$cpf,
						"telefone"=>$telefone,
						"cnpj"=>$cnpj,
						"email"=>$email,
						"senha"=>$senha,
						"aniversario"=>$dtNascimento
						);
		var_dump(addUsuario);
	}
*/
}

?>
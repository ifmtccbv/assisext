<?php

class usuario {
	private $id_usuario;
	private $id_cliente;
	//private $id_usuarioPerfil;
	private $nome;
	private $usuario;
	//private $usuarioSigla;
	private $cpf;
	private $telefone;
	private $celular;
	private $cnpj;
	private $email;
	private $senha;
	private $aniversario;
	private $situacao;
	/*private $dataCadastro;
	private $horaCadastro;
	private $perfil;*/
	
	/**
	 * @return the $id_usuario
	 */
	public function getId_usuario() {
		return $this->id_usuario;
	}
	
	/**
	 * @param field_type $id_usuario
	 */
	public function setId_usuario($id_usuario) {
		$this->id_usuario = $id_usuario;
	}
	
	/**
	 * @return the $id_cliente
	 */
	public function getId_cliente() {
		return $this->id_cliente;
	}
	
	/**
	 * @param field_type $id_cliente
	 */
	public function setId_cliente($id_cliente) {
		$this->id_cliente = $id_cliente;
	}
	
	/**
	 * @return the $nome
	 */
	public function getNome() {
		return $this->nome;
	}
	
	/**
	 * @param field_type $nome
	 */
	public function setNome($nome) {
		$this->nome = $nome;
	}
	/**
	 * @return the $id_usuario
	 */
	public function getUsuario() {
		return $this->usuario;
	}
	
	/**
	 * @param field_type $id_usuario
	 */
	public function setUsuario($usuario) {
		$this->usuario = $usuario;
	}
	
	/**
	 * @return the $cpf
	 */
	public function getCpf() {
		return $this->cpf;
	}
	
	/**
	 * @param field_type $cpf
	 */
	public function setCpf($cpf) {
		$this->cpf = $cpf;
	}
	
	/**
	 * @return the $telefone
	 */
	public function getTelefone() {
		return $this->telefone;
	}
	
	/**
	 * @param field_type $telefone
	 */
	public function setTelefone($telefone) {
		$this->telefone = $telefone;
	}
	
	/**
	 * @return the $celular
	 */
	public function getCelular() {
		return $this->celular;
	}
	
	/**
	 * @param field_type $celular
	 */
	public function setCelular($celular) {
		$this->celular = $celular;
	}
	
	/**
	 * @return the $cnpj
	 */
	public function getCnpj() {
		return $this->cnpj;
	}
	
	/**
	 * @param field_type $cnpj
	 */
	public function setCnpj($cnpj) {
		$this->cnpj = $cnpj;
	}
	
	
	
	/**
	 * @return the $email
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 * @param field_type $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}
	
	/**
	 * @return the $senha
	 */
	public function getSenha() {
		return $this->senha;
	}
	
	/**
	 * @param field_type $senha
	 */
	public function setSenha($senha) {
		$this->senha = $senha;
	}
	
	/**
	 * @return the $aniversario
	 */
	public function getAniversario() {
		return $this->aniversario;
	}
	
	/**
	 * @param field_type $aniversario
	 */
	public function setAniversario($aniversario) {
		$this->aniversario = $aniversario;
	}
	
/**
	 * @return the $situacao
	 */
	public function getSituacao() {
		return $this->situacao;
	}
	
	/**
	 * @param field_type $situacao
	 */
	public function setSituacao($situacao) {
		$this->situacao = $situacao;
	}

}
?>
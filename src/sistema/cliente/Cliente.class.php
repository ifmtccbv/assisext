<?php

class Cliente {
	
	private $id_cliente;
	private $id_clienteGestor;
	private $id_cidade;
	private $cidade;
	private $nome;
	private $sigla;
	private $razaoSocial;
	private $cnpj;
	private $cpf;
	private $inscricaoEstadual;
	private $endereco;
	private $bairro;
	private $numero;
	private $cep;
	private $telefone;
	private $dataCadastro;
	private $horaCadastro;
	

	/**
	 * @return the $cidade
	 */
	public function getCidade() {
		return $this->cidade;
	}

	/**
	 * @param field_type $cidade
	 */
	public function setCidade($cidade) {
		$this->cidade = $cidade;
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
	 * @return the $id_clienteGestor
	 */
	public function getId_clienteGestor() {
		return $this->id_clienteGestor;
	}

	/**
	 * @param field_type $id_clienteGestor
	 */
	public function setId_clienteGestor($id_clienteGestor) {
		$this->id_clienteGestor = $id_clienteGestor;
	}

	/**
	 * @return the $id_cidade
	 */
	public function getId_cidade() {
		return $this->id_cidade;
	}

	/**
	 * @param field_type $id_cidade
	 */
	public function setId_cidade($id_cidade) {
		$this->id_cidade = $id_cidade;
	}

	/**
	 * @return the $sigla
	 */
	public function getSigla() {
		return $this->sigla;
	}

	/**
	 * @param field_type $sigla
	 */
	public function setSigla($sigla) {
		$this->sigla = $sigla;
	}

	/**
	 * @return the $razaoSocial
	 */
	public function getRazaoSocial() {
		return $this->razaoSocial;
	}

	/**
	 * @param field_type $razaoSocial
	 */
	public function setRazaoSocial($razaoSocial) {
		$this->razaoSocial = $razaoSocial;
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
	 * @return the $inscricaoEstadual
	 */
	public function getInscricaoEstadual() {
		return $this->inscricaoEstadual;
	}

	/**
	 * @param field_type $inscricaoEstadual
	 */
	public function setInscricaoEstadual($inscricaoEstadual) {
		$this->inscricaoEstadual = $inscricaoEstadual;
	}

	/**
	 * @return the $endereco
	 */
	public function getEndereco() {
		return $this->endereco;
	}

	/**
	 * @param field_type $endereco
	 */
	public function setEndereco($endereco) {
		$this->endereco = $endereco;
	}

	/**
	 * @return the $bairro
	 */
	public function getBairro() {
		return $this->bairro;
	}

	/**
	 * @param field_type $bairro
	 */
	public function setBairro($bairro) {
		$this->bairro = $bairro;
	}

	/**
	 * @return the $numero
	 */
	public function getNumero() {
		return $this->numero;
	}

	/**
	 * @param field_type $numero
	 */
	public function setNumero($numero) {
		$this->numero = $numero;
	}

	/**
	 * @return the $cep
	 */
	public function getCep() {
		return $this->cep;
	}

	/**
	 * @param field_type $cep
	 */
	public function setCep($cep) {
		$this->cep = $cep;
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
	 * @return the $dataCadastro
	 */
	public function getDataCadastro() {
		return $this->dataCadastro;
	}

	/**
	 * @param field_type $dataCadastro
	 */
	public function setDataCadastro($dataCadastro) {
		$this->dataCadastro = $dataCadastro;
	}

	/**
	 * @return the $horaCadastro
	 */
	public function getHoraCadastro() {
		return $this->horaCadastro;
	}

	/**
	 * @param field_type $horaCadastro
	 */
	public function setHoraCadastro($horaCadastro) {
		$this->horaCadastro = $horaCadastro;
	}

}

?>
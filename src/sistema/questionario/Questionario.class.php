<?php

class Motorista {
	private $id_motorista;
	private $id_clienteGestor;
	private $id_cidade;
	private $nome;
	private $cpf;
	private $rg;
	private $dataNascimento;
	private $cnh;
	private $bairro;
	private $cep;
	private $endereco;
	private $numero;
	private $logradouro;
	private $telefoneResidencial;
	private $telefoneCelular;
	private $dataCadastro;
	private $horaCadastro;
	/**
	 * @return the $id_motorista
	 */
	public function getId_motorista() {
		return $this->id_motorista;
	}

	/**
	 * @return the $id_clienteGestor
	 */
	public function getId_clienteGestor() {
		return $this->id_clienteGestor;
	}

	/**
	 * @return the $id_cidade
	 */
	public function getId_cidade() {
		return $this->id_cidade;
	}

	/**
	 * @return the $nome
	 */
	public function getNome() {
		return $this->nome;
	}

	/**
	 * @return the $cpf
	 */
	public function getCpf() {
		return $this->cpf;
	}

	/**
	 * @return the $rg
	 */
	public function getRg() {
		return $this->rg;
	}

	/**
	 * @return the $dataNascimento
	 */
	public function getDataNascimento() {
		return $this->dataNascimento;
	}

	/**
	 * @return the $cnh
	 */
	public function getCnh() {
		return $this->cnh;
	}

	/**
	 * @return the $bairro
	 */
	public function getBairro() {
		return $this->bairro;
	}

	/**
	 * @return the $cep
	 */
	public function getCep() {
		return $this->cep;
	}

	/**
	 * @return the $rua
	 */
	public function getRua() {
		return $this->rua;
	}

	/**
	 * @return the $numero
	 */
	public function getNumero() {
		return $this->numero;
	}

	/**
	 * @return the $logradouro
	 */
	public function getLogradouro() {
		return $this->logradouro;
	}

	/**
	 * @return the $telefoneResidencial
	 */
	public function getTelefoneResidencial() {
		return $this->telefoneResidencial;
	}

	/**
	 * @return the $telefoneCelular
	 */
	public function getTelefoneCelular() {
		return $this->telefoneCelular;
	}

	/**
	 * @return the $dataCadastro
	 */
	public function getDataCadastro() {
		return $this->dataCadastro;
	}

	/**
	 * @return the $horaCadastro
	 */
	public function getHoraCadastro() {
		return $this->horaCadastro;
	}

	/**
	 * @param field_type $id_motorista
	 */
	public function setId_motorista($id_motorista) {
		$this->id_motorista = $id_motorista;
	}

	/**
	 * @param field_type $id_clienteGestor
	 */
	public function setId_clienteGestor($id_clienteGestor) {
		$this->id_clienteGestor = $id_clienteGestor;
	}

	/**
	 * @param field_type $id_cidade
	 */
	public function setId_cidade($id_cidade) {
		$this->id_cidade = $id_cidade;
	}

	/**
	 * @param field_type $nome
	 */
	public function setNome($nome) {
		$this->nome = $nome;
	}

	/**
	 * @param field_type $cpf
	 */
	public function setCpf($cpf) {
		$this->cpf = $cpf;
	}

	/**
	 * @param field_type $rg
	 */
	public function setRg($rg) {
		$this->rg = $rg;
	}

	/**
	 * @param field_type $dataNascimento
	 */
	public function setDataNascimento($dataNascimento) {
		$this->dataNascimento = $dataNascimento;
	}

	/**
	 * @param field_type $cnh
	 */
	public function setCnh($cnh) {
		$this->cnh = $cnh;
	}

	/**
	 * @param field_type $bairro
	 */
	public function setBairro($bairro) {
		$this->bairro = $bairro;
	}

	/**
	 * @param field_type $cep
	 */
	public function setCep($cep) {
		$this->cep = $cep;
	}

	/**
	 * @param field_type $rua
	 */
	public function setEndereco($endereco) {
		$this->endereco = $endereco;
	}

	/**
	 * @param field_type $numero
	 */
	public function setNumero($numero) {
		$this->numero = $numero;
	}

	/**
	 * @param field_type $logradouro
	 */
	public function setLogradouro($logradouro) {
		$this->logradouro = $logradouro;
	}

	/**
	 * @param field_type $telefoneResidencial
	 */
	public function setTelefoneResidencial($telefoneResidencial) {
		$this->telefoneResidencial = $telefoneResidencial;
	}

	/**
	 * @param field_type $telefoneCelular
	 */
	public function setTelefoneCelular($telefoneCelular) {
		$this->telefoneCelular = $telefoneCelular;
	}

	/**
	 * @param field_type $dataCadastro
	 */
	public function setDataCadastro($dataCadastro) {
		$this->dataCadastro = $dataCadastro;
	}

	/**
	 * @param field_type $horaCadastro
	 */
	public function setHoraCadastro($horaCadastro) {
		$this->horaCadastro = $horaCadastro;
	}

}

?>
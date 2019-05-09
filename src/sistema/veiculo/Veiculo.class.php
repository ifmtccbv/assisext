<?php

class Veiculo {

	private $id_veiculo;
	private $id_clienteGestor;
	private $id_tipoVeiculo;
	private $id_cidade;
	private $id_proprietario;
	private $id_marca;
	private $id_cor;
	private $id_rastreador;
	private $id_veiculocarroceria;
	private $numeroDedicado;
	private $anttValidade;
	private $placa;
	private $anttNumero;
	private $modelo;
	private $ano;
	private $modulo;
	private $eixos;
	private $dataCadastro;
	private $horaCadastro;
	/**
	 * @return the $id_veiculo
	 */
	public function getId_veiculo() {
		return $this->id_veiculo;
	}

	/**
	 * @param field_type $id_veiculo
	 */
	public function setId_veiculo($id_veiculo) {
		$this->id_veiculo = $id_veiculo;
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
	 * @return the $id_tipoVeiculo
	 */
	public function getId_tipoVeiculo() {
		return $this->id_tipoVeiculo;
	}

	/**
	 * @param field_type $id_tipoVeiculo
	 */
	public function setId_tipoVeiculo($id_tipoVeiculo) {
		$this->id_tipoVeiculo = $id_tipoVeiculo;
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
	 * @return the $id_proprietario
	 */
	public function getId_proprietario() {
		return $this->id_proprietario;
	}

	/**
	 * @param field_type $id_proprietario
	 */
	public function setId_proprietario($id_proprietario) {
		$this->id_proprietario = $id_proprietario;
	}

	/**
	 * @return the $id_marca
	 */
	public function getId_marca() {
		return $this->id_marca;
	}

	/**
	 * @param field_type $id_marca
	 */
	public function setId_marca($id_marca) {
		$this->id_marca = $id_marca;
	}

	/**
	 * @return the $id_cor
	 */
	public function getId_cor() {
		return $this->id_cor;
	}

	/**
	 * @param field_type $id_cor
	 */
	public function setId_cor($id_cor) {
		$this->id_cor = $id_cor;
	}

	/**
	 * @return the $id_rastreador
	 */
	public function getId_rastreador() {
		return $this->id_rastreador;
	}

	/**
	 * @param field_type $id_rastreador
	 */
	public function setId_rastreador($id_rastreador) {
		$this->id_rastreador = $id_rastreador;
	}

	/**
	 * @return the $id_veiculocarroceria
	 */
	public function getId_veiculocarroceria() {
		return $this->id_veiculocarroceria;
	}

	/**
	 * @param field_type $id_veiculocarroceria
	 */
	public function setId_veiculocarroceria($id_veiculocarroceria) {
		$this->id_veiculocarroceria = $id_veiculocarroceria;
	}

	/**
	 * @return the $numeroDedicado
	 */
	public function getNumeroDedicado() {
		return $this->numeroDedicado;
	}

	/**
	 * @param field_type $numeroDedicado
	 */
	public function setNumeroDedicado($numeroDedicado) {
		$this->numeroDedicado = $numeroDedicado;
	}

	/**
	 * @return the $anttValidade
	 */
	public function getAnttValidade() {
		return $this->anttValidade;
	}

	/**
	 * @param field_type $anttValidade
	 */
	public function setAnttValidade($anttValidade) {
		$this->anttValidade = $anttValidade;
	}

	/**
	 * @return the $placa
	 */
	public function getPlaca() {
		return $this->placa;
	}

	/**
	 * @param field_type $placa
	 */
	public function setPlaca($placa) {
		$this->placa = $placa;
	}

	/**
	 * @return the $anttNumero
	 */
	public function getAnttNumero() {
		return $this->anttNumero;
	}

	/**
	 * @param field_type $anttNumero
	 */
	public function setAnttNumero($anttNumero) {
		$this->anttNumero = $anttNumero;
	}

	/**
	 * @return the $modelo
	 */
	public function getModelo() {
		return $this->modelo;
	}

	/**
	 * @param field_type $modelo
	 */
	public function setModelo($modelo) {
		$this->modelo = $modelo;
	}

	/**
	 * @return the $ano
	 */
	public function getAno() {
		return $this->ano;
	}

	/**
	 * @param field_type $ano
	 */
	public function setAno($ano) {
		$this->ano = $ano;
	}

	/**
	 * @return the $modulo
	 */
	public function getModulo() {
		return $this->modulo;
	}

	/**
	 * @param field_type $modulo
	 */
	public function setModulo($modulo) {
		$this->modulo = $modulo;
	}

	/**
	 * @return the $eixos
	 */
	public function getEixos() {
		return $this->eixos;
	}

	/**
	 * @param field_type $eixos
	 */
	public function setEixos($eixos) {
		$this->eixos = $eixos;
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
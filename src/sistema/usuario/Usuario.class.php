<?php

class Usuario {

    private $id_usuario;
    private $id_tipoUsuario;
    private $nome;
    private $cpf;
    private $celular;
    private $sexo;
    private $email;
    private $senha;
    private $dataNascimento;
    private $CI;
    private $orgaoExpedidor;

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getId_tipoUsuario() {
        return $this->id_tipoUsuario;
    }

    public function setId_tipoUsuario($id_tipoUsuario) {
        $this->id_tipoUsuario = $id_tipoUsuario;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function setCelular($celular) {
        $this->celular = $celular;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    public function getCI() {
        return $this->CI;
    }

    public function setCI($CI) {
        $this->CI = $CI;
    }

    public function getOrgaoExpedidor() {
        return $this->orgaoExpedidor;
    }

    public function setOrgaoExpedidor($orgaoExpedidor) {
        $this->orgaoExpedidor = $orgaoExpedidor;
    }


}

?>
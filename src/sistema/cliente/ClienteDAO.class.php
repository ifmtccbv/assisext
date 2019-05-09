<?php
require_once 'sistema/geral/ConexaoBD.class.php';

class ClienteDAO {
	public $con;
	
	public function __construct(){
		$this->con = new ConexaoBD();
	}
	
	public function addCliente($cliente){
		if($cliente->getCpf()!='')
			$sql = 'SELECT id_cliente FROM tbl_clientes WHERE cpf="'.$cliente->getCpf().'"';
		else
			$sql = 'SELECT id_cliente FROM tbl_clientes WHERE cnpj="'.$cliente->getCnpj().'"';
			
		$mostraCliente = $this->con->query($sql);
		
		if(count($mostraCliente)>0){
			return 0;
		}else{		
			$sql = 'INSERT INTO tbl_clientes SET  id_clienteGestor='.$cliente->getId_clienteGestor().', id_cidade='.$cliente->getId_cidade().', nome="'.$cliente->getNome().'" , sigla="'.$cliente->getSigla().'", razaoSocial="'.$cliente->getRazaoSocial().'", cnpj="'.$cliente->getCnpj().'", cpf="'.$cliente->getCpf().'", inscricaoEstadual="'.$cliente->getInscricaoEstadual().'", endereco="'.$cliente->getEndereco().'", bairro="'.$cliente->getBairro().'", numero="'.$cliente->getNumero().'", cep="'.$cliente->getCep().'", Telefone="'.$cliente->getTelefone().'",  dataCadastro="'.date('Y-m-d').'", horaCadastro="'.date('H:i:s').'"';
			
			$resultado=$this->con->executar($sql);
			return $resultado;
		}
	}
	public function listarCliente($where=null){
		 $sql='SELECT CLI.*, CONCAT(CI.nome, " - ", UF.sigla) AS cidade FROM tbl_clientes CLI LEFT JOIN tbl_cidade CI ON CI.id_cidade = CLI.id_cidade LEFT JOIN tbl_uf UF ON UF.id_uf = CI.id_uf '.$where.' ORDER BY CLI.id_cliente, CLI.sigla, CLI.razaoSocial';
		 $resultado=$this->con->query($sql);
		 return $resultado;
	}
	public function listarEstado(){
		$sql = 'SELECT id_uf, sigla FROM tbl_uf ORDER BY sigla';
		$mostraUF = $this->con->query($sql);
		return $mostraUF;
	}
	public function deletarCliente($cliente){
		$sql = 'DELETE  FROM tbl_clientes WHERE id_cliente='.$cliente->getId_cliente().'' ;
		$resultado=$this->con->executar($sql);
		return $resultado;
	}
	public function editarCliente($cliente){
		$sql = 'UPDATE tbl_clientes SET id_cidade='.$cliente->getId_cidade().', nome="'.$cliente->getNome().'", sigla="'.$cliente->getSigla().'", razaoSocial="'.$cliente->getRazaoSocial().'", cnpj="'.$cliente->getCnpj().'", cpf="'.$cliente->getCpf().'", inscricaoEstadual="'.$cliente->getInscricaoEstadual().'", endereco="'.$cliente->getEndereco().'", bairro="'.$cliente->getBairro().'", numero="'.$cliente->getNumero().'", cep="'.$cliente->getCep().'", Telefone="'.$cliente->getTelefone().'" WHERE id_cliente='.$cliente->getId_cliente();
		$resultado=$this->con->executar($sql);
		return $resultado;
	}
	
}

?>
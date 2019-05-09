<?php

require_once 'ClienteDAO.class.php';
require_once 'Cliente.class.php';
require_once 'ClienteView.class.php';
require_once 'sistema/usuario/UsuarioDAO.class.php';
require_once 'sistema/geral/SystemClass.class.php';

class ClienteControle extends System{
	
	public function addCliente(){
		extract($_REQUEST);
		$clienteView = new ClienteView();
		$clienteDAO = new ClienteDAO();
		$clienteObj = new Cliente();	
		System::autoCompleteCidade($clienteDAO->con);	
		if(isset($acao) && $acao=='adicionar')
		{
			$uf=substr($cidade, -2);
			$cidade=explode(" - ", $cidade);
			$resultadoIdCidade=System::selecionaIdCidade($clienteDAO->con, $cidade[0], $uf);
			$clienteObj->setNome(utf8_decode($nome));
			$clienteObj->setId_cliente(System::soNumero($id_cliente));
			$clienteObj->setId_clienteGestor($_SESSION['id_clienteGestor']);
			$clienteObj->setBairro(utf8_decode(strtoupper($bairro)));
			$clienteObj->setCep(System::soNumero($cep));
			$clienteObj->setCnpj(System::soNumero($cnpj));
			$clienteObj->setCpf(System::soNumero($cpf));
			$clienteObj->setEndereco(utf8_decode(strtoupper($endereco)));			
			$clienteObj->setId_cidade($resultadoIdCidade[0]['id_cidade']);
			$clienteObj->setInscricaoEstadual($inscricaoEstadual);
			$clienteObj->setRazaoSocial(utf8_decode(strtoupper($razaoSocial)));
			$clienteObj->setSigla(utf8_decode(strtoupper($sigla)));
			$clienteObj->setNumero(System::soNumero($numero));
			$clienteObj->setTelefone(System::soNumero($telefone));		
			if($clienteDAO->addCliente($clienteObj)){				
					echo '<script>alert("Cliente adicionado com sucesso!");
							LoadPage("cliente.php?metodo=addCliente");
					 </script>';
				}else{
					echo '<script>
		     				alert("Erro ao adicionar cliente. Verifique se não há dados duplicados", "Atenção");		     							LoadPage("cliente.php?metodo=addCliente");
	        		</script>';
				}
		}else{			
			$clienteView->formCliente('adicionar', null);
		}
	}
	public function visualizar(){	
		extract($_REQUEST);
		$clienteDAO = new ClienteDAO();
		$clienteView = new ClienteView();
		$estados=$clienteDAO->listarEstado();
		
		System::autoCompleteCidade($clienteDAO->con);
		if(isset($acao) && $acao=='pesquisar'){	
			$where='';							    
			if($id_cliente!=0 || $sigla !="" || $razaoSocial!="" || $cidade!='' || $uf!=0 ){
				if($cidade!=''){
					$uf=substr($cidade, -2);
					$cidade=explode(" - ", $cidade);
					$resultadoCidade=$clienteDAO->selecionaIdCidade($cidade[0], $uf);
				}
				$where = 'WHERE (';				
				if($id_cliente!=0) $where .= 'CLI.id_cliente="'.System::soNumero($id_cliente).'" AND ';
				if($sigla!="") $where .= 'CLI.sigla LIKE "%'.$sigla.'%" AND ';
				if($razaoSocial!="") $where .= 'CLI.razaoSocial LIKE "%'.$razaoSocial.'%" AND ';
				if($cidade!=0) $where .= 'CLI.id_cidade='.$resultadoCidade[0]['id_cidade'].' AND ';
				if($uf!=0) $where .= 'CI.id_uf='.$uf.' AND ';				
				$where = substr($where,0,-5); 
				$where .= ')';
			}
			$resultado=$clienteDAO->listarCliente($where);
			if(count($resultado)==0){
				echo '<script>alert("Não foi encontrado nenhum registro")</script>';
			}else{ 	
				$usuarioDAO=new UsuarioDAO();
				$permissao=$usuarioDAO->pegaPermissao();
				$clienteView->listarPesquisa($resultado, $permissao);	
			}
			
		}else{	
				$clienteView->visualizarClientes($estados);
		}
	}
	public function deletaCliente(){
		extract($_REQUEST);
		$clienteObj = new Cliente();
		$clienteDAO = new ClienteDAO();
		$clienteObj->setId_cliente($id);
		
		$resultado=$clienteDAO->deletarCliente($clienteObj);
		if($resultado){
			
			echo '<script>
					alert("Cliente excluido com sucesso!");
					location.href="#cliente.php?metodo=visualizar&acao=pesquisar&1";
				</script>';
		}else{
			echo '<script>
			         alert("Cliente não pode ser excluido!")
			         location.href="#cliente.php?metodo=visualizar&acao=mostrar&1";
			      </script>';
		}
	}
	public function editarCliente(){
		extract($_REQUEST);
		$clienteObj = new Cliente();
		$clienteDAO = new ClienteDAO();
		$clienteView = new ClienteView();
		$clienteObj->setId_cliente($id_cliente);
			
		if(isset($acao) && $acao=='editar'){
			$uf=substr($cidade, -2);
			$cidade=explode(" - ", $cidade);
			$resultado=$clienteDAO->selecionaIdCidade($cidade[0], $uf);
			
			$clienteObj->setNome(utf8_decode($nome));
			$clienteObj->setSigla(utf8_decode(strtoupper($sigla)));
			$clienteObj->setRazaoSocial(utf8_decode($razaoSocial));
			$clienteObj->setCpf(System::soNumero($cpf));
			$clienteObj->setCnpj(System::soNumero($cnpj));
			$clienteObj->setInscricaoEstadual($inscricaoEstadual);
			$clienteObj->setCep(System::soNumero($cep));
			$clienteObj->setEndereco(utf8_decode(strtoupper($endereco)));
			$clienteObj->setBairro(utf8_decode(strtoupper($bairro)));
			$clienteObj->setId_cidade($resultado[0]['id_cidade']);
			$clienteObj->setNumero(utf8_decode(strtoupper($numero)));
			$clienteObj->setTelefone(System::soNumero($telefone));
			
			if($clienteDAO->editarCliente($clienteObj)){
				echo '<script>
		            alert("Cliente  alterado com sucesso");
		            location.href="#cliente.php?metodo=visualizar&acao=mostrar";	
		            
				</script>';
			}else{
				echo '<script>
		            alert("Não foi possível alterar usuário");
		            location.href="#cliente.php?metodo=addCliente&acao=mostrar";		            
				</script>';
			}
		}else{
			$where='WHERE CLI.id_cliente='.$id_cliente;	
			$resultado=$clienteDAO->listarCliente($where);
			$clienteObj->setNome($resultado[0]['nome']);
			$clienteObj->setSigla($resultado[0]['sigla']);
			$clienteObj->setRazaoSocial($resultado[0]['razaoSocial']);
			$clienteObj->setCpf($resultado[0]['cpf']);
			$clienteObj->setCnpj($resultado[0]['cnpj']);
			$clienteObj->setInscricaoEstadual($resultado[0]['inscricaoEstadual']);
			$clienteObj->setCep($resultado[0]['cep']);
			$clienteObj->setEndereco($resultado[0]['endereco']);
			$clienteObj->setBairro($resultado[0]['bairro']);
			$clienteObj->setCidade($resultado[0]['cidade']);
			$clienteObj->setNumero($resultado[0]['numero']);
			$clienteObj->setTelefone($resultado[0]['telefone']);
			
			$clienteView->formCliente('editar', $clienteObj);
		}
	}
}


?>
<?php
require_once 'Motorista.class.php';
require_once 'MotoristaDAO.class.php';
require_once 'MotoristaView.class.php';
require_once 'sistema/geral/SystemClass.class.php';

class MotoristaControle extends System{
	
	public function addMotorista(){
		extract($_REQUEST);
		
		$motoristaDAO = new MotoristaDAO();
		$motoristaView = new MotoristaView();
		$motorista = new Motorista();
		System::autoCompleteCidade($motoristaDAO->con);
		if(isset($acao) && $acao=='adicionar'){
			$uf=substr($cidade, -2);
			$cidade=explode(" - ", $cidade);
			$resultadoIdCidade=System::selecionaIdCidade($motoristaDAO->con, $cidade[0], $uf);
			
			$motorista->setId_clienteGestor($_SESSION['id_clienteGestor']);
			$motorista->setId_cidade($resultadoIdCidade[0]['id_cidade']);
			$motorista->setNome(utf8_decode(strtoupper($nome)));
			$motorista->setCpf(System::soNumero($cpf));
			$motorista->setRg($rg);
			$motorista->setDataNascimento(System::converteData($dataNascimento, '/0000'));
			$motorista->setCnh($cnh);
			$motorista->setBairro(utf8_encode(strtoupper($bairro)));
			$motorista->setCep(System::soNumero($cep));
			$motorista->setEndereco(utf8_encode(strtoupper($endereco)));
			$motorista->setNumero(System::soNumero($numero));
			$motorista->setLogradouro(utf8_decode(strtoupper($logradouro)));
			$motorista->setTelefoneCelular(System::soNumero($telefoneCelular));
			$motorista->setTelefoneResidencial(System::soNumero($telefoneResidencial));
			if($motoristaDAO->adicionarMotorista($motorista)){
				echo '<script>
						alert("CPF já cadastrado");
						location.href="#motorista.php?metodoaddMotorista&acao=mostrar&1";
				</script>';
			}else{
				echo '<script>
						alert("Cadastro realizado com sucesso);
						location.href="#motorista.php?metodoaddMotorista&acao=mostrar&1";
					</script>';
			}
		}else{
			$motoristaView->formMotorista('adicionar', null);
		}
	}
	
	public function verMotorista(){
		$motoristaDAO = new MotoristaDAO();
		$motoristaView = new MotoristaView();
		$motorista = new Motorista();
		
		$motoristaView->verMotorista();
	}
}

?>
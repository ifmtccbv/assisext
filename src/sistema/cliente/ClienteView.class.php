<?php
require_once 'sistema/geral/SiteView.class.php';


class ClienteView extends SiteView{

	
	public function formCliente($acao, $cliente){		
		if($cliente!=null){
			$titulo='Editar Cliente';
			$metodo='editarCliente';
			$botaoEnviar='Editar';
			$id_cliente=$cliente->getId_cliente();			
			$id_cidade=$cliente->getId_cidade();
			$endereco=$cliente->getEndereco();
			$bairro=$cliente->getBairro();
			$cep=$cliente->getCep();
			$cidade=$cliente->getCidade();
			$numero=$cliente->getNumero();
			$telefone=$cliente->getTelefone();
			$nome=$cliente->getTelefone();
			if($cliente->getCnpj()!=''){
				$cpf='';
				$sigla=$cliente->getSigla();
				$razaoSocial=$cliente->getRazaoSocial();
				$cnpj=$cliente->getCnpj();
				$inscricaoEstadual=$cliente->getInscricaoEstadual();
				$optionCliente='<option selected="selected" value=1>Pessoa Jurídica</option>
								<option value=2>Pessoa Física</option>';
				$tipoCliente=1;
			}else{
				$sigla='';
				$razaoSocial='';
				$cnpj='';
				$inscricaoEstadual='';
				$nome=$cliente->getNome();
				$cpf=$cliente->getCpf();			

				$optionCliente='<option value=1>Pessoa Jurídica</option>
								<option selected="selected" value=2>Pessoa Física</option>';
				$tipoCliente=2;
			}
			
			
		}else{
			$titulo='Adicionar Cliente';
			$metodo='addCliente';
			$botaoEnviar='Inserir';
			$optionCliente='<option value=1>Pessoa Jurídica</option>
						<option value=2>Pessoa Física</option>';

			$tipoCliente=1;
			$id_cliente='';
			$nome='';
			$cidade='';
			$sigla='';
			$razaoSocial='';
			$cnpj='';
			$cpf='';
			$inscricaoEstadual='';
			$endereco='';
			$bairro='';
			$cep='';
			$numero='';
			$telefone='';
		}
		
		
		$conteudo='					
			<script>	
			$(document).ready(function(){
				$("#cidade").autocomplete(cidades);					
				$(\'#enviarForm\').click(function(){
					validar(operacoesCliente);
				});           
				
				$("#cpf").mask("999.999.999-99");
				$("#cep").mask("99999-999");
				$("#telefone").mask("(99)9999-9999");
				$("#cnpj").mask("99.999.999/9999-99");
			});	  	
		pessoaFisicaEPJ('.$tipoCliente.');
  		</script> 
  				<span class="titulo">'.$titulo.'</span>
  				<div id="erro"></div>  
  				<br />            	
				<div id="geral">
	                
	                <label for="tipoPessoa" class="label">Tipo de cliente:</label>
	                <select id="tipoPessoa" onchange="pessoaFisicaEPJ(this.value);">
	                	'.$optionCliente.'
	                </select>
	                <br />
	                
	               	
	              
	                <div id="pf" style="display:none">
	                	<br />
	                	<label for="cpf" class="label">CPF:</label>
	                	<input type="text" id="cpf" name="CPF" class="formulario" size="14" req="true" value="'.$cpf.'"/>
	               	 	<br />
	               	 	<label for="nome"  id="nomeLabel" class="label">Nome:</label>	
	                </div>
	                <div id="pj"> 
	                <br />
	                	<label for="sigla" class="label">Sigla:</label>
	               		<input type="text" id="sigla" name="Sigla do cliente" class="formulario" size="25" maxlength="100" req="true" caractere="true" value="'.$sigla.'"/>
	                	<br />    
	                	<label for="razaoSocial" class="label">Razão Social:</label>
	                	<input type="text" id="razaoSocial" name="Razão Social" class="formulario" size="50" maxlength="100" req="true" caractere="true" value="'.$razaoSocial.'"/>
	                	<br />
	                	<label for="cnpj" class="label">CNPJ:</label>
	                	<input type="text" id="cnpj" name="CNPJ" class="formulario" size="18" maxlength="100" req="true" value="'.$cnpj.'"/>
	                	<br />
	                	<label for="insEstadual" class="label">Insc. Estadual:</label>
	                	<input type="text" id="inscricaoEstadual" name="Inscrição Estadual" class="formulario" size="30" maxlength="100" req="true" value="'.$inscricaoEstadual.'"/>
	                	<br />
	                	<label for="nome"  id="nomeLabel" class="label">Nome Fantasia:</label>	           
	                </div>	                
	                <input type="text" id="nome" name="Nome " class="formulario" size="25" maxlength="100" req="true" caractere="true" value="'.$nome.'"/>    
					<br />
	                <label for="cep" class="label">CEP:</label>
	                <input type="text" id="cep" name="CEP" class="formulario" size="10" maxlength="10" req="true" onBlur="consultaCEP()" value="'.$cep.'"/>
	                <br />
	                <label for="endereco" class="label">Endereco:</label>
	                <input type="text" id="endereco" name="Endereco" class="formulario" size="50" maxlength="100" req="true" value="'.$endereco.'"/>
	                <br />
	                <label for="bairro" class="label">Bairro:</label>
	                <input type="text" id="bairro" name="Bairro" class="formulario" size="50" maxlength="50" req="true" value="'.utf8_decode($bairro).'"/>
	                <br />
	                <label for="cidade" class="label">Cidade:</label>
	                <input type="text" id="cidade" name="Cidade" class="formulario" size="50" maxlength="100" req="true" value="'.$cidade.'"/>
	                <br/>
	                <label for="numero" class="label">Número:</label>
	                <input type="text" id="numero" name="Número" class="formulario" size="30" maxlength="100" req="true" value="'.$numero.'"/>
	                <br />
	                <label for="telefone" class="label">Telefone:</label>
	                <input type="text" id="telefone" name="Telefone" class="formulario" size="15" maxlength="100" req="true" value="'.$telefone.'"/>
                    
	                 <br />           
		         </div>		      
		 
                 <br /><br />
                 <input name="id_cliente" id="id_cliente" type="hidden" value="'.$id_cliente.'"/>
                 <input name="acao" id="acao" type="hidden" value="'.$acao.'" />
                 <input name="metodo" id="metodo" type="hidden" value="'.$metodo.'" />
                 <input name="voltar" id="voltar" type="button" value="Voltar" class="botao" onclick="javascript:history.back(1);" /> 
                 <input name="enviarForm" id="enviarForm" type="button"  class="botao" value="'.$botaoEnviar.'" />
			
		
     	  <div id="resultadoFuncao"></div>';
		echo $conteudo;
	}
	public function visualizarClientes($estados){
		$optionEstados='';
		for($i=0;$i<count($estados);$i++){
			$optionEstados.= '<option value="'.$estados[$i]['id_uf'].'">
						'.utf8_encode($estados[$i]['sigla']).'
					</option>
			';
		}
		$conteudo= '
		<script>
			$(document).ready(function(){
				$("#cidade").autocomplete(cidades);						   
				$("#verCliente").click(verClientes);
			});
		</script>
			<span class="titulo">
		<img src="sistema/geral/imagens/showBox.gif" align="Pesquisa clientes" style="visibility:hidden;" onclick="mostraPesquisaCliente()" id="mostraMais"/><img src="sistema/geral/imagens/hideBox.gif" align="Pesquisa clientes" onclick="escondePesquisaCliente()" id="esconde" /> Visualizar clientes</span> 
        <br />       
        <div id="busca">
        <div id="erro"></div>
			<form>
			    
            	<label for="identificacao" class="label">Identificação:</label>
                <input type="text" id="id_cliente" name="identificacaoCliente" class="formulario" size="8" maxlength="8" req="true"/>              
                <br />
                <label for="sigla" class="label">Sigla:</label>
	            <input type="text" id="sigla" name="Sigla" class="formulario" size="30" maxlength="30" req="true" caractere="true" />
	            <br />
                <label for="razaosocial" class="label">Razão Social:</label>
	            <input type="text" id="razaoSocial" name="Razão Social" class="formulario" size="50" maxlength="100" req="true" caractere="true" />
	            <br />
                <label for="cidade" class="label">Cidade:</label>
                <input type="text" name="Cidade" id="cidade" class="formulario" req="true">
                <br />
                 <label for="uf" class="label">Estado:</label>
                 <select name="Estado" id="uf" class="formulario" req="true">
                 <option value="0">Todos</option>.'.$optionEstados.'
                   
                </select>
                <br /><br />
               
               <input name="acao" id="acao" type="hidden" value="pesquisar"/>
               <input name="metodo" id="metodo" type="hidden" value="visualizar"/>
               <input name="voltar" id="voltar" type="button" value="Voltar" class="botao" onclick="javascript:history.back(1);" /> 
               <input name="verCliente" id="verCliente" type="submit" value="Ver" class="botao" />
        	</form>
        </div>
        <div id="div_resultadoPesquisa">
        </div>';
		echo $conteudo;
		
			
		
	}
	public function listarPesquisa($resultado, $permissao){
		$thAcao='';		
			if($permissao[0]['clientesEditar']==1 or $permissao[0]['clientesExcluir']==1){						  	
				$thAcao= '<th>Ações</th>';
			}
			$conteudo='<script>
					escondePesquisaCliente();
				 </script>
                <table id="tbl_cliente" class="listaTable">
               	  <thead>
                        <tr>
                          <th>Código</th>
                          <th>Nome</th>
                          <th>Sigla</th>                          
                          <th>Razão Social</th>
                          <th>Cidade</th>
                          '.$thAcao.'						  
        			  	</tr>
                </thead>';
			for($i=0;$i<count($resultado);$i++){
				$editar = '<a onclick="pageload(\'cliente-metodo=editarCliente&acao=mostrar&id_cliente='.$resultado[$i]["id_cliente"].'&1\')" class="history"><img border="0" alt="Editar" title="Editar" src="sistema/geral/imagens/icon_editar.png" /></a>';
				$excluir = '<a onClick="jConfirm(\'Deseja realmente excluir o cliente?\', \'Confirmação de exclusão!\', 
									function(r) {
										if(r==true){																			
								 			location.href=\'#cliente-metodo=deletaCliente&id='.$resultado[$i]["id_cliente"].'&1\';
								 			
										}
									});"><img border="0" alt="Excluir" title="Excluir" src="sistema/geral/imagens/icon_delete.png" /></a>';
				    
				$conteudo.= '<tr>
				        <td>'.($resultado[$i]['id_cliente']).'</td>
				        <td>'.($resultado[$i]['nome']).'</td>
						<td>'.($resultado[$i]['sigla']).'</td>
						<td>'.strtoupper(utf8_encode($resultado[$i]['razaoSocial'])).'</td>
						<td>'.utf8_encode($resultado[$i]['cidade']).'</td>';
				
				if($permissao[0]['clientesEditar']==1 or $permissao[0]['clientesExcluir']==1){
						$conteudo.= '<td>';
					    if($permissao[0]['clientesEditar']==1){
						 $conteudo.= ''.$editar.'';
					    } 
					    
					    if($permissao[0]['clientesExcluir']==1){
						 $conteudo.= ''.$excluir.'';
					    } 				      
						$conteudo.= '</td>';				
					$conteudo.= '</tr>';
				}
			}
		$conteudo.=	'</table>
                 <br />
                    <input name="btn_voltar" id="btn_voltar" type="button" value="Voltar" class="botao" onclick="javascript:history.back(1);" />
                 <br />';
		
		echo $conteudo;
	}
}

?>
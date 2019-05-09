<?php
require_once 'sistema/geral/SiteView.class.php';

class MotoristaView extends SiteView{

	
	public function formMotorista($acao, $motorista){	
	if($motorista!=null){
		$abas='';
		$botaoEnviar='Editar';
		$titulo='Editar Motorista';
		$metodo='editarMotorista';
		$id_motorista = $motorista->getId_motorista();
		$id_clienteGestor = $motorista->getId_clienteGestor();
		$id_cidade = $motorista->getId_cidade();
		$cidade = $motorista->getCidade();
		$nome = $motorista->getNome();
		$cpf = $motorista->getCpf();
		$rg = $motorista->getRg();
		$dataNascimento = $motorista->getData_Nascimento();
		$cnh = $motorista->getCnh();
		$bairro = $motorista->getBairro();
		$cep = $motorista->getCep();
		$endereco = $motorista->getEndereco();
		$numero = $motorista->getNumero();
		$logradouro = $motorista->getLogradouro();
		$telefoneResidencial = $motorista->getTelefoneResidencial();
		$telefoneCelular = $motorista->getTelefoneCelular();
		
	}else{
		$abas='<li><a href="#grisco"><span>G. Risco</span></a></li>
		            <li><a href="#treinamento"><span>Treinamento</span></a></li>';
		$botaoEnviar='Inserir';
		$titulo='Adicionar Motorista';
		$metodo='addMotorista';
		$id_motorista = '';
		$id_clienteGestor = '';
		$id_cidade = '';
		$cidade = '';
		$nome = '';
		$cpf = '';
		$rg = '';
		$dataNascimento = '';
		$cnh = '';
		$bairro = '';;
		$cep = '';
		$endereco = '';
		$numero = '';
		$logradouro = '';
		$telefoneResidencial = '';
		$telefoneCelular = '';
	}	
		
	
	$conteudo='<script type="text/javascript">		

		$(document).ready(function(){            
			$("#div_abas").tabs({fxSlide: true });
			$(\'#enviarForm\').click(function(){
					validar(operacoesMotorista);
				});
			$("#cidade").autocomplete(cidades);
			$("#cpf").mask("999.999.999-99");
			$("#cep").mask("99999-999");
			$("#telefoneResidencial").mask("(99)9999-9999");
			$("#telefoneCelular").mask("(99)9999-9999");
			$("#dataNascimento").datepicker({ dateFormat: "dd/mm"});
			$("#cnpj").mask("99.999.999/9999-99");
		});
  		</script> 
		<span class="titulo">'.$titulo.'</span>
        <div id="erro"></div>
        <div id="div_abas">            
			<ul>
	            <li><a href="#geral"><span>Geral</span></a></li>	            
				'.$abas.'     
	          
	    	</ul>
		<div id="geral">
		<b>Dados do motorista</b>
                <br /><br />
	                <label for="cpf" class="label">CPF:</label>
	                <input type="text" id="cpf" name="CPF" class="formulario" size="15" maxlength="100" cpf="true" value="'.$cpf.'" />              
	                <br />
	                <label for="nome" class="label">Nome:</label>
	                <input type="text" id="nome" name="Nome" class="formulario" size="50" maxlength="100" req="true" caractere="true" value="'.$nome.'"/>
	                <br />
	                <label for="cep" class="label">CEP:</label>
	                <input type="text" id="cep" name="CEP" class="formulario" size="15" maxlength="100" req="true" onBlur="consultaCEP()" value="'.$cep.'"/>
	                <br />
	                <label for="logradouro" class="label">Logradouro:</label>
	                <input type="text" id="logradouro" name="Logradouro" class="formulario" size="30" maxlength="100" req="true" value="'.$logradouro.'"/>
	                <br />
	                <label for="endereco" class="label">Endereco:</label>
	                <input type="text" id="endereco" name="Endereco" class="formulario" size="50" maxlength="100" req="true" value="'.$endereco.'"/>
	                <br />
	                <label for="bairro" class="label">Bairro:</label>
	                <input type="text" id="bairro" name="Bairro" class="formulario" size="30" maxlength="100" req="true" value="'.$bairro.'"/>
	                <br />               
	                <label for="cidade" class="label">Cidade:</label>
	                <input type="text" id="cidade" name="Cidade" class="formulario" size="30" maxlength="100" req="true" value="'.$cidade.'"/>
	                <br/>
	                <label for="numero" class="label">Número:</label>
	                <input type="text" id="numero" name="Número" class="formulario" size="30" maxlength="100" req="true" value="'.$numero.'"/>
	                <br />
	                <label for="rg" class="label">RG:</label>
	                <input type="text" id="rg" name="RG" class="formulario" size="30" maxlength="100" req="true" value="'.$rg.'"/>              
	                <br />
	                <label for="telefone" class="label">Telefone:</label>
	                <input type="text" id="telefoneResidencial" name="Telefone" class="formulario" size="15" maxlength="100" req="true" value="'.$telefoneResidencial.'"/>
	                <br />
	                <label for="celular" class="label">Celular:</label>
	                <input type="text" id="telefoneCelular" name="Celular" class="formulario" size="15" maxlength="100" req="true" value="'.$telefoneCelular.'"/>
	                <br />
	                <label for="cnh" class="label">CNH:</label>
	                <input type="text" id="cnh" name="CNH" class="formulario" size="30" maxlength="100" req="true" value="'.$cnh.'"/>              
	                <br />
	                <label for="dataNascimento" class="label">Data Nascimento:</label>
	                <input type="text"  id="dataNascimento" name="Data Nascimento" class="formulario" size="15" req="true" value="'.$dataNascimento.'"/>
                </div> 
                
                   <div id="grisco">
		                <b>Dados do gerenciador de risco</b>
		                <br /><br />
		                <label for="cmb_gerenciadoraRisco" class="label">Gerenc. Risco:</label>
		                <select name="Gerenciadora de risco" id="cmb_gerenciadoraRisco" class="formulario" req="true">
		                <option value="">Selecione...</option>
		                    
		                </select>
			            <br/>
			            <label for="liberacao" class="label">Nº liberação:</label>
			            <input type="text" id="liberacao" name="Nº da liberação" class="formulario" req="true" size="15"/>
		                <br />
		                <label for="dataVencimento" class="label">Data Vencimento:</label>
		                <input type="text" id="dataVencimento" name="Data vencimento" class="formulario" size="15" req="true" />
		          </div>
		          
		          <div id="treinamento">
		                <b>Adicionar treinamento</b>
	                    <br />
						<label for="cmb_treinamento" class="label">Treinamento:</label>
						<select name="Treinamento" id="cmb_treinamento" class="formulario" req="true">
						<option value="">Selecione...</option>
						   
						</select>
		          </div>
                <br /><br />
                <input name="voltar" id="voltar" type="button" value="Voltar" class="botao" onclick="javascript:history.back(1);" /> 
				<input name="enviarForm" id="enviarForm" type="button" value="'.$botaoEnviar.'" class="botao" />
		</form>
		     </div>
     	     <div id="resultadoFuncao"></div> ';
         
		echo $conteudo;		

	}
	
	public function verMotorista(){
		$conteudo='
		<script type="text/javascript">
		

		$(document).ready(function(){            
			$("#div_abas").tabs({fxSlide: true });
			
		});
	  	
  	</script>
 
  		<span class="titulo">Visualizar Motoristas</span>
		<div id="div_abas">
        <ul>
            <li><a href="#solicitacoes"><span>Solicitações</span></a></li>
            <li><a href="#bloqueios"><span>Bloqueios</span></a></li>
		    <li><a href="#treinamentos"><span>Treinamentos</span></a></li>
            <li><a href="#gerenciador"><span>Gerenciamento de Risco</span></a></li>
    	</ul>
    
        <div id="solicitacoes">
		         <table class="listaTable">
		              	<thead>
		                    <tr>
		                       <th>Transporte</th>
		                       <th>Data</th>
		                       <th>Transportadora</th>
		                       <th>Status</th>
		                    </tr>
		               </thead>
		                
		         </table>
		       
    	</div>
    	 <div id="bloqueios">
		        
                
				   <table class="listaTable">
		              	<thead>
		                    <tr>
		                       <th>Data</th>
		                       <th>Motivo</th>
		                       <th>Até</th>
		                       <th>Status</th>
		                    </tr>
		               </thead>
	                    
						
	                    
		           </table>
		        
				
                  	 
                	<form>
                	    <br /><br />
						
			            <div id="erro1"></div>
                     	<br />
			    		<input type="hidden" id="id_motorista" name="id_motorista" value="<?php echo $idMotorista; ?>" />
			            <label for="txt_cpf" class="label">CPF:</label>
			            <input type="text" id="txt_cpf" name="CPF do motorista" class="formulario" size="35" disabled="disabled" value="" />
			            <br/>
						<label for="txt_motorista" class="label">Motorista:</label>
						<input type="text" id="txt_motorista" name="Motorista" class="formulario" size="35" disabled ="disabled" value="" />
			            <br/>
			            <label for="txt_dataNascimento" class="label">Data Nascimento:</label>
			            <input type="text" id="txt_dataNascimento" name="Data de nascimento do motorista" class="formulario" size="35" disabled="disabled" value="" />
			            <br/>
			            <label for="cmb_responsavelBloqueio" class="label">Responsável:</label>
			            <select  id="cmb_responsavelBloqueio" class="formulario" req1="true">
					    <option value="">Selecione...</option>
					   
					    </select> 
			            <br/>
			            
			            <label for="txt_dataliberacao" class="label">Data liberação:</label>
						<input type="text" id="txt_dataliberacao" name="Data liberação" class="formulario"   />
						<br />
			            
						<label for="txt_motivo" class="label">Motivo:</label>
						<textarea id="txt_motivo" rows="4" cols="50"  class="formulario" req1="true"></textarea>
						 
			            <br /><br />
			            <input type="button" value="Inserir" class="botao" />
			            
					</form>
                
                 	 
              
    	   </div>
    	   
    	    

           <div id="treinamentos">
        
	        		<table class="listaTable">
		              	<thead>
		                    <tr>
		                       <th>Treinamento</th>
		                       <th>Cadastro</th>
		                       <th>Validade</th>
		                       
		                    </tr>
		               </thead>
	                    
	           		</table>
	           		
					<form> 
    					 <br /><br />
						 <span class="titulo">Adicionar treinamento</span>
	                     <div id="erro2"></div>
	                     <br />
    					<input type="hidden" id="id_motorista" name="id_motorista" value="<?php echo $idMotorista; ?>" />
						<label for="txt_cpf" class="label">CPF:</label>
						<input type="text" id="txt_cpf" name="CPF" class="formulario" size="18" disabled ="disabled" value="" />
						<br />
						<label for="txt_motorista" class="label">Motorista:</label>
						<input type="text" id="txt_motorista" name="Motorista" class="formulario" size="35" disabled ="disabled" value="" />
						<br />
						<label for="cmb_treinamento" class="label">Treinamento:</label>
						<select name="Treinamento" id="cmb_treinamento" class="formulario" req2="true">
						<option value="">Selecione...</option>
						     
						</select>
                        <br /><br />
			            <input name="btn_addTreinamento" id="btn_addTreinamento" type="button" value="Inserir" class="botao" />
			        </form>
                    
          </div>
    	   
		
	        <div id="gerenciador">
	             
	        		<table class="listaTable">
		              	<thead>
		                    <tr>
		                       <th>Gerenciador</th>
		                       <th>Liberação</th>
		                       <th>Cadastro</th>
		                       <th>Validade</th>
		                       
		                    </tr>
		               </thead>
	                    
	           		</table>
	           		
						
						<form id="gerenciadorRisco">
							<br /><br />
					 		<span class="titulo">
        				 		Adicionar gerenciamento de risco
        			 		</span>
                     		<div id="erro3"></div>
                     		<div id="resultadoFuncao"></div> 
                     		<br />
			                <input type="hidden" id="id_motorista" name="id_motorista" value="" />
			                <label for="txt_cpf" class="label">CPF:</label>
		                    <input type="text" id="txt_cpf" name="CPF" class="formulario" size="18" disabled ="disabled" value="" />
		                    <br />
		                    <label for="txt_motorista" class="label">Motorista:</label>
		                    <input type="text" id="txt_motorista" name="Motorista" class="formulario" size="35" disabled ="" />
		                    <br />
		                    <label for="cmb_gerenciadoraRisco" class="label">Gerenc. Risco:</label>
			                <select name="Gerenciadora de risco" id="cmb_gerenciadoraRisco" class="formulario" req3="true">
			                <option value="">Selecione...</option>
			                    
			                </select>
				            <br/>
				            <label for="txt_liberacao" class="label">Nº liberação:</label>
				            <input type="text" id="txt_liberacao" name="Nº da liberação" class="formulario" req3="true" size="15"/>
			                <br />
			                <label for="txt_dataVencimento" class="label">Data Vencimento:</label>
			                <input type="text" id="txt_dataVencimento" name="Data de vencimento" class="formulario" size="15" req3="true" />
		                    <br /><br />
		                    <input name="btn_addGr" id="btn_addGr" type="button" value="Inserir" class="botao" />
			        	</form>
	        </div>';
		echo $conteudo;
	}
	
}

?>
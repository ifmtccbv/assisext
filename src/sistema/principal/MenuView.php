<?php
require_once ('sistema/geral/SiteView.class.php');

class MenuView extends SiteView {
	//Retorna HTML de todo o menu construido
	public function montaTodoMenu($permissao) {
            $resultado = $this->montaMenuQuestionario ( $permissao [0] ['id_tipousuario']);
            $resultado .= $this->montaMenuRelatorios ($permissao [0] ['id_tipousuario']);
            $resultado .= $this->montaMenuUsuarios ( $permissao [0] ['id_tipousuario'], $permissao [0] ['usuarioAdicionar'], $permissao [0] ['usuarioVisualizar'], $permissao [0] ['usuarioExcluir'], $permissao [0] ['usuarioEditar'], $permissao [0] ['perfilAdicionar'], $permissao [0] ['perfilVisualizar'], $permissao [0] ['perfilExcluir'], $permissao [0] ['perfilEditar'] );
            $resultado .= $this->montarMenuProgramas ($permissao [0] ['id_tipousuario']);
            return $resultado;
	}
        
	//As funções abaixo retornam HTML de partes do menu principal 
	public function montaMenuQuestionario($id_tipoUsuario){
            $html = NULL;
            if($id_tipoUsuario!=3)
                $html = '<li class="submenu" onmouseover="mopen(\'subQuestionario\')" onmouseout="mclosetime()"><a><img src="sistema/geral/imagens/icon_questionario.png" alt="Questionario" border="0" /><br />Questionário</a>
			<ul class="menu" id="subQuestionario" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">';
		//administrador
		if ($id_tipoUsuario==1)
                    $html .= '<li><a class="history" href="#questionario-metodo=addQuestionario&acao=mostrar">Adicionar Questionário</a></li>
                              <li><a class="history" href="#questionario-metodo=verQuestionario&acao=visualizar">Visualizar Questionários</a></li>';
		elseif($id_tipoUsuario==2)
                    $html .= '<li><a class="history" href="#questionario-metodo=addQuestionarioAluno&acao=mostrar">Preencher Questionário</a></li>';
                else
                    $html .= NULL;
	    if($id_tipoUsuario!=3)
		$html .= '</ul>
			</li>';
		return $html;
	}
        
        function montaMenuRelatorios($id_tipoUsuario) {
             //administrador
		if ($id_tipoUsuario==1 || $id_tipoUsuario==3){
                   $html = '<li class="submenu" onmouseover="mopen(\'subRelatorios\')" onmouseout="mclosetime()"><a><img src="sistema/geral/imagens/ico_relatorios.png" alt="Relatorio" border="0" /><br />Relatórios</a>
                            <ul class="menu" id="subRelatorios" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">';

                   $html .= '   <li> <a class="history" href="#relatorio-metodo=montaRelatorio&acao='.md5('frmRelatorio').'&ok"> Questionários </a> </li>
                                <li> <a class="history" href="#relatorio-metodo=relatorioResumo&acao='.md5('frmResumo').'&ok"> Resumo </a> </li>
                                <li> <a class="history" href="#relatorio-metodo=relatorioExcel&acao='.md5('frmRelatorio').'&ok"> Relatório Excel </a> </li>';

                   $html .= '</ul>
                            </li>';}
                              
		elseif($id_tipoUsuario==1)
                    $html .= NULL;
                                    
                else
                    $html .= NULL;  
		return $html;
        }
	
	function montaMenuUsuarios($id_tipoUsuario, $usuarioAdicionar, $usuarioVisualizar, $usuarioExcluir, $usuarioEditar, $perfilAdicionar, $perfilVisualizar, $perfilExcluir, $perfilEditar) {
		//sempre imprimi usuario pelo menos para alterar senha
        if($id_tipoUsuario!=3)
            $html = '<li class="submenu" onmouseover="mopen(\'subUsuarios\')" onmouseout="mclosetime()"><a><img src="sistema/geral/imagens/ico_clientes.png" alt="Usuários" border="0" /><br />Usuários</a>
			   	<ul class="menu" id="subUsuarios" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">';

                 if ($id_tipoUsuario == 1){
		//usuario
		//	$html .= '<li><a onmouseover="mopensub(\'subsub3\')">Usuário</a> <ul id="subsub3" class="menuVertical">';
		//alterar senha
		$html .= '<li><a href="#usuario-metodo=alterarSenha&acao=mostrar" class="history">Alterar senha</a></li>';
                $html .= '<li><a href="#usuario-metodo=addUsuario&acao=mostrar" class="history">Adicionar Usuário</a></li>';
                $html .= '<li><a href="#usuario-metodo=verUsuario&acao=visualizar" class="history">Visualizar</a></li>';
                $html .= '<li><a class="history" href="#usuario-metodo=verAluno&php">Editar Aluno</a></li>';
//		if ($usuarioAdicionar == 1)
//			$html .= '<li style="width:90px;"><a class="history" href="#usuario-metodo=addUsuario&acao=mostrar">Adicionar</a></li>';
//		if ($usuarioEditar == 1 || $usuarioExcluir == 1 || $usuarioVisualizar == 1)
//			$html .= '<li><a class="history" href="#usuario-metodo=visualizar">Visualizar</a></li>';//.'</ul>';
		//$html .= '</li>';

		/*//perfil
		if ($perfilAdicionar == 1 || $perfilEditar == 1 || $perfilExcluir == 1 || $perfilVisualizar == 1) {
			$html .= '<li><a onmouseover="mopensub(\'subsub4\')">Perfil</a>
						 <ul id="subsub4" class="menuVertical">';
			if ($perfilAdicionar == 1)
				$html .= '<li style="width:90px;"><a class="history" href="#perfil/perfil-adicionar">Adicionar</a></li>';
			if ($perfilEditar == 1 || $perfilExcluir == 1 || $perfilVisualizar == 1)
				$html .= '<li><a class="history" href="#perfil/perfil-visualizar">Visualizar</a></li>';
			$html .= ' </ul>
                            </li>';
		}*/
                 }
                elseif ($id_tipoUsuario == 2)
                    $html .= '<li><a href="#usuario-metodo=alterarSenha&acao=mostrar" class="history">Alterar senha</a></li>
                                <li> <a href="#usuario-metodo=alterarDados&acao='.md5('frmAlteraDados').'&ok" class="history"> Alterar Dados </a> </li>';
                else
                    $html .= NULL;
		
		$html .= '</ul>
			  </li>';
		
		return $html;
	}
        
        function montarMenuProgramas ($id_tipoUsuario)
        {
            if ($id_tipoUsuario == 2){
            $html = '<li class="submenu" onmouseover="mopen(\'subProgramas\')" onmouseout="mclosetime()"><a><img src="sistema/geral/imagens/icon_programas.png" alt="Programas" border="0" /><br />Programas</a>
                <ul class="menu" id="subProgramas" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">';

            $html .= '<li><a class="history" href="#">Sobre Programas</a></li>';

            $html .= '</ul>
                    </li>';}

            else $html .= NULL;
            return $html;

        }
	
	/*function montaMenuContatos() {
		
		$html = '<li class="submenu" onmouseover="mopen(\'subContatos\')" onmouseout="mclosetime()"><a"><img src="sistema/geral/imagens/icon_contatos.png" alt="Contatos" border="0" /><br />Contatos</a>
			   			<ul class="menu" id="subContatos" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">';
		
		//usuario
		//$html .= '<li><a onmouseover="mopensub(\'subsub3\')">Contatos</a> <ul id="subsub3" class="menuVertical">';
		
		$html .= '<li style="width:90px;"><a class="history" href="#usuario-metodo=addUsuario&acao=mostrar">Adicionar</a></li>';
		
		$html .= '<li><a class="history" href="#usuario-metodo=visualizar">Visualizar</a></li>';//.'</ul>';
		$html .= ' 
                     </li>';
		
		$html .= '</ul>
					</li>';
		
		return $html;
	
	}*/
	/*
	function montaMenuEmpresas() {
		
		$html = '<li class="submenu" onmouseover="mopen(\'subEmpresas\')" onmouseout="mclosetime()><a""><img src="sistema/geral/imagens/ico_clientes.png" alt="Usuários" border="0" /><br />Empresas</a>
			   			<ul class="menu" id="subEmpresas" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">';
		
		//usuario
		//$html .= '<li><a onmouseover="mopensub(\'subsub3\')">Empresas</a> <ul id="subsub3" class="menuVertical">';
		
		$html .= '<li style="width:90px;"><a class="history" href="#usuario-metodo=addUsuario&acao=mostrar">Adicionar</a></li>';
		
		$html .= '<li><a class="history" href="#usuario-metodo=visualizar">Visualizar</a></li>';//.'</ul>';
		$html .= ' 
                     </li>';
		
		$html .= '</ul>
					</li>';
		
		return $html;
	
	}*/
	/*
	function montaMenuGrupos() {
		
		$html = '<li class="submenu" onmouseover="mopen(\'subGrupos\')" onmouseout="mclosetime()"><a><img src="sistema/geral/imagens/icon_grupos.png" alt="Grupos" border="0" /><br />Grupos</a>
			   			<ul class="menu" id="subGrupos" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">';
		
		//usuario
		//$html .= '<li><a onmouseover="mopensub(\'subsub3\')">grupos</a>	 <ul id="subsub3" class="menuVertical">';
		
		$html .= '<li style="width:90px;"><a class="history" href="#usuario-metodo=addUsuario&acao=mostrar">Adicionar</a></li>';
		
		$html .= '<li><a class="history" href="#usuario-metodo=visualizar">Visualizar</a></li>';//.'</ul>';
		$html .= ' 
                     </li>';
		
		$html .= '</ul>
					</li>';
		
		return $html;
	
	}*/
	
	



}

?>
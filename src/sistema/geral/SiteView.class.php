<?php
/*Todas as Views do sistema herdam essa classe que é como um interface para a impressão de html, js e css
 * 
 */
require_once 'sistema/geral/SystemClass.class.php';
require_once 'sistema/questionario/QuestionarioDAO.class.php';
require_once 'sistema/geral/ConexaoBD.class.php';

class SiteView extends System {
	
	private $conteudo; //conteudo da pagina que vai dentro do body
	private $header; //referencias de JS e CSS
	

	public function openHTML() {
		return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">';
	}
	public function closeHTML() {
		return '</html>';
	}
	//Seta todos os JS e CSS passados por parametro em forma de array	
	public function setHead($title, $nocache = true, $js = array(), $css = array()) {
		$this->header = '<head><title>' . $title . '</title>';
		$this->header .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		for($i = 0; $i < sizeof ( $js ); $i ++) {
			$this->header .= '<script type="text/javascript" charset="UTF-8" src=' . $js [$i] . '></script>';
		}
		
		for($i = 0; $i < sizeof ( $css ); $i ++) {
			$this->header .= '<link rel="stylesheet" href=' . $css [$i] . ' type="text/css" />';
		}
		$this->header .= '</head>';
	}
	
	public function rodape() {
		$rodape = '<div id="rodape">
			    </div>
			    <div id="carregando">
			    </div>';
		return $rodape;
	}
	//Função pra ser usada dentro de alguma view que necessite limpar o conteudo para adicionar outro
	public function limparConteudo() {
		$this->conteudo = '';
	}
	//Seta o conteudo da pagina	
	public function setConteudo($html) {
		$this->conteudo .= $html;
	}
	//Exibe apenas o conteudo caso não seja precisa contruir toda a estrutura da página novamente
	public function exibirConteudo() {
		echo $this->conteudo;
	}
	//Coloca o conteudo setado por alguma view dentro da tag </body>
	public function setBody() {
		return '<body>' . $this->conteudo . '</body>';
	}
	
	//Na sequencia constrói a página inteira -> HEADER - CABECALHO - CONTEUDO - RODAPE 
	public function exibirPagina() {
		$html = $this->header . $this->setBody () . $this->rodape ();
		echo $this->openHTML ();
		echo $html;
		echo $this->closeHTML ();
		$this->limparConteudo ();
	}

        /*
         * Os métodos abaixo são usados p/ montagem de formulario
         */
        function inicioFormulario($id, $class, $action, $validate=NULL, $resultado=NULL){
            if($validate)
                $html = '<script type="text/javascript">
                            $(document).ready(function(){
                                   jQuery("#'.$id.'").validationEngine({
                                        ajaxFormValidation: true,
                                        onAjaxFormComplete: sucesso,
                                        onBeforeAjaxFormValidation: mostrarCarregando,
                                        escreverDiv: "'.$resultado.'"
                                });
                            });
                        </script>';
            else
                $html = NULL;
            
            return $html.'<form id="'.$id.'" class="'.$class.'" action="'.$action.'">';
        }

        function fechaFormulario(){
                return '</form>';
        }

        function montaTitulo($texto){
                return '<span class="titulo">' . $texto . '</span>';
        }
        function inputText($type, $id, $name, $texto, $size, $class, $valor=NULL, $format=NULL, $quebraLinha=0, $disable=NULL, $readOnly=NULL, $radio=NULL, $funcao=NULL){
                if($format!=NULL){
                        switch ($format){
                                case 'datePicker':
                                    $formatacao = '<script>$(".datePicker").datepicker({ dateFormat: "dd/mm/yy"});</script>';
                                    break;
                                 case 'datePicker_dataNascimento':
                                    $formatacao = '<script>$("#'.$id.'").mask("99/99/9999");</script>';
                                    break;
                                case 'moeda':
                                    $formatacao = '<script>$("#'.$id.'").maskMoney({thousands:".", decimal:","});</script>';
                                    break;
                                case 'cpf':
                                    $formatacao = '<script>$("#'.$id.'").mask("999.999.999-99");</script>';
                                    break;
                                case 'cel':
                                    $formatacao = '<script>$("#'.$id.'").mask("(99)9999-9999");</script>';
                                    break;
                                case 'cep':
                                    $formatacao = '<script>$("#'.$id.'").mask("99999-999");</script>';
                                    break;
                        }
                }else
                        $formatacao = NULL;
                if($type=='hidden' || $texto==NULL)
                        $label = NULL;
                else
                        $label = '<label class="label" for="'.$id.'">'.$texto.':</label>';
                if($quebraLinha)
                    $br = '<br />';
                else
                    $br = NULL;
                if($disable!=NULL)
                    $disable = 'disabled="disabled"';
                if($readOnly!=NULL)
                    $readOnly = 'readonly="true"';
                return $formatacao.$label.'<input '.$readOnly.' '.$radio.' '.$disable.' '.$funcao.' type="'.$type.'" id="'.$id.'" name="'.$name.'" size="'.$size.'" class="'.$class.'" value="'.$valor.'" />'.$br;
        }

        function inputTextQuestionario($type, $id, $name, $texto, $size, $class, $valor=NULL, $format=NULL, $quebraLinha=0, $disable=NULL, $readOnly=NULL, $radio=NULL, $funcao=NULL){
                if($format!=NULL){
                        switch ($format){
                                case 'datePicker':
                                    $formatacao = '<script>$(".datePicker").datepicker({ dateFormat: "dd/mm/yy"});</script>';
                                    break;
                                 case 'datePicker_dataNascimento':
                                    $formatacao = '<script>$("#'.$id.'").mask("99/99/9999");</script>';
                                    break;
                                case 'moeda':
                                    $formatacao = '<script>$("#'.$id.'").maskMoney({thousands:".", decimal:","});</script>';
                                    break;
                                case 'cpf':
                                    $formatacao = '<script>$("#'.$id.'").mask("999.999.999-99");</script>';
                                    break;
                                case 'cel':
                                    $formatacao = '<script>$("#'.$id.'").mask("(99)9999-9999");</script>';
                                    break;
                                case 'cep':
                                    $formatacao = '<script>$("#'.$id.'").mask("99999-999");</script>';
                                    break;
                                case 'anoSemestre':
                                    $formatacao = '<script>$("#'.$id.'").mask("9999/9");</script>';
                                    break;
                        }
                }else
                        $formatacao = NULL;
                if($type=='hidden' || $texto==NULL)
                        $label = NULL;
                else
                        $label = '<label class="labelQuestionario" for="'.$id.'">'.$texto.':</label>';
                if($quebraLinha)
                    $br = '<br />';
                else
                    $br = NULL;
                if($disable!=NULL)
                    $disable = 'disabled="disabled"';
                if($readOnly!=NULL)
                    $readOnly = 'readonly="true"';
                return $formatacao.$label.'<input '.$readOnly.' '.$radio.' '.$disable.' '.$funcao.' type="'.$type.'" id="'.$id.'" name="'.$name.'" size="'.$size.'" class="'.$class.'" value="'.$valor.'" />'.$br;
        }

        function montaSelect($type, $id, $name, $texto, $class, $itens, $valor=NULL, $funcao=NULL, $filtro=NULL){
            if($type=='multiple'){
                $formatacao = '
                    <script>
                        $(".multiselect").multiselect({
                            selectedText: "# de # selecionados",
                            noneSelectedText: "Selecione",
                            checkAllText: "Todas",
                            uncheckAllText: "Desmarcar"
                        });
                    </script>';
                $multiple = 'multiple="multiple"';
            }else{
                $formatacao = NULL;
                $multiple = NULL;
            }

            $html = $formatacao.'<label class="label" for="'.$id.'">'.$texto.'</label>
                    <select '.$multiple.' id="'.$id.'" name="'.$name.'" class="'.$class.'" '.$funcao.'>';
            if($filtro==0)
                $html .= '<option value="">Selecione</option>';
            else
                $html .= '<option value="">Todos</option>';
            foreach($itens AS $valorItem){
                if(is_array($valor)){
                    if(in_array($valorItem['id'], $valor))
                        $selected = 'selected="selected"';
                    else
                        $selected = NULL;
                }elseif($valor==$valorItem['id'])
                    $selected = 'selected="selected"';
                else
                    $selected = NULL;
                $html .= '<option '.$selected.' value="'.$valorItem['id'].'">'.$valorItem['nome'].'</option>';
            }
            return $html .= '</select><br />';

        }

        function montaSelectQuestionario($type, $id, $name, $texto, $class, $itens, $valor=NULL, $funcao=NULL, $filtro=NULL, $readOnly=NULL, $semQuebra=NULL){
            if($type=='multiple'){
                $formatacao = '
                    <script>
                        $(".multiselect").multiselect({
                            selectedText: "# de # selecionados",
                            noneSelectedText: "Selecione",
                            checkAllText: "Todas",
                            uncheckAllText: "Desmarcar"
                        });
                    </script>';
                $multiple = 'multiple="multiple"';
            }else{
                $formatacao = NULL;
                $multiple = NULL;
            }
            
            $semQuebra = ($semQuebra == NULL) ? '<br />' : NULL;
            
            if($readOnly){
                $readOnly = 'disabled="disabled"';}

            $html = $formatacao.'<label class="labelQuestionario" for="'.$id.'">'.$texto.'</label>
                    <select '.$multiple.' id="'.$id.'" name="'.$name.'" '.$readOnly.' class="'.$class.'" '.$funcao.'>';
            if($filtro==0)
                $html .= '<option value="">Selecione</option>';
            else
                $html .= '<option value="">Todos</option>';
            foreach($itens AS $valorItem){
                if(is_array($valor)){
                    if(in_array($valorItem['id'], $valor))
                        $selected = 'selected="selected"';
                    else
                        $selected = NULL;
                }elseif($valor==$valorItem['id'])
                    $selected = 'selected="selected"';
                else
                    $selected = NULL;
                $html .= '<option '.$selected.' value="'.$valorItem['id'].'">'.$valorItem['nome'].'</option>';
            }
            return $html .= '</select>' .$semQuebra;

        }

        function montaBotao($value, $class=NULL, $onclick=NULL, $id=NULL, $transparente=NULL){
                if($onclick!=NULL)
                        $type = 'button';
                else
                        $type = 'submit';
                if($transparente)
                    $transparente = 'style="display:none"';
                return '<input '.$transparente.' id="'.$id.'" type="'.$type.'" value="'.$value.'" '.$onclick.' class="'.$class.'" />';
        }

        //Essa sera a função global para montar todo tipo de tabela;
        function montarTabela($titulo, $dados, $cabecalho, $acoes=NULL, $numeroParametros=NULL, $mascara=NULL, $id_tabela=NULL, $grid=NULL){
            $html = '';
            if($grid!=NULL):
                $class = ' display';
                $html .= '<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
                            $(\'#'.$id_tabela.'\').dataTable({"oLanguage": {
    "sProcessing": "Aguarde enquanto os dados são carregados ...",
    "sLengthMenu": "Mostrar _MENU_ registros por pagina",
    "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
    "sInfoEmtpy": "Exibindo 0 a 0 de 0 registros",
    "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
    "sInfoFiltered": "",
    "sSearch": "Procurar",
    "oPaginate": {
       "sFirst":    "Primeiro",
       "sPrevious": "Anterior",
       "sNext":     "Próximo",
       "sLast":     "Último"
    }
 }});
			} );
		</script>';
            endif;
            
            
//            {
//        "bPaginate": false,
//        "bLengthChange": false,
//        "bFilter": true,
//        "bSort": false,
//        "bInfo": false,
//        "bAutoWidth": false
//    }
            
            $html .= $this->montaTitulo($titulo);
            $html .= '<table class="listaTable'.$class.'" id="'.$id_tabela.'">
                                <thead class="listaTdTh">
                                <tr>';

            foreach ($cabecalho as $linha)
                $html .= '<th>' . $linha . '</th>';

            //coluna de ações
            if($acoes!=NULL)
                $html .= '<th>Ações</th>';
            $html .= '</tr> </thead> <tbody>';

            foreach ($dados as $chave => $linha){
                $html .= '<tr>';
                if($numeroParametros==NULL){
                    $i = 1;
                    $controlaColunas = 0;
                }else{
                    $i = $numeroParametros;
                    $controlaColunas = $numeroParametros - 1;
                }
                for ($i; $i <=(count($cabecalho)+$controlaColunas); $i++){
                    //se tiver mascara faz ela valer
                    if($mascara!=NULL){
                        if(isset($mascara[$i])){
                            switch($mascara[$i]['tipo']){
                                case 'data':
                                    $linha[$i] = System::converteData($linha[$i]);
                                    break;
                                case 'moeda':
                                    if($linha[$i] == 'Não Possui') //Ele vai ignorar a máscara
                                        $linha[$i] == $linha[$i];
                                    else
                                        $linha[$i] = System::converteMoeda($linha[$i]);
                                    break;
                                case 'cpf':
                                    if ($linha[$i] != NULL):
                                        $linha[$i] = System::mostraCPF($linha[$i]);
                                    else:
                                        $linha[$i] = '-';
                                    endif;
                                    break;
                                case 'tel':
                                    if($linha[$i]!=0) //Se for diferente de zero usa a máscara* Arrumar uma solução melhor
                                        $linha[$i] = System::escreveTelefone($linha[$i]);
                                    else
                                        $linha[$i] = 'Vazio';
                                    break;
                            }
                        }
                    }
                    $html .= '<td>' . ($linha[$i]) . '</td>';
                }
                if($acoes!=NULL){
                    $html .= '<td>';
                    foreach($acoes AS $valor){
                        switch($valor[0]){
                            case 'visualizar':
                                $html .= ' <a href="'.$_SERVER['PHP_SELF'].'?metodo=visualizar"><img border="0" alt="Visualizar" title="Visualizar" src="sistema/geral/imagens/icon_ver.png" /></a>';
                                break;
                            case 'editar':
                                if(isset($valor['acaoJS'])){
                                    $acaoJS = 'onclick="LoadPageEspecifica(\''.$valor['metodoJS'].'&id='.$linha[0].'\', \''.$valor['divCarregar'].'\');"';
                                }else
                                    $acaoJS = NULL;
                                $html .= ' <a '.$acaoJS.'><img border="0" alt="Editar" title="Editar" src="sistema/geral/imagens/icon_editar.png" /></a>';
                                break;
                            case 'excluir':
                                $html .= ' <a onClick="jConfirm(\''.$valor['msgExcluir'].'\', \'Confirmação de exclusão!\',
					function(r) {
						if(r==true)
                                                    LoadPageEspecifica(\''.$valor['metodoExcluir'].'&id='.$linha[0].'\', \''.$valor['divCarregar'].'\')});">
                                                   <img border="0" alt="Excluir" title="Excluir" src="sistema/geral/imagens/icon_delete.png" /></a>';
                                break;
                            case 'preencher':
                                $html .= ' <a class="history" href="principal.php#'.str_replace('.php', '', end(explode("/", $_SERVER['PHP_SELF']))).'-metodo=preencherQuestionario&id_questionarioPeriodo='.$linha[0].'&id_questionarioResposta='.$linha[1].'&ok" class="" onclick="pageload(\''.$_SERVER['PHP_SELF'].'?metodo=preencherQuestionario&id_questionarioPeriodo='.$linha[0].'&id_questionarioResposta='.$linha[1].'&ok\')">
                                            <img border="0" alt="Preencher Questionário" title="Preencher Questionário" src="sistema/geral/imagens/icon_editar.png" />
                                            </a>';
                                break;
                            case 'imprimir':
                                $html .= ' <a class="history" href="principal.php#'.str_replace('.php', '', end(explode("/", $_SERVER['PHP_SELF']))).'-metodo=imprimeRelatorio&id_questionarioResposta='.$linha[0].'&ok" class="" target="_blank" >
                                            <img border="0" alt="Imprimir" title="Imprimir" src="sistema/geral/imagens/imprimir.png" />
                                            </a>';
                                break;

                        }
                    }
                    $html .= '</td>';
                }
                $html.= '</tr>';
            }
            $html .= '</tbody> </table>';
            return $html;

        }
        
        function montarGrid($titulo, $dados, $cabecalho, $acoes=NULL, $numeroParametros=NULL, $mascara=NULL, $id_tabela=NULL, $ordenacao='true', $paginacao='true', $filtro='true'){
            $html = '';            
            $html .= '<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
                            $(\'#'.$id_tabela.'\').dataTable(
                    {   "bPaginate": '.$paginacao.',
                        "sPaginationType": "full_numbers",
                        "bLengthChange": '.$filtro.',
                        "bFilter": '.$filtro.',
                        "bSort": '.$ordenacao.',
                        "bInfo": '.$filtro.',
                        "bAutoWidth": true,

                        "oLanguage": {
                            "sProcessing": "Aguarde enquanto os dados são carregados ...",
                            "sLengthMenu": "Mostrar _MENU_ registros por pagina",
                            "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
                            "sInfoEmtpy": "Exibindo 0 a 0 de 0 registros",
                            "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
                            "sInfoFiltered": "",
                            "sSearch": "Procurar",
                            "oPaginate": 
                            {
                            "sFirst":    "Primeiro",
                            "sPrevious": "Anterior",
                            "sNext":     "Próximo",
                            "sLast":     "Último"    }

                        }});
                        } );
                                </script>';
            
                        
            $html .= $this->montaTitulo($titulo);
            $html .= '<table class="listaTable display" id="'.$id_tabela.'">
                                <thead class="listaTdTh">
                                <tr>';
            $html .= '<th><input type=checkbox id=chckHead value="" /></th>';

            foreach ($cabecalho as $linha)
                $html .= '<th>' . $linha . '</th>';

            //coluna de ações
            if($acoes!=NULL)
                $html .= '<th>Ações</th>';
            $html .= '</tr> </thead> <tbody>';

            foreach ($dados as $chave => $linha){
                $html .= '<tr>';
                $html .= '<td><input type=checkbox class=chcktbl value="'.$linha[0].'|'.$linha[1].'|" /> </td>';
                if($numeroParametros==NULL){
                    $i = 1;
                    $controlaColunas = 0;
                }else{
                    $i = $numeroParametros;
                    $controlaColunas = $numeroParametros - 1;
                }
                for ($i; $i <=(count($cabecalho)+$controlaColunas); $i++){
                    //se tiver mascara faz ela valer
                    if($mascara!=NULL){
                        if(isset($mascara[$i])){
                            switch($mascara[$i]['tipo']){
                                case 'data':
                                    $linha[$i] = System::converteData($linha[$i]);
                                    break;
                                case 'moeda':
                                    if($linha[$i] == 'Não Possui') //Ele vai ignorar a máscara
                                        $linha[$i] == $linha[$i];
                                    else
                                        $linha[$i] = System::converteMoeda($linha[$i]);
                                    break;
                                case 'cpf':
                                    $linha[$i] = System::mostraCPF($linha[$i]);
                                    break;
                                case 'tel':
                                    if($linha[$i]!=0) //Se for diferente de zero usa a máscara* Arrumar uma solução melhor
                                        $linha[$i] = System::escreveTelefone($linha[$i]);
                                    else
                                        $linha[$i] = 'Vazio';
                                    break;
                            }
                        }
                    }
                    $html .= '<td>' . ($linha[$i]) . '</td>';
                }
                if($acoes!=NULL){
                    $html .= '<td>';
                    $data = date('Y-m-d');
                    $data = strtotime($data);
                    foreach($acoes AS $valor){
                        switch($valor[0]){
                            case 'visualizar':
                                $html .= ' <a href="'.$_SERVER['PHP_SELF'].'?metodo=visualizar"><img border="0" alt="Visualizar" title="Visualizar" src="sistema/geral/imagens/icon_ver.png" /></a>';
                                break;
                            case 'editar':
                                if(isset($valor['acaoJS'])){
                                    $acaoJS = 'onclick="LoadPageEspecifica(\''.$valor['metodoJS'].'&id='.$linha[0].'\', \''.$valor['divCarregar'].'\');"';
                                }else
                                    $acaoJS = NULL;
                                $html .= ' <a '.$acaoJS.'><img border="0" alt="Editar" title="Editar" src="sistema/geral/imagens/icon_editar.png" /></a>';
                                break;
                            case 'excluir':
                                $html .= ' <a onClick="jConfirm(\''.$valor['msgExcluir'].'\', \'Confirmação de exclusão!\',
					function(r) {
						if(r==true)
                                                    LoadPageEspecifica(\''.$valor['metodoExcluir'].'&id='.$linha[0].'\', \''.$valor['divCarregar'].'\')});">
                                                   <img border="0" alt="Excluir" title="Excluir" src="sistema/geral/imagens/icon_delete.png" /></a>';
                                break;
                            case 'preencher':
                                $html .= ' <a class="history" href="principal.php#'.str_replace('.php', '', end(explode("/", $_SERVER['PHP_SELF']))).'-metodo=preencherQuestionario&id_questionarioPeriodo='.$linha[0].'&id_questionarioResposta='.$linha[1].'&ok" class="" onclick="pageload(\''.$_SERVER['PHP_SELF'].'?metodo=preencherQuestionario&id_questionarioPeriodo='.$linha[0].'&id_questionarioResposta='.$linha[1].'&ok\')">
                                            <img border="0" alt="Preencher Questionário" title="Preencher Questionário" src="sistema/geral/imagens/icon_editar.png" />
                                            </a>';
                                break;
                            
                            case 'imprimirRelatorio':
                                $html .= '  <a class="history" href="principal.php#questionario-metodo=imprimirQuestionario&id_questionario='.$linha[0].'&id_questionarioPeriodo='.$linha[1].'&ok" target="_blank" >
                                            <img border="0" alt="Imprimir" title="Imprimir" src="sistema/geral/imagens/imprimir.png" />
                                            </a>';
                                break;
                            
                            case 'imprimir':
                                $html .= ' <a class="history" href="principal.php#'.str_replace('.php', '', end(explode("/", $_SERVER['PHP_SELF']))).'-metodo=imprimeRelatorio&id_questionarioResposta='.$linha[0].'&ok" class="" target="_blank" >
                                            <img border="0" alt="Imprimir" title="Imprimir" src="sistema/geral/imagens/imprimir.png" />
                                            </a>';
                                break;
                            case 'abrirQuestionario':
                                $dataFim = strtotime($linha[2]);
                                if($dataFim >= $data):
                                    $html .= ' <a onClick="jConfirm(\'Tem certeza que deseja reabrir esse questionário para edição?\n <strong>Solicitante: '.$linha[3].'</strong>\', \'Confirmação!\',
					function(r) {
						if(r==true)
                                                    pageload(\''.$_SERVER['PHP_SELF'].'?metodo=reabrirQuestionario&id_questionarioresposta='.$linha[0].'&ok\');     });">
                                                <img border="0" alt="Reabrir Questionário" title="Reabrir Questionário" src="sistema/geral/imagens/icon_delete.png" /></a>';
                                endif;
                                break;

                        }
                    }
                    $html .= '</td>';
                }
                $html.= '</tr>';
            }
            $html .= '</tbody> </table>';
            $html .= '<input type=button id=chckPrint value=Imprimir />'; 
            $html .= '<div id="div_espacoTbl"></div>';
            return $html;

        }
        
        
    public function dica($texto, $quebraLinha = NULL) {
        if ($quebraLinha != NULL):
            $quebraLinha = '<br />';
        endif;
        
        return '<div id="div_dica">' .$texto. '</div>' .$quebraLinha;
    }
        
}
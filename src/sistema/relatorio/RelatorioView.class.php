<?php
require_once ('sistema/geral/SiteView.class.php');
require_once ('sistema/geral/SystemClass.class.php');

class RelatorioView extends SiteView {
    
    public function frmRelatorio($dados, $tituloRelatorio = NULL, $metodoRelatorio = NULL) {
        extract($dados);
        if($tituloRelatorio == NULL)
            $titulo = 'Relatórios';
        else
            $titulo = $tituloRelatorio;
        if($metodoRelatorio == NULL)
            $metodo = 'montaRelatorio';
        else 
            $metodo = ''.$metodoRelatorio.'';
        $acao = md5('mostrar');
        $nomeBotao = 'Mostrar';
        
        $con = '';
        $con .= $this->montaTitulo($titulo);
        $con .= $this->inicioFormulario('frmRelatorio', NULL, 'relatorio.php?metodo='.$metodo.'&acao='.$acao.'&ok', 1, 'div_resposta');
        $con .= $this->montaSelect('multiple', 'slc_questionario', 'txt_slc_questionario[]', 'Questionário:', 'multiselect', $slc_questionario);
        $con .= $this->montaSelect('multiple', 'slc_beneficio', 'txt_slc_beneficio[]', 'Benefícios:', 'multiselect', $slc_beneficio);
        $con .= $this->montaSelect('select', 'slc_campus', 'txt_slc_campus', 'Campus:', 'inputQuestionario', $slc_campus, NULL, 'onchange="carregaRelatorio()"');
        //$con .= $this->montaSelect('select', 'slc_ordem', 'txt_slc_ordem', 'Pontuação:', 'inputQuestionario', $ordem, NULL, 'onchange="carregaRelatorio()"');
        //$con .= '<br />'.$this->inputText('checkbox', 'grafico', 'grafico', '', $size, $class, 'S', NULL, NULL, NULL, NULL, NULL, 'onchange="carregaRelatorio()"').' Selecione o Checkbox para visualizar o gráfico <br />';
        $con .= $this->montaBotao($nomeBotao, 'botao');
        $con .= $this->fechaFormulario();
        $con .= '<div id="div_resposta"></div>';
        
        /*  Script atualiza o MultiSelect  */
        $con .= '<script>
                    $(".multiselect").multiselect({
                        click: function(event, ui) { jQuery("#frmRelatorio").submit(); },
                        checkAll: function() { jQuery("#frmRelatorio").submit(); },
                        uncheckAll: function() { jQuery("#frmRelatorio").submit(); }
                    });
                </script>';
        
        //$con .= '<div id="div_grafico" style="width: 800px; height: 380px; margin: 12px"></div>';
        echo $con;
    }
    
    public function frmRelatorioExcel($dados) {
        extract($dados);
        $titulo = 'Relatório Excel';
        $metodo = 'montaRelatorioExcel';
        $acao = md5('mostrar');
        $nomeBotao = 'Mostrar';
        
        $con = '';
        $con .= $this->montaTitulo($titulo);
        $con .= $this->inicioFormulario('frmRelatorio', NULL, 'relatorio.php?metodo='.$metodo.'&acao='.$acao.'&ok', 1, 'div_resposta');
        $con .= $this->montaSelect('multiple', 'slc_questionario', 'txt_slc_questionario[]', 'Questionário:', 'multiselect', $slc_questionario);
        $con .= $this->montaSelect('multiple', 'slc_beneficio', 'txt_slc_beneficio[]', 'Benefícios:', 'multiselect', $slc_beneficio);
        $con .= $this->montaSelect('select', 'slc_campus', 'txt_slc_campus', 'Campus:', 'inputQuestionario', $slc_campus, NULL, 'onchange="carregaRelatorio()"');
        //$con .= $this->montaSelect('select', 'slc_ordem', 'txt_slc_ordem', 'Pontuação:', 'inputQuestionario', $ordem, NULL, 'onchange="carregaRelatorio()"');
        //$con .= '<br />'.$this->inputText('checkbox', 'grafico', 'grafico', '', $size, $class, 'S', NULL, NULL, NULL, NULL, NULL, 'onchange="carregaRelatorio()"').' Selecione o Checkbox para visualizar o gráfico <br />';
        $con .= $this->montaBotao($nomeBotao, 'botao');
        $con .= $this->fechaFormulario();
        $con .= '<div id="div_resposta"></div>';
        
        /*  Script atualiza o MultiSelect  */
        $con .= '<script>
                    $(".multiselect").multiselect({
                        click: function(event, ui) { jQuery("#frmRelatorio").submit(); },
                        checkAll: function() { jQuery("#frmRelatorio").submit(); },
                        uncheckAll: function() { jQuery("#frmRelatorio").submit(); }
                    });
                </script>';
        
        //$con .= '<div id="div_grafico" style="width: 800px; height: 380px; margin: 12px"></div>';
        echo $con;
    }
    
    public function visualizarRelatorio($dados) {
        $titulo = 'Tabela de Pontuação';
        $acoes = array(
            array('imprimirRelatorio'),
            array('abrirQuestionario')
        );
        $tabela = htmlentities($this->montarGrid($titulo, $dados[1], $dados[0], $acoes, 3, array(4=>array('tipo'=>'cpf')), 'tbl_relatorio'), ENT_QUOTES, 'UTF-8');
        
        $con = '';
        $con .= $this->montarGrid($titulo, $dados[1], $dados[0], $acoes, 3, array(4=>array('tipo'=>'cpf')), 'tbl_relatorio');
        $con .= '<form action=Exportar.php method="post">
                <label>Nome do arquivo exportado: </label>                
                <input type="text" name="nome_arquivo"> 
                <input type="hidden" name="consulta" value="'.$tabela.'"> 
                <input type="submit" value="Exportar">
                </form>';
        // marca e desmarca todos os checkbox's
        $con .= '<script type="text/javascript">
                            $(function() {
                                $("#chckHead").click(function(){
                                    $(".chcktbl").prop("checked",$("#chckHead").prop("checked"))
                                })
                            });
                        </script>';
        //abre uma nova pagina para imprimir todos os alunos que o checkbox esta marcado
       $con .= '<script type="text/javascript">
                        $(function(){
                            $("#chckPrint").click(function(){                                
                                var stra = "";
                                var tam = ($("#tbl_relatorio :checked").size())-($(".listaTdTh :checked").size());
                                alert(($("#tbl_relatorio :checked").size())-($(".listaTdTh :checked").size()));
                                $("#tbl_relatorio :checked").each(function() {                                    
                                    stra += ($(this).val());                                    
                                });                                
                                window.open("principal.php#questionario-metodo=imprimirQuestionarioArray&linha="+stra+"&tamanho="+tam+"&ok")                                
                            });
                        });    
                        </script>'; 
        
        echo $con;
    }
    
    public function frmRelatorioResumo($dados) {
        extract($dados);
        $titulo = 'Resumo';
        $nomeBotao = 'Mostrar';
        $metodo = 'relatorioResumo';
        $acao = md5('mostrar');
        
        $con = '';
        $con .= $this->montaTitulo($titulo);
        $con .= $this->inicioFormulario('frmResumo', NULL, 'relatorio.php?metodo='.$metodo.'&acao='.$acao.'&ok', 1, 'div_resposta');
        $con .= $this->montaSelect('select', 'slc_questionario', 'txt_slc_questionario', 'Questionario', 'formulario', $slc_questionario, NULL, 'onchange="carregaResumo()"');
        $con .= $this->montaBotao($nomeBotao, 'botao');
        $con .= $this->fechaFormulario();
        $con .= '<div id="div_resposta"></div>';
        echo $con;
    }
    
    public function visualizarRelatorioResumo($dados, $numCadastros) {
        /*$acoes = array(
            array('imprimir'),
            array('abrirQuestionario', 'existe'=>$dadosRelatorio[1])
        );*/
        
        $con = '';
        $con .= $this->montarTabela('Dados Gerais', $numCadastros[1], $numCadastros[0], $acoes, $numeroParametros, $mascara, 'tbl_numCadastros');
        $con .= $this->montarTabela('Relatórios de envios', $dados[1], $dados[0], $acoes, $numeroParametros, $mascara, 'tbl_relatorio');
        echo $con;
    }
	
}

?>
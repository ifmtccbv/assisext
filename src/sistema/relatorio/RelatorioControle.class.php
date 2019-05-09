<?php
require_once 'RelatorioDAO.class.php';
require_once 'RelatorioView.class.php';
require_once 'sistema/geral/SystemClass.class.php';

class RelatorioControle extends System {
	
    public function montaRelatorio() {
        extract($_REQUEST);
        $relatorioView = new RelatorioView();
        $relatorioDAO = new RelatorioDAO();
        
        switch ($acao):
            case md5('frmRelatorio'):
                $slc_questionario = $relatorioDAO->buscaQuestionario();
                $slc_beneficio = $relatorioDAO->buscaBeneficios();
                $slc_campus = $relatorioDAO->buscaCampus();
                
                $dados = array(
                    'slc_questionario' => $slc_questionario,
                    'slc_beneficio' => $slc_beneficio,
                    'slc_campus' => $slc_campus
                    
                );
                
                $relatorioView->frmRelatorio($dados);
                break;
            
            case md5('mostrar'):
                $dados = array(
                    'id_campus' => $txt_slc_campus,
                    'slc_beneficio' => $multiselect_slc_beneficio,
                    'slc_questionario' => $multiselect_slc_questionario,
                );
                
                $dadosRelatorio = $relatorioDAO->tabelaRelatorio($dados);
                
                $relatorioView->visualizarRelatorio($dadosRelatorio);
                break;
        endswitch;
    
    }
    
    public function relatorioExcel() {
        extract($_REQUEST);
        $relatorioView = new RelatorioView();
        $relatorioDAO = new RelatorioDAO();
        
        switch ($acao):
            case md5('frmRelatorio'):
                $slc_questionario = $relatorioDAO->buscaQuestionario();
                $slc_beneficio = $relatorioDAO->buscaBeneficios();
                $slc_campus = $relatorioDAO->buscaCampus();
                
                $dados = array(
                    'slc_questionario' => $slc_questionario,
                    'slc_beneficio' => $slc_beneficio,
                    'slc_campus' => $slc_campus
                    
                );
                
                $relatorioView->frmRelatorio($dados, 'Relatório Excel', 'relatorioExcel');
                break;
            
            case md5('mostrar'):
                $dados = array(
                    'id_campus' => $txt_slc_campus,
                    'slc_beneficio' => $multiselect_slc_beneficio,
                    'slc_questionario' => $multiselect_slc_questionario,
                );
                
                $dadosRelatorio = $relatorioDAO->tabelaRelatorioExcel($dados);
                
                $relatorioView->visualizarRelatorio($dadosRelatorio);
                break;
            
        endswitch;
    
    }
    
    public function relatorioResumo() {
        extract($_REQUEST);
        $relatorioView = new RelatorioView();
        $relatorioDAO = new RelatorioDAO();
        
        switch ($acao):
            case md5('frmResumo'):
                $slc_questionario = $relatorioDAO->buscaQuestionario();
                
                $dados = array(
                    'slc_questionario' => $slc_questionario
                );
                
                $relatorioView->frmRelatorioResumo($dados);
                break;
            
            case md5('mostrar'):
                $numCadastros = $relatorioDAO->tabelaNumCadastros($txt_slc_questionario);
                
                $dados = array(
                    'id_questionario' => $txt_slc_questionario,
                    'total_cadastros' => $numCadastros[0]['total_cadastros'],
                    'total_envios' => $numCadastros[0]['total_envios'],
                );
                
                $dadosResumo = $relatorioDAO->tabelaResumo($dados);
                
                $relatorioView->visualizarRelatorioResumo($dadosResumo, $numCadastros);
                break;
        endswitch;
    }
    
    public function reabrirQuestionario() {
        extract($_REQUEST);
        $relatorioDAO = new RelatorioDAO();
     
        if ($relatorioDAO->reabrirQuestionario($id_questionarioresposta)):
            echo $this->exibeMensagem('Questionário aberto para edição com sucesso', 'Questionário Reaberto', 'relatorio.php?metodo=montaRelatorio&acao='.md5('frmRelatorio').'&ok');
        else:
            echo $this->exibeMensagem('Ocorreu algum erro inesperado, contate os administradores do sistema!', 'Erro inesperado', 'relatorio.php?metodo=montaRelatorio&acao='.md5('frmRelatorio').'&ok');
        endif;
    }
            
            
}

?>
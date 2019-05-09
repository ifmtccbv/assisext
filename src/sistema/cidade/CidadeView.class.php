<?php
require_once 'sistema/geral/SiteView.class.php';


class CidadeView extends SiteView{

    public function montaEnderecoCEP($id_uf, $id_cidade, $bairro, $logradouro, $listaUF, $listaCidades, $numeroComplemento=NULL, $readOnly=NULL){
        $conteudo = $this->montaSelectQuestionario('', 'cmb_uf', 'cmb_uf', 'Estado', 'validate[required] inputQuestionario', $listaUF, $id_uf, 'onchange="carregaCidades();"', NULL, $readOnly);
        if($id_cidade!=NULL)
            $conteudo .= '<div id="div_cidade">'.$this->montaSelectQuestionario('', 'cmb_cidade', 'cmb_cidade', 'Cidade', 'validate[required] inputQuestionario', $listaCidades, $id_cidade, NULL, NULL, $readOnly).'</div>';
        else
            $conteudo .= '<div id="div_cidade"></div>';
        $conteudo .= $this->inputTextQuestionario('text', 'txt_bairro', 'txt_bairro', 'Bairro', 40, 'validate[required] inputQuestionario', utf8_encode($bairro), NULL, 1, $readOnly);
        $conteudo .= $this->inputTextQuestionario('text', 'txt_logradouro', 'txt_logradouro', 'Logradouro', 40, 'validate[required] inputQuestionario', utf8_encode($logradouro), NULL, 1, $readOnly);
        $conteudo .= $this->inputTextQuestionario('text', 'txt_numeroComplemento', 'txt_numeroComplemento', 'Número/Complemento', 40, 'validate[required] inputQuestionario', $numeroComplemento, NULL, 1, $readOnly);

        return $conteudo;

    }
    
    public function montaEnderecoCEP2($id_uf, $id_cidade, $bairro, $logradouro, $listaUF, $listaCidades, $numeroComplemento=NULL, $readOnly=NULL){
        $conteudo = $this->montaSelectQuestionario('', 'cmb_uf2', 'cmb_uf2', 'Estado', 'validate[required] inputQuestionario', $listaUF, $id_uf, 'onchange="carregaCidades2();"', NULL, $readOnly);
        if($id_cidade!=NULL)
            $conteudo .= '<div id="div_cidade2">'.$this->montaSelectQuestionario('', 'cmb_cidade2', 'cmb_cidade2', 'Cidade', 'validate[required] inputQuestionario', $listaCidades, $id_cidade, NULL, NULL, $readOnly).'</div>';
        else
            $conteudo .= '<div id="div_cidade2"></div>';
        $conteudo .= $this->inputTextQuestionario('text', 'txt_bairro2', 'txt_bairro2', 'Bairro', 40, 'validate[required] inputQuestionario', utf8_encode($bairro), NULL, 1, $readOnly);
        $conteudo .= $this->inputTextQuestionario('text', 'txt_logradouro2', 'txt_logradouro2', 'Logradouro', 40, 'validate[required] inputQuestionario', utf8_encode($logradouro), NULL, 1, $readOnly);
        $conteudo .= $this->inputTextQuestionario('text', 'txt_numeroComplemento2', 'txt_numeroComplemento2', 'Número/Complemento', 40, 'validate[required] inputQuestionario', $numeroComplemento, NULL, 1, $readOnly);

        return $conteudo;

    }
	
}

?>
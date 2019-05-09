<?php

require_once 'CidadeDAO.class.php';
require_once 'Cidade.class.php';
require_once 'CidadeView.class.php';
//require_once 'sistema/usuario/UsuarioDAO.class.php';
require_once 'sistema/geral/SystemClass.class.php';

class CidadeControle extends System{

    public function montaEnderecoCEP(){
        extract($_REQUEST);
        $cidadeDAO = new CidadeDAO();
        $cidadeView = new CidadeView();
        //pega id uf
        if($uf!='0'){
            $id_uf = $cidadeDAO->getIdUF($uf);
            $id_cidade = $cidadeDAO->getIdCidade(($cidade), $uf);
            $listaCidades = $cidadeDAO->listaCidades($id_uf);
        }else
            $id_uf = $id_cidade = $bairro = $logradouro = $listaCidades = NULL;
        echo $cidadeView->montaEnderecoCEP($id_uf, $id_cidade, $bairro, $logradouro, $cidadeDAO->listaUF(), $listaCidades);

    }
    
    public function montaEnderecoCEP2(){
        extract($_REQUEST);
        $cidadeDAO = new CidadeDAO();
        $cidadeView = new CidadeView();
        //pega id uf
        if($uf!='0'){
            $id_uf = $cidadeDAO->getIdUF($uf);
            $id_cidade = $cidadeDAO->getIdCidade(($cidade), $uf);
            $listaCidades = $cidadeDAO->listaCidades($id_uf);
        }else
            $id_uf = $id_cidade = $bairro = $logradouro = $listaCidades = NULL;
        echo $cidadeView->montaEnderecoCEP2($id_uf, $id_cidade, $bairro, $logradouro, $cidadeDAO->listaUF(), $listaCidades);

    }

    public function carregaCidades(){
        extract($_REQUEST);
        $cidadeDAO = new CidadeDAO();
        $cidadeView = new CidadeView();
        if(!$id_uf)
            $listaCidades = array();
        else
            $listaCidades = $cidadeDAO->listaCidades($id_uf);
        echo $cidadeView->montaSelectQuestionario('', 'cmb_cidade', 'cmb_cidade', 'Cidade', 'validate[required] inputQuestionario', $listaCidades);
    }
    
    public function carregaCidades2(){
        extract($_REQUEST);
        $cidadeDAO = new CidadeDAO();
        $cidadeView = new CidadeView();
        if(!$id_uf)
            $listaCidades = array();
        else
            $listaCidades = $cidadeDAO->listaCidades($id_uf);
        echo $cidadeView->montaSelectQuestionario('', 'cmb_cidade2', 'cmb_cidade2', 'Cidade', 'validate[required] inputQuestionario', $listaCidades);
    }
	
}


?>
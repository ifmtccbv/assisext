<?php

require_once 'sistema/relatorio/RelatorioDAO.class.php';
require_once 'sistema/geral/SystemClass.class.php';

        $nome_arquivo = $_POST['nome_arquivo'];    
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=$nome_arquivo.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        
        echo utf8_decode($_POST['consulta']);

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

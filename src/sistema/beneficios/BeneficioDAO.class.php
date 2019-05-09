<?php

require_once 'sistema/geral/ConexaoBD.class.php';

class BeneficioDAO {

    public $con;

    public function __construct(){
            $this->con = new ConexaoBD();
    }

    public function buscaBeneficio($id_beneficio=NULL){
        if($id_beneficio!=NULL)
            $where = 'WHERE id_beneficio='.$id_beneficio;
        else
            $where = NULL;
        $sql = 'SELECT id_beneficio AS id, beneficio AS nome
                FROM tbl_beneficio
                '.$where.'
                ORDER BY beneficio';
        $resultado = $this->con->query($sql);
        return $resultado;
    }

}

?>
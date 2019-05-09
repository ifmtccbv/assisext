<?php
require_once 'sistema/geral/ConexaoBD.class.php';

class CampusDAO{
	public $con;
	
	public function __construct(){
		$this->con = new ConexaoBD();
	}

        public function buscaCampus($id_campus=NULL){
            if($id_campus!=NULL)
                $where = 'WHERE id_campus='.$id_campus;
            else
                $where = NULL;
            $sql = 'SELECT id_campus AS id, campus AS nome
                    FROM tbl_campus
                    '.$where.'
                    ORDER BY campus';
            $resultado = $this->con->query($sql);
            return $resultado;
        }
	
}

?>
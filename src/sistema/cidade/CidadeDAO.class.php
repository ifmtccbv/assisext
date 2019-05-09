<?php
require_once 'sistema/geral/ConexaoBD.class.php';

class CidadeDAO {
	public $con;
	
	public function __construct(){
		$this->con = new ConexaoBD();
	}

        public function getIdUF($uf){
            $sql = "SELECT id_uf
                    FROM tbl_uf
                    WHERE sigla='".$uf."'";
            $resultado = $this->con->query($sql);
            return $resultado[0]['id_uf'];
        }

        public function getIdCidade($cidade, $uf){
            $sql = "SELECT CI.id_cidade
                    FROM tbl_cidade CI
                    INNER JOIN tbl_uf UF ON CI.id_uf=UF.id_uf
                    WHERE CI.nome ilike '".utf8_encode($cidade)."' AND UF.sigla='".$uf."'";
            $resultado = $this->con->query($sql);
            return $resultado[0]['id_cidade'];
        }

        public function listaUF(){
           $sql = "SELECT id_uf AS id, sigla AS nome
                    FROM tbl_uf";
            $resultado = $this->con->query($sql);
            return $resultado;
        }

        public function listaCidades($id_uf){
            $sql = "SELECT CI.id_cidade AS id, CI.nome || ' - ' || UF.sigla AS nome
                    FROM tbl_cidade CI
                    INNER JOIN tbl_uf UF ON CI.id_uf=UF.id_uf
                    WHERE UF.id_uf=".$id_uf;
            $resultado = $this->con->query($sql);
            return $resultado;
        }
		
}

?>
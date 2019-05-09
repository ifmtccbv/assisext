<?php
require_once 'sistema/geral/SystemClass.class.php';
/**
 * PDO Singleton Connection
 *
 * @author  <inovarandre@gmail.com>
 *
 * @since 2010 MAR
 *
 * @license GNU GENERAL PUBLIC LICENSE
 *
 * Mais informaÃ§Ãµes em:
 * http://ca.php.net/manual/en/book.pdo.php
 *
 * @version 1.0
 *
 */
class ConexaoBD extends PDO {
	// LOCAL ACESSANDO O BANCO DEDICADO


    private $dsn    = 'pgsql:dbname=assisti;host=;port=5432';
    private $user   = '';
    private $pass   = '';
    private $options= null;
    protected static  $instance;

    /**
     * To get/initiate PDO instance
     *
     * @return PDO resource
     */

	function __construct(){
        if(isset(self::$instance))
        	self::$instance = NULL;
		if(!isset(self::$instance)){

			try{
                self::$instance = new PDO($this->dsn, $this->user, $this->pass, $this->options);
			}
            catch(PDOException $e){

                echo 'Conexão com o banco falhou: ' . $e->getMessage();

			}
        }

        return self::$instance;

	}


	/**
	 * FECHA CONEXAO COM BANCO
	 */
    function __destruct(){
    	self::$instance = NULL;
    }

    /**
     * DECLARANDO OS PRINCIPAIS MÉTodoS
     */
    protected function __clone(){}

    public function beginTransaction(){
        return self::$instance->beginTransaction();
    }

    public function commit(){
        return self::$instance->commit();
    }


    public function executar($query, $logs=NULL){
	//arrumar log
        //$consulta = 'INSERT INTO tbl_logs (id_usuario, data, hora, comando) VALUES ('.$_SESSION['id_usuario'].', "'.date('Y-m-d').'", "'.date('H:i:s').'", \''.$query.'\')';
	//$sqlConsulta = self::$instance->prepare($consulta);

		//if($sqlConsulta->execute()){
			$sql = self::$instance->prepare($query);
			if($sql->execute())
                            return 1;
			else{
                            //require_once('../class/class.phpmailer.php');
                            //include_once ('funcoes_site.php');
                            $mensagemErro = 'Erro na página: <strong>'.$_SERVER['PHP_SELF'].'</strong><br />';
                            $mensagemErro .= 'Erro ao executar: <strong>'.$query.'</strong><br />';
                            $mensagemErro .= 'Erro técnico: <strong>'.print_r($sql->errorInfo(), true).'</strong> <br />';
							$mensagemErro .= 'Browser utilizado: <strong> '.$_SERVER['HTTP_USER_AGENT'].' </strong>';
                            echo $mensagemErro;
                            System::enviaEmail($mensagemErro, $mensagemErro, 'Erro SQL - AssisEXT', '', 'Erro AssiEXT', '', '', 'Erro SQL AssisEXT', '', '', '', '', $anexo = NULL, $cc = '', $cco = NULL);
                            return 0;
			}
		/*}else{
			//require_once('../class/class.phpmailer.php');
			//include_once ('funcoes_site.php');
			$mensagemErro = 'Erro na página: <strong>'.$_SERVER['PHP_SELF'].'</strong><br />';
			$mensagemErro .= 'Erro ao executar: <strong>'.$query.'</strong><br />';
			//$mensagemErro .= 'Erro técnico: <strong>'.print_r($sql->errorInfo(), true).'</strong>';
			echo $mensagemErro;
			//enviaEmail($mensagemErro, 'Erro em SQL!');
			return 0;
		}*/
	}


	public function errorInfo(){
		return self::$instance->errorInfo();

	}

    public function rollBack(){
        return self::$instance->rollBack();
    }

    public function query($query, $pegarColunas=false, $numeroParametros=NULL){
            $sql = self::$instance->prepare($query);
            if($sql->execute()){
                if($pegarColunas){
                    $num = $sql->columnCount();
                    //=1 pq a primeira coluna SEMPRE TEM QUE SER O ID
                    if($numeroParametros==NULL)
                        $i = 1;
                    else
                        $i = $numeroParametros;
                    for ($i; $i < $num; $i ++) {
                        $meta = $sql->getColumnMeta($i);
                        $nome_coluna[] = $meta['name'];
                    }
                    return array($nome_coluna, $sql->fetchAll());
                }else
                    return $sql->fetchAll();
            }else{
                    //require_once('../class/class.phpmailer.php');
                    //include_once ('funcoes_site.php');
                    //$mensagemErro = 'Erro na página: <strong>'.$_SERVER['PHP_SELF'].'</strong><br />';
                    //$mensagemErro .= 'Erro ao executar: <strong>'.$query.'</strong><br />';
                    //$mensagemErro .= 'Erro técnico: <strong>'.print_r($sql->errorInfo(), true).'</strong>';
                    //enviaEmail($mensagemErro, 'Erro em SQL!');
                    return $sql->errorInfo();
            }
	}

	/*
	** RETORNA O ULTIMO ID INSERIDO
	*/
    public function lastInsertId($parametro=NULL){
        return self::$instance->lastInsertId($parametro);
    }

    // Retorna o Array com os dados (tabela), o nome das coluna(nome_coluna) e numero de colunas

            public function pegarTabela($query){
                    $sql = self::$instance->prepare($query);
                    if($sql->execute()){
                        $num = $sql->columnCount();
                        for ($i = 0; $i < $num; $i ++) {
                            $meta = $sql->getColumnMeta($i);
                            $nome_coluna[] = $meta['name'];
                        }
                            $tabela = $sql->fetchAll();
                        return array ($tabela, $nome_coluna, $num);

                    }else{
                            return $sql->errorInfo();
                    }
    }


}
?>

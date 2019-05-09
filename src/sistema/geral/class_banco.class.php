<?php
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
class comunicaBD extends PDO{
	// LOCAL ACESSANDO O BANCO DEDICADO

	/*
	private $dsn 	= 'mysql:dbname=syslogis_sistema;host=localhost';
    private $user   = 'syslogis_struck';
    private $pass   = 'anniro001';
    private $options= null; 
    protected static  $instance;
	*/
	
	private $dsn 	= 'mysql:dbname=syslogis_sistema;host=208.43.206.237';
    private $user   = 'syslogis_struck';
    private $pass   = 'anniro001';
    private $options= null; 
    protected static  $instance;
    
/*
    private $dsn 	= 'mysql:dbname=syslogisticfinal;host=localhost';
    private $user   = 'root';
    private $pass   = '';
    private $options= array(PDO::ATTR_TIMEOUT => 30); 
    protected static  $instance; 
*/
/*    
    private $dsn 	= 'mysql:dbname=syslogis_sistema;host=174.37.184.121';
    private $user   = 'syslogis_struck';
    private $pass   = 'anniro001';
    private $options= null; 
    protected static  $instance; 
   */
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
				
                echo 'ConexÃ£o com o banco falhou: ' . $e->getMessage();
            
			}
        }
		
        return self::$instance;
    
	}
	
	
	/**
	 * FECHA CONEXAO COM BANCO
	 */
    /*function __destruct(){
    	
    	self::$instance = NULL;
    	    	
    }*/
    
    /**
     * DECLARANDO OS PRINCIPAIS MÃ‰TODOS
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
        $consulta = 'INSERT INTO tbl_logs (id_usuario, data, hora, comando) VALUES ('.$_SESSION['id_usuario'].', "'.date('Y-m-d').'", "'.date('H:i:s').'", \''.$query.'\')';
		$sqlConsulta = self::$instance->prepare($consulta);
		if($sqlConsulta->execute()){
			$sql = self::$instance->prepare($query);
			if($sql->execute())
					return 1;
			else{
				require_once('../class/class.phpmailer.php');
				include_once ('funcoes_site.php');
				$mensagemErro = 'Erro na pÃ¡gina: <strong>'.$_SERVER['PHP_SELF'].'</strong><br />';
				$mensagemErro .= 'Erro ao executar: <strong>'.$query.'</strong><br />';
				$mensagemErro .= 'Erro tÃ©cnico: <strong>'.print_r($sql->errorInfo(), true).'</strong>';
				//enviaEmail($mensagemErro, 'Erro em SQL!');
				return 0;
			}
		}else{
			require_once('../class/class.phpmailer.php');
			include_once ('funcoes_site.php');
			$mensagemErro = 'Erro na pÃ¡gina: <strong>'.$_SERVER['PHP_SELF'].'</strong><br />';
			$mensagemErro .= 'Erro ao executar: <strong>'.$query.'</strong><br />';
			$mensagemErro .= 'Erro tÃ©cnico: <strong>'.print_r($sql->errorInfo(), true).'</strong>';
			//enviaEmail($mensagemErro, 'Erro em SQL!');
			return 0;
		}
	}
	
	
	public function errorInfo(){

		return self::$instance->errorInfo();
	
	}
    
    public function rollBack(){
		
        return self::$instance->rollBack();
    }
    
    public function query($query){
		
			$sql = self::$instance->prepare($query);
			if($sql->execute()){
				
				return $sql->fetchAll();
                                			
			}else{
				require_once('../class/class.phpmailer.php');
				include_once ('funcoes_site.php');
				$mensagemErro = 'Erro na pÃ¡gina: <strong>'.$_SERVER['PHP_SELF'].'</strong><br />';
				$mensagemErro .= 'Erro ao executar: <strong>'.$query.'</strong><br />';
				$mensagemErro .= 'Erro tÃ©cnico: <strong>'.print_r($sql->errorInfo(), true).'</strong>';
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
        

}
?>